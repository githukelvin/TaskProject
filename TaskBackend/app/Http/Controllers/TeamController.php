<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        $teams = Team::all();
        return response()->json([
            'teams' => $teams
        ]);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $credentials = $request->validate([
                'team_name' => ['required'],
                'user_id ' => ['required'],
            ]);

            $team = Team::create($credentials);
            if (!$team) {
                return response()->json([
                    'message' => 'Team creation Failed',
                    'status' => 200
                ]);
            }
            return response()->json([
                'message' => 'Team Creation was successfully',
                'status' => 200
            ]);
        }catch (Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the team',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified team.
     *
     * @param Request $request
     * @param Team $team
     * @return JsonResponse
     */
    public function update(Request $request, Team $team): JsonResponse
    {
        try {
            $updated = $team->update($request->validated());

            if (!$updated) {
                return response()->json([
                    'message' => 'Failed to update team details',
                    'status' => 400
                ], 400);
            }

            return response()->json([
                'message' => 'Team details updated successfully',
                'status' => 200
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the team',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    /**
     * Delete the specified team.
     *
     * @param Team $team
     * @return JsonResponse
     */
    public function destroy(Team $team): JsonResponse
    {
        try {
            $deleted = $team->delete();

            if (!$deleted) {
                return response()->json([
                    'message' => 'Failed to delete team',
                    'status' => 400
                ], 400);
            }

            return response()->json([
                'message' => 'Team deleted successfully',
                'status' => 200
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the team',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }


}
