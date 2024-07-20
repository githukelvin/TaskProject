<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email'=>['required','email',Rule::exists('users')],
            'password'=>['required']
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user->save(); // Get the authenticated user

            $token = $user->createToken('Personal Access Token')->plainTextToken;

            return response()->json([
                'token' => $token,
                'user' => $user, // Include user data in the response
            ], 200);
        }
        else{
            return response()->json(['error' =>'Invalid Credentials'] , 401);

        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'name'=>['required',"string"],
            'email'=>['required','email',Rule::unique('users')],
            'password'=>['required'],
            'is_admin'=>['boolean'],
            'team_id'=>['number'],
        ]);

        $user = User::create($credentials);

        return response()->json(
            [
                'user'=>$user,
                'status'=>200
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
