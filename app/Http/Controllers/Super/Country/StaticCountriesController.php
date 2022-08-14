<?php

namespace App\Http\Controllers\Super\Country;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStaticCountry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class StaticCountriesController extends Controller
{
    //

    // Show All Static Countries
    public function showAllStaticCountries()
    {
        // Check Ability
        $this->checkUserAbility('Read-Country');

        $countries = DB::table('static_countries')->get();

        return response()->view('back-end.supers.countries.index', [
            'countries' => $countries,
        ]);
    }

    // Show Create View
    public function create()
    {
        // Check Ability
        $this->checkUserAbility('Create-Country');

        return response()->view('back-end.supers.countries.create');
    }

    public function store(CreateStaticCountry $request)
    {
        // Check Ability
        $this->checkUserAbility('Create-Country');

        $isCreated = DB::table('static_countries')->insert([
            'name' => $request->input('name'),
            'active' => $request->input('active'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($isCreated) {
            session([
                'created' => true,
                'title' => 'Added Successfully',
                'message' => 'Country ' . $request->input('name') . ' added successfully.',
            ]);
            return redirect()->route('countries.static_show');
        } else {
            session([
                'created' => false,
                'title' => 'Failed',
                'message' => 'Failed to add country with un-expected error.',
            ]);
            return redirect()->route('countries.statis_create');
        }
    }

    // Delete Static Country
    public function destroy($id)
    {
        // Check Ability
        $this->checkUserAbility('Delete-Country');

        $isDeleted = DB::table('static_countries')->where('id', $id)->delete();
        if ($isDeleted) {
            return response()->json([
                'icon' => 'success',
                'title' => 'Deleted',
                'text' => 'Static country deleted successfully'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => 'Failed',
                'text' => 'Failed to delete static country'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
