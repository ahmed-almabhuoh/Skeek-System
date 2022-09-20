<?php

namespace App\Http\Controllers\Super\Super;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSuperRequest;
use App\Models\Super;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateSuperContorller extends Controller
{
    //

    // Show form to create super user 
    public function showCreateSuper()
    {
        // Check Ability
        $this->checkUserAbility('Create-Super');

        // Store Logs
        $this->storeSuperLogs('Show Create Super Form');

        return response()->view('back-end.supers.supers.create', [
            'password' => $this->generateNewPassword(12),
            'roles' => Role::get(),
        ]);
    }

    public function storeSuper(CreateSuperRequest $request)
    {
        // Check Ability
        $this->checkUserAbility('Create-Super');


        // Store Logs
        $this->storeSuperLogs('Create New Super With Name: ' . $request->input('name'));

        $super = new Super();
        $super->name = $request->input('name');
        $super->email = $request->input('email');
        $super->password = Hash::make($request->input('password'));
        // $super->active = $request->input('active');
        $super->active = 1;
        $isCreated = $super->save();

        if ($isCreated) {
            $super->assignRole(Role::findOrFail($request->input('role_id')));

            return redirect()->route('super.super_index')->with([
                'status' => 'Super added successfully',
                'code' => 200,
            ]);
        } else {
            return back()->with([
                'status' => 'Failed to add super',
                'code' => 500,
            ]);
        }
    }
}
