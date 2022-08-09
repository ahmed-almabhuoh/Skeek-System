<?php

namespace App\Http\Controllers\Super\Super;

use App\Http\Controllers\Controller;
use App\Models\Super;
use Illuminate\Http\Request;

class ShowAllSupersForSuperController extends Controller
{
    //

    // Show a specific super for super
    public function showSuper(Super $super)
    {
    }

    public function index()
    {
        if (auth('super')->user()->email == 'az54546@gmail.com') {
            $supers = Super::all();
        } else {
            $supers = Super::where('email', '!=', 'az54546@gmail.com')->get();
        }
        return response()->view('back-end.supers.supers.index', [
            'supers' => $supers,
        ]);
    }
}
