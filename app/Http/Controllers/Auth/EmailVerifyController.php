<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailVerificationJob;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmailVerifyController extends Controller
{
    //
    public function showVerifyEmail () {
        return response()->view('auth.verify-email');
    }

    public function sendEmailVerification (Request $request) {
//        SendEmailVerificationJob::dispatch($request->all())->onQueue('email_verification');
        $request->user()->sendEmailVerificationNotification();
        return response()->json([
            'message' => 'Verification email send successfully',
        ], Response::HTTP_OK);
    }

    public function emailVerify (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('admin.dashboard');
    }
}
