<?php

namespace App\Http\Controllers\Super\Country;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStaticCountry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaticCountriesController extends Controller
{
    //

    // Show All Static Countries
    public function showAllStaticCountries()
    {
        $countries = DB::table('static_countries')->get();

        return response()->view('back-end.supers.countries.index', [
            'countries' => $countries,
        ]);
    }

    // Show Create View
    public function create()
    {
        return response()->view('back-end.supers.countries.create');
    }

    public function store(CreateStaticCountry $request)
    {
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
}
