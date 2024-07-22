<?php

namespace App\Http\Controllers;

use App\Events\TaskCreated;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use App\Notifications\TaskAssignmentNotification;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Task $task)
    {
        Gate::authorize('create',$task);
        $tasks = Task::all();

        return response()->json([
            'tasks' => $tasks->load('team','assigned'),
            'status' => 200
        ]);
    }

    public function getTaskAssigned(Task $task)
    {
        $tasks = Task::where('assignee_id',Auth::id())
            ->get();

        return response()->json([
            'tasks' => $tasks->load('assigned'),
            'status' => 200
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', Rule::unique('tasks')],
            'description' => ['required', 'string'],
            'estimated_effort' => ['required', 'string'],
            'priority' => ['required', 'string', Rule::in(['low', 'medium', 'high'])],
            'labels' => ['required', 'array'],
            'due_date' => ['required', 'date'],
            'status' => ['nullable', 'string'],
            'team_id' => ['nullable', 'integer', 'exists:teams,id'],
            'assignee_id' => ['nullable', 'integer', 'exists:users,id'],
        ]);

        $task = Task::create(array_merge($validatedData, [
            'creator' => Auth::id(),
            'user_id' => Auth::id(),
            'labels' => json_encode($validatedData['labels'])
        ]));
        $task->user_id = auth()->id();
        TaskCreated::dispatch($task);

        return response()->json([
            'task' => $task,
            'status' => 200
        ]);
    }

    public function singleTask($id): JsonResponse
    {
        try {
            $task = Task::find($id);
            return response()->json([
                'message'=>'Task fetched',
                'task'=>$task->load('assigned')->load('team'),

            ]);

        }catch (Exception $e){
            return response()->json([
                'message'=>'Failed to fetch task requested',
                'error'=>$e->getMessage(),
            ],500);
        }
    }
    /**
     * Get  Task by ID
     * Isset(team_id)
     * Isset(user_id)
     * dispatch->as assigned
     * if team  this is in task
     * get json_decode(team->team_members)
     * team_lead->get email
     * loop all user_ids get email
     * then dispatch email to them about task assignment
     *
     *
     */

    public function assignAndNotify(Request $request, $taskId)
    {
        // Fetch the task
        $task = Task::findOrFail($taskId);
//        dd($task);

        // Validate the request
        $validatedData = $request->validate([
            'team_id' => 'nullable|exists:teams,id',
            'assignee_id' => 'nullable|exists:users,id',
        ]);

        // Handle assignment
        if (isset($validatedData['team_id'])) {
            $task->team_id = $validatedData['team_id'];
            $task->assignee_id = null;  // Clear individual assignment if assigning to team
        } elseif (isset($validatedData['assignee_id'])) {
            $task->assignee_id = $validatedData['assignee_id'];
            $task->team_id = null;  // Clear team assignment if assigning to individual
        } else {
            return response()->json(['message' => 'Either team_id or assignee_id must be provided'], 400);
        }

        $task->save();


        // Handle notifications
        if ($task->team_id) {
            $this->notifyTeam($task);
        } elseif ($task->assignee_id) {
            $this->notifyUser($task);
        }

        return response()->json(['message' => 'Task assigned and notifications sent', 'task' => $task], 200);
    }

    private function notifyTeam(Task $task): void
    {
        $team = Team::findOrFail($task->team_id);
//        dd($team);
        $teamMembers = json_decode($team->team_members, true);
//dd($teamMembers);
        // Notify team lead
        $teamLead = User::findOrFail($team->user_id);
        Notification::send($teamLead, new TaskAssignmentNotification($task, true));

        // Notify team members
        $teamMemberUsers = User::whereIn('id', $teamMembers['user_ids'])->get();
        Notification::send($teamMemberUsers, new TaskAssignmentNotification($task));
    }

    private function notifyUser(Task $task): void
    {
        $user = User::findOrFail($task->assignee_id);
        Notification::send($user, new TaskAssignmentNotification($task));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id): JsonResponse
    {

        $status = $request->validate([
            'status' => ['required']
        ]);
        $task = Task::find($id);


        if (Gate::authorize('create', $task)) {
            $task->update($status);
            if ($task) {
                $task->save();
                return response()->json([
                    'message' => 'Successfully set Task as Approved'
                ]);
            } else {
                return response()->json([
                    'error' => 'Error Updating Task'
                ]);
            }
        } else {
            return response()->json([
                'error' => 'You are not authorized to Approve this task'
            ], 500);
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, User $user): JsonResponse
    {
        $status = $request->validate([
            'status' => ['required']
        ]);
        $user = Auth::user();
        $task = Task::find($id);
        try {
            Gate::authorize('update', $task);

            if ($task->status === 'Approved') {
                $task->update($status);
                if ($task) {
                    $task->save();
                    return response()->json([
                        'message' => 'Status updated',
                        'status' => 200,


                    ]);
                }
                return response()->json([
                    'message' => 'Status updating Failed',
                    'status' => 401

                ]);
            } elseif ($task->status === 'Declined') {
                return response()->json([
                    'message' => 'Task was declined by Admin',
                ], 500);
            } else {
                return response()->json([
                    'message' => 'Waiting Approval from Administrator',
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Unauthorized Activity',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $task = Task::find($id);
        Gate::authorize('update', $task);
        if ($task->delete()) {
            return response()->json([
                'message' => 'Task Deleted',
                'status' => 401

            ]);
        }
        return response()->json([
            'message' => 'Task Deletion Failed',
            'status' => 401

        ]);
    }
}
