<?php

namespace App\Http\Controllers\Super\Users;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function showAllusers()
    {
        $admins = Admin::all();

        return response()->view('back-end.supers.users.index', [
            'admins' => $admins,
        ]);
    }
}
