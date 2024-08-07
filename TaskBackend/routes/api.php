<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'create']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware(['signed'])
        ->name('verification.verify');

    Route::post('/email/resend', [EmailVerificationController::class, 'resend'])
        ->middleware(['throttle:6,1'])
        ->name('verification.resend');

    Route::get('/email/notice', [EmailVerificationController::class, 'notice'])
        ->name('verification.notice');

    Route::post('/email/send-verification', [EmailVerificationController::class, 'sendVerificationEmail'])
        ->middleware(['throttle:6,1'])
        ->name('verification.send');
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/createtask', [TaskController::class,'store']);
    Route::get('/tasks', [TaskController::class,'index']);
    Route::get('/teams', [TeamController::class,'index']);
    Route::post('/update-status/{id}', [TaskController::class,'update']);
    Route::put('/approve/{id}', [TaskController::class,'edit']);
    Route::post('/addMembers/{id}',[TeamController::class,'addTeamMembers']);
    Route::post('/create_team',[TeamController::class,'store']);
    Route::post('/tasks/{taskId}/assign', [TaskController::class, 'assignAndNotify']);
    Route::get('/tasks/{id}',[TaskController::class,'singleTask']);
    Route::get('/task_user',[TaskController::class,'getTaskAssigned']);
});

Route::middleware('guest')->get('/verify-token', function (Request $request) {
    $user = Auth::guard('sanctum')->user();

    if ($user) {
        // User is authenticated, return data with token information
        return response()->json([
            'message' => 'Token verified',
            'token' => $request->bearerToken(), // Include the token itself
        ]);
    } else {
        // Handle unauthorized access (e.g., return 401 response)
        return response()->json(['message' => 'Unauthorized'], 401);
    }
});
