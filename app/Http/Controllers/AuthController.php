<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //

    public function showLogin($guard) {
        return view('auth.login', [
            'guard' => $guard,
        ]);
    }

    public function login(Request $request) {
        $validator = Validator($request->all(), [
            'email' => 'required|string|min:5|max:50|exists:' . $request->get('_guard') . 's,email',
            'password' => 'required|string',
            'remember' => 'required|boolean',
            '_guard' => 'required|string|in:admin',
        ]);

        if (!$validator->fails()) {
            $credentials = [
                'email' => $request->get('email'),
                'password' => $request->get('password')
            ];

            if (Auth::guard($request->get('_guard'))->attempt($credentials, $request->get('remember'))) {
                return response()->json([
                    'message' => 'login successfully',
                ], Response::HTTP_OK);
            }else{
                return response()->json([
                    'message' => 'wrong credentials',
                ], Response::HTTP_BAD_REQUEST);
            }
        }else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_GATEWAY);
        }
    }

    public function logout() {
        $guard = 'admin';
        if (auth('admin')->check()) {
            $guard = 'admin';
            auth($guard)->logout();
        }

        return redirect()->route('login', $guard);
    }
}
