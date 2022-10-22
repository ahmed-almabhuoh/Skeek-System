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
        // Check Ability
        $this->checkUserAbility('Read-User', ['Update-User', 'Delete-User', 'Ban-User', 'Follow-Up-User'], '||');

        // Store Logs
        $this->storeSuperLogs('Show All Users');

        $admins = Admin::all();

        return response()->view('back-end.supers.users.index', [
            'admins' => $admins,
            'password' => $this->generateNewPassword(12),
        ]);
    }

    public function deleteUser(Admin $admin)
    {
        // Check Ability
        $this->checkUserAbility('Delete-User');

        // Store Logs
        $this->storeSuperLogs('Delete User With Name: ' . $admin->name);

        if ($admin->delete()) {
            return response()->json([
                'icon' => 'success',
                'title' => __('Deleted'),
                'text' => __('User deleted successfully'),
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => __('Failed'),
                'text' => __('Failed to delete user'),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    // Ban Admin
    public function banAndUnBanUser(Admin $admin)
    {
        // Check Ability
        $this->checkUserAbility('Ban-User');

        // Store Logs
        $this->storeSuperLogs('Ban User With Name: ' . $admin->name);

        $admin->active = $admin->active ? false : true;
        $isSaved = $admin->save();
        return redirect()->route('super.user_show', [
            'message' => $isSaved ? 'Changes saved successfully' : 'Failed to save your changes!',
            'code' => $isSaved ? 200 : 500,
        ]);
    }

    // Follow Up Admin
    public function followAdminUserLogs(Admin $admin)
    {
        // Check Ability
        $this->checkUserAbility('Follow-Up-User');

        // Store Logs
        $this->storeSuperLogs('Show All User Actions With Name: ' . $admin->name);

        $userLogs = DB::table('user_logs')->where('admin_id', $admin->id)->orderBy('created_at', 'DESC')->paginate();

        return response()->view('back-end.supers.users.follow-up', [
            'userLogs' => $userLogs,
            'admin' => $admin,
        ]);
    }
}
