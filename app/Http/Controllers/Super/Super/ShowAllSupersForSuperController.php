<?php

namespace App\Http\Controllers\Super\Super;

use App\Http\Controllers\Controller;
use App\Models\Super;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ShowAllSupersForSuperController extends Controller
{
    //

    // Show a specific super for super
    public function showSuper(Super $super)
    {
    }

    public function index()
    {
        // Check Ability
        $this->checkUserAbility('Read-Super', ['Update-Super', 'Delete-Super', 'Ban-Super', 'Follow-Up-Super'], '||');

        // Store Logs
        $this->storeSuperLogs('Show All Supers');

        if (auth('super')->user()->email == 'az54546@gmail.com') {
            $supers = Super::all();
        } else {
            $supers = Super::where('email', '!=', 'az54546@gmail.com')->get();
        }
        return response()->view('back-end.supers.supers.index', [
            'supers' => $supers,
            'password' => $this->generateNewPassword(12),
            'roles' => Role::get(),
        ]);
    }
}
