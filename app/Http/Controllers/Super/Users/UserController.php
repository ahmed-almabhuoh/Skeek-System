<?php

namespace App\Http\Controllers\Super\Users;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

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

    public function deleteUser(Admin $admin)
    {
        if ($admin->delete()) {
            return response()->json([
                'icon' => 'success',
                'title' => 'Deleted',
                'text' => 'User deleted successfully',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => 'Failed',
                'text' => 'Failed to delete user',
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    // Ban Admin
    public function banAndUnBanUser(Admin $admin)
    {
        $admin->active = $admin->active ? false : true;
        $admin->save();
        return redirect()->route('super.user_show');
    }

    // Follow Up Admin
    public function followAdminUserLogs(Admin $admin)
    {
        $userLogs = DB::table('user_logs')->where('admin_id', $admin->id)->orderBy('created_at', 'DESC')->get();

        return response()->view('back-end.supers.users.follow-up', [
            'userLogs' => $userLogs,
            'admin' => $admin,
        ]);
    }
}
