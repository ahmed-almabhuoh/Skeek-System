<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail(Crypt::decrypt($id));

        // Check Ability
        $this->checkUserAbility('Update-User');

        // Store Logs
        $this->storeSuperLogs('Show user information to update it,' . $admin->name);

        //
        return response()->view('back-end.supers.users.edit', [
            'admin' => $admin,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail(Crypt::decrypt($id));
        // Check Ability
        $this->checkUserAbility('Update-User');

        // Store Logs
        $this->storeSuperLogs('Update user information: ' . $admin->name);
        //
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        if ($request->input('password')) {
            $admin->password = $request->input('password');
        }
        $admin->active = $request->has('active') ? true : false;
        $isSaved = $admin->save();

        return redirect()->route('super.user_show')->with([
            'status' => $isSaved ? __('User updated successfully') : __('Failed to update user'),
            'code' => $isSaved ? 200 : 500,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail(Crypt::decrypt($id));

        // Check Ability
        $this->checkUserAbility('Delete-User');

        // Store Logs
        $this->storeSuperLogs(`Delete the user from the system: ` . $admin->name);
        //
        $isDeleted = $admin->delete();

        return response()->json([
            'icon' => $isDeleted ? 'success' : 'error',
            'title' => $isDeleted ? __('Deleted!') : __('Failed!'),
            'text' => $isDeleted ? __('Admin deleted successfully') : __('Failed to delete admin!'),
        ], $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
