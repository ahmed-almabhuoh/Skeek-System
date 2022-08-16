<?php

namespace App\Http\Controllers\Super\Super;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSuperRequest;
use App\Models\Super;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class EditSuperController extends Controller
{
    //

    // Show edit super
    public function showEditSuper($supe_enc_id)
    {
        // Check Ability
        $this->checkUserAbility('Update-Super');

        // Check Super Policy
        $this->checkSuperPolicyAZ($supe_enc_id);

        return response()->view('back-end.supers.supers.edit', [
            'super' => Super::findOrFail(Crypt::decrypt($supe_enc_id)),
            'password' => $this->generateNewPassword(12),
        ]);
    }

    // Update Super
    public function updateSuper(UpdateSuperRequest $request, $supe_enc_id)
    {
        // Check Ability
        $this->checkUserAbility('Update-Super');

        // Check Super Policy
        $this->checkSuperPolicyAZ($supe_enc_id);

        $super = Super::findOrFail(Crypt::decrypt($supe_enc_id));
        $super->name = $request->input('name');
        $super->email = $request->input('email');
        if (!is_null($request->input('password'))) {
            $super->password = Hash::make($request->input('password'));
        }
        $super->active = $request->input('active');
        $isUpdated = $super->save();

        if ($isUpdated) {
            return redirect()->route('super.super_index')->with([
                'status' => 'Super updated successfully',
                'code' => 200,
            ]);
        } else {
            return back()->with([
                'status' => 'Failed to update super',
                'code' => 500,
            ]);
        }
    }
}
