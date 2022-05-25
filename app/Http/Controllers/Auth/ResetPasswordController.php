<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends Controller
{
    //
    public function showForgetPassword () {
        return response()->view('auth.forget-password');
    }

    public function sendResetPasswordLink (Request $request) {
        $validator = Validator($request->only([
            'email',
        ]), [
            'email' => 'required|email|exists:admins,email',
        ], [
            'email.exists' => 'Invalid email',
        ]);
        //
        if (! $validator->fails()) {
            $status = Password::sendResetLink(['email' => $request->input('email')]);

//            return $status === Password::RESET_LINK_SENT
//                ? \response()->json(['message' => __($status)], Response::HTTP_OK)
//                : \response()->json(['message' => __($status)], Response::HTTP_BAD_REQUEST);

            return \response()->json([
                'message' => __($status)
            ], $status == Password::RESET_LINK_SENT
            ? Response::HTTP_OK
            : Response::HTTP_BAD_REQUEST);
        }else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public  function showResetPassword (Request $request, $token) {
        return \response()->view('auth.reset-password', [
            'token' => $token,
            'email' => $request->input('email'),
        ]);
    }

    public function resetPassword (Request $request) {
        $validator = Validator($request->only([
            'email',
            'token',
            'password',
            'password_confirmation',
        ]), [
            'email' => 'required|email|exists:admins,email',
            'token' => 'required|string',
            'password' => ['required', 'string', \Illuminate\Validation\Rules\Password::min(8)->letters()->symbols()->mixedCase()->numbers()->uncompromised(), 'confirmed'],
        ]);
        //
        if (! $validator->fails()) {
            $status = Password::reset($request->only([
                'email' => $request->input('email'),
            ]), function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            } );

            return \response()->json([
                'message' => __($status),
            ], $status == Password::PASSWORD_RESET
            ? Response::HTTP_OK
            : Response::HTTP_BAD_REQUEST);
        }else {
            return \response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
