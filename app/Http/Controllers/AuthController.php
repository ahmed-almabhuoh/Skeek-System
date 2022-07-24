<?php

namespace App\Http\Controllers;

use App\Mail\AdminWelcomeEmail;
use App\Models\Admin;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //

    public function showLogin($guard)
    {
        return view('auth.login', [
            'guard' => $guard,
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|string|min:5|max:50|exists:' . $request->get('_guard') . 's,email',
            'password' => 'required|string',
            'remember' => 'required|boolean',
            '_guard' => 'required|string|in:admin,super',
        ], [
            '_guard.in' => 'Wrong URL, please choose the right URL',
        ]);

        if (!$validator->fails()) {
            $credentials = [
                'email' => $request->get('email'),
                'password' => $request->get('password')
            ];
            $guard = 'admin';
            $admin = Admin::where('email', $request->input('email'))->first();
            if (!$admin->active) {
                return response()->json([
                    'message' => 'Your account has been banned',
                ], Response::HTTP_BAD_REQUEST);
            }

            if (Auth::guard($request->get('_guard'))->attempt($credentials, $request->get('remember'))) {
                // Store Logs
                if (auth('admin')->check())
                    $this->storeUserLogs('login');

                if (auth('admin')->check()) {
                    $guard = 'admin';
                } else if (auth('super')->check()) {
                    $guard = 'super';
                }

                return response()->json([
                    'message' => 'login successfully',
                    'guard' => $guard,
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'wrong credentials',
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_GATEWAY);
        }
    }

    public function logout()
    {
        // Store Logs
        if (auth('admin')->check())
            $this->storeUserLogs('logout');

        $guard = 'admin';
        if (auth('admin')->check()) {
            $guard = 'admin';
            auth($guard)->logout();
        } else if (auth('super')->check()) {
            $guard = 'super';
            auth($guard)->logout();
        }

        return redirect()->route('login', $guard);
    }

    public function showChangePassword()
    {
        // Store Logs
        $this->storeUserLogs('show change password');
        return response()->view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        // return response()->json([
        //     'message' => $request->input('current_password'),
        // ], Response::HTTP_OK);
        $validator = Validator($request->only([
            'current_password',
            'password',
            'password_confirmation',
        ]), [
            'current_password' => 'required|string',
            'password' => ['required', 'string', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed'],
        ]);
        //
        if (!$validator->fails()) {
            if (Hash::check($request->input('current_password'), auth('admin')->user()->password)) {
                // (Admin::where('email', auth('admin')->user()->email)->first())->password = Hash::make($request->input('password'));
                $admin = Admin::where('email', auth('admin')->user()->email)->first();
                $admin->password = Hash::make($request->input('password'));
                $isChanged = $admin->save();

                // Store Logs
                $this->storeUserLogs('change password');

                return response()->json([
                    'message' => $isChanged ? 'Password changed successfully' : 'Faild to change password',
                ], $isChanged ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
            } else {
                return response()->json([
                    'message' => 'Wrong password',
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function showRegister()
    {
        return response()->view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator($request->only([
            'name',
            'email',
            'password',
            'password_confirmation',
            'terms',
        ]), [
            'name' => 'required|string|min:3|max:45',
            'email' => 'required|email',
            'password' => ['required', 'string', Password::min(8)->letters()->numbers()->uncompromised()->symbols()->mixedCase(), 'confirmed'],
            'terms' => 'required|boolean',
        ]);
        //
        if (!$validator->fails()) {

            // Terms
            if (!$request->input('terms'))
                return response()->json([
                    'message' => 'You cannot create new accout without approve on out terms',
                ], Response::HTTP_BAD_REQUEST);

            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->password = Hash::make($request->input('password'));
            $isRegistered = $admin->save();

            if ($isRegistered)
                Mail::to($admin)->send(new AdminWelcomeEmail($admin));

            return response()->json([
                'message' => $isRegistered ? 'Register successfully' : 'Faild to register right now, please try another moment',
            ], $isRegistered ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
