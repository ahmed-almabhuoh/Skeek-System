<?php

namespace App\Http\Controllers\Super\Super\RoleAndPermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::get();

        return response()->view('back-end.supers.role_permissions.roles.index', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('back-end.supers.role_permissions.roles.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        //
        $role = new Role();
        $role->name = $request->input('name');
        $role->guard_name = $request->input('guard');
        $isSaved = $role->save();

        if ($isSaved) {
            return redirect()->route('roles.index')->with([
                'status' => 'Role added successfully',
                'code' => 200,
            ]);
        } else {
            return back()->with([
                'status' => 'Failed to add role',
                'code' => 500,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return response()->view('back-end.supers.role_permissions.roles.edit', [
            'role' => Role::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        //
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->guard_name = $request->input('guard');
        $isSaved = $role->save();

        if ($isSaved) {
            return redirect()->route('roles.index')->with([
                'status' => 'Role updated successfully',
                'code' => 200,
            ]);
        } else {
            return back()->with([
                'status' => 'Failed to update role',
                'code' => 500,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $role = Role::findOrFail($id);
        if ($role->delete()) {
            return response()->json([
                'icon' => 'success',
                'title' => 'Deleted!',
                'text' => 'Role deleted successfully',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Failed to delete role',
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
