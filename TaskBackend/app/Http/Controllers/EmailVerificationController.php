<?php

namespace App\Http\Controllers;

use App\Providers\CustomEmailProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class EmailVerificationController extends Controller


{
    public $mailTo;

    public function __construct(CustomEmailProvider $customEmailProvider)
    {
        $this->mailTo= $customEmailProvider
    }
    public function verify(EmailVerificationRequest $request): JsonResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified']);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response()->json(['message' => 'Email verified successfully']);
    }

    public function resend(Request $request): JsonResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified']);
        }

        $request->user()->sendEmailVerificationNotification();
        return response()->json(['message' => 'Verification link sent']);
    }

    public function notice(): JsonResponse
    {
        return response()->json(['message' => 'Please verify your email address']);
    }

    public function sendVerificationEmail(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified']);
        }

        $verificationUrl = $this->generateVerificationUrl($user);

        $user->notify(new VerifyEmail);

        return response()->json(['message' => 'Verification email sent', 'verification_url' => $verificationUrl]);
    }

    protected function generateVerificationUrl($user): string
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->getKey(),
                'hash' => sha1($user->getEmailForVerification()),
            ]
        );
    }
}
