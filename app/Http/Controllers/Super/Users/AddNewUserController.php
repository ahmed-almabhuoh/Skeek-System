<?php

namespace App\Http\Controllers\Super\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserFromSuperRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddNewUserController extends Controller
{
    //

    public function showAddNewUser()
    {
        return response()->view('back-end.supers.users.add', [
            'password' => $this->generateNewPassword(12),
        ]);
    }

    public function storeNewUser(CreateUserFromSuperRequest $request)
    {
        $admin = new Admin();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->password = Hash::make($request->input('password'));
        $admin->active = $request->input('active');
        $isCreated = $admin->save();


        if ($isCreated) {
            return redirect()->route('super.user_add')->with([
                'status' => 'User added successfully',
                'code' => 200,
            ]);
        } else {
            return back()->with([
                'status' => 'Failed to add user',
                'code' => 500,
            ]);
        }
    }
}
