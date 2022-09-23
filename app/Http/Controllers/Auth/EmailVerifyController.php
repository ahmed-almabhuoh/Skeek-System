<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailVerificationJob;
use Illuminate\Contracts\Queue\ShouldQueue;
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
//        new SendEmailVerificationJob($request->all());
        $request->user()->sendEmailVerificationNotification();
        return response()->json([
            'message' => __('Verification email send successfully'),
        ], Response::HTTP_OK);
    }

    public function emailVerify (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('admin.dashboard');
    }
}
