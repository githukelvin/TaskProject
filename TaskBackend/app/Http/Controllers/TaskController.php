<?php

namespace App\Http\Controllers;

use App\Events\TaskCreated;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();

        return response()->json([
            'tasks' => $tasks,
            'status' => 200
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $task = $request->validate([
            'user_id' => ['number'],
            'team_id' => ['number'],
            'creator' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'estimated_effort' => ['required', 'string'],
            'priority' => ['required', 'string'],
            'labels' => ['required', 'string'],
            'due_date' => ['required', 'date'],
            'status' => ['string'],
        ]);

        $taskCreated = Task::create($task);
        if ($taskCreated) {
            TaskCreated::dispatch($taskCreated);
            return response()->json([
                'task' => $taskCreated,
                'status' => 200
            ]);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->authorize('create', $task);
        $task->status = 'Approved';
        $task->save();
        if ($task) {
            return response()->json([
                'message' => 'Successfully set Task as Approved'
            ]);
        } else {
            return response()->json([
                'error' => 'Error Updating Task'
            ]);
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $status = $request->validate([
            'status' => ['required']
        ]);
        $this->authorize('update', $task);
        $task->update($status);
//        dd($status);
        $task->save();

        if ($task) {
            return response()->json([
                'message' => 'Status updated',
                'status' => 200

            ]);
        }
        return response()->json([
            'message' => 'Status updating Failed',
            'status' => 401

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('update', $task);
        $taskDelete = Task::find($task->id);
        if ($taskDelete->delete()) {
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
