<?php

namespace App\Http\Controllers\Super\Super\RoleAndPermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Permission;
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
        $roles = Role::withCount('permissions')->paginate();

        // Store Logs
        $this->storeSuperLogs('Show all rules');

        return response()->view('back-end.supers.role_permissions.roles.index', [
            'roles' => $roles,
        ]);
    }

    public function showRolePermission($role_enc_id)
    {
        $rule = Role::findOrFail(Crypt::decrypt($role_enc_id));
        // Store Logs
        $this->storeSuperLogs('Show Assign Permission For Rule: ' . $rule->name);

        $role = Role::findOrFail(Crypt::decrypt($role_enc_id));
        $permissions = Permission::all();
        $role_permissions = $role->permissions;



        foreach ($permissions as $permission) {
            $permission->setAttribute('assigned', false);
            foreach ($role_permissions as $role_permission) {
                if ($permission->id == $role_permission->id) {
                    $permission->setAttribute('assigned', true);
                }
            }
        }
        return response()->view('back-end.supers.role_permissions.roles.role_permissions', [
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    public function assignPermissionToRole(Request $request, $permission_id)
    {
        $validator = Validator($request->only([
            'role_id',
        ]), [
            'role_id' => 'required|integer|exists:roles,id'
        ]);
        //
        if (!$validator->fails()) {
            $role = Role::findOrFail($request->input('role_id'));
            $permission = Permission::findOrFail($permission_id);

            // Store Logs
            $this->storeSuperLogs('Assign Permission: ' . $permission->name . ' To Rule:' . $role->name);

            if ($role->hasPermissionTo($permission)) {
                $role->revokePermissionTo($permission);
                return response()->json([
                    'message' => __('Permission removed from role successfully'),
                ], Response::HTTP_OK);
            } else {
                $role->givePermissionTo($permission);

                return response()->json([
                    'message' => __('Permission added to role successfully'),
                ], Response::HTTP_OK);
            }
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // Store Logs
        $this->storeSuperLogs('Show Create Role Form');
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

        // Store Logs
        $this->storeSuperLogs('Create Role With Name: ' . $request->input('name'));

        if ($isSaved) {
            return redirect()->route('roles.index')->with([
                'status' => __('Role added successfully'),
                'code' => 200,
            ]);
        } else {
            return back()->with([
                'status' => __('Failed to add role'),
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
    public function edit($role_enc_id)
    {
        $role = Role::findOrFail(Crypt::decrypt($role_enc_id));
        // Store Logs
        $this->storeSuperLogs('Show Edit Form For Role With Name: ' . $role->name);
        //
        return response()->view('back-end.supers.role_permissions.roles.edit', [
            'role' => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $role_enc_id)
    {
        //
        $role = Role::findOrFail(Crypt::decrypt($role_enc_id));
        $role->name = $request->input('name');
        $role->guard_name = $request->input('guard');
        $isSaved = $role->save();

        // Store Logs
        $this->storeSuperLogs('Update Role With Name: ' . $role->name);

        if ($isSaved) {
            return redirect()->route('roles.index')->with([
                'status' => __('Role updated successfully'),
                'code' => 200,
            ]);
        } else {
            return back()->with([
                'status' => __('Failed to update role'),
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

        // Store Logs
        $this->storeSuperLogs('Delete Role With Name: ' . $role->name);
        
        if ($role->delete()) {
            return response()->json([
                'icon' => 'success',
                'title' => __('Deleted!'),
                'text' => __('Role deleted successfully'),
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => __('Failed!'),
                'text' => __('Failed to delete role'),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
