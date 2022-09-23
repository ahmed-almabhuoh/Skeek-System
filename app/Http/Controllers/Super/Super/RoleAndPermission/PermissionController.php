<?php

namespace App\Http\Controllers\Super\Super\RoleAndPermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // Store Logs
        $this->storeSuperLogs('Show All permissions');

        $permissions = Permission::get();
        return response()->view('back-end.supers.role_permissions.permissions.index', [
            'permissions' => $permissions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Store Logs
        $this->storeSuperLogs('Show Create Form permission');
        //
        $roles = Role::get();
        return response()->view('back-end.supers.role_permissions.permissions.add', [
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePermissionRequest $request)
    {
        //
        $permission = new Permission();
        $permission->name = $request->input('name');
        $permission->guard_name = $request->input('guard');
        $isSaved = $permission->save();

        // Store Logs
        $this->storeSuperLogs('Store permission with name: ' + $request->input('name'));

        if ($isSaved) {
            return redirect()->route('permissions.index')->with([
                'code' => 200,
                'status' => __('Permission added successfully'),
            ]);
        } else {
            return back()->with([
                'code' => 500,
                'status' => __('Failed to create permission'),
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
    public function edit($permission_enc_id)
    {
        $permission = Permission::findOrFail($permission_enc_id);
        // Store Logs
        $this->storeSuperLogs('Show edit form for permission with name: ' + $permission->name);
        //
        $permission = Permission::findOrFail(Crypt::decrypt($permission_enc_id));
        return response()->view('back-end.supers.role_permissions.permissions.edit', [
            'permission' => $permission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionRequest $request, $permission_enc_id)
    {
        //
        $permission = Permission::findOrFail(Crypt::decrypt($permission_enc_id));
        $permission->name = $request->input('name');
        $permission->guard_name = $request->input('guard');
        $isSaved = $permission->save();

        // Store Logs
        $this->storeSuperLogs('Update Permission With Name: ' + $permission->name);

        if ($isSaved) {
            return redirect()->route('permissions.index')->with([
                'status' => __('Permission updated successfully'),
                'code' => 200,
            ]);
        } else {
            return redirect()->route('permissions.index')->with([
                'status' => __('Failed to update permission'),
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
        $permission = Permission::findOrFail($id);
        // Store Logs
        $this->storeSuperLogs('Delete Permission With Name: ' + $permission->name);
        //
        $permission = Permission::findOrFail($id);
        if ($permission->delete()) {
            return response()->json([
                'icon' => 'success',
                'title' => __('Deleted!'),
                'text' => __('Permission deleted successfully'),
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => __('Failed!'),
                'text' => __('Failed to delete permission'),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
