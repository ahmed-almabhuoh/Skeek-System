<?php

namespace App\Http\Controllers\Super\Country;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStaticCountry;
use App\Http\Requests\UpdateStaticCountryRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class StaticCountriesController extends Controller
{
    //

    // Show All Static Countries
    public function showAllStaticCountries()
    {
        // Check Ability
        $this->checkUserAbility('Read-Country', ['Update-Country', 'Delete-Country'], '||');

        // Store Logs
        $this->storeSuperLogs('Show All Static Countries');


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

        // Store Logs
        $this->storeSuperLogs('Show Create Static Country Form');

        return response()->view('back-end.supers.countries.create');
    }

    public function store(CreateStaticCountry $request)
    {
        // Check Ability
        $this->checkUserAbility('Create-Country');

        // Store Logs
        $this->storeSuperLogs('Create New Static Country With Name: ' . $request->input('name'));

        $isCreated = DB::table('static_countries')->insert([
            'name' => $request->input('name'),
            'active' => $request->input('active'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($isCreated) {
            return redirect()->route('countries.static_show')->with([
                'created' => true,
                'title' => __('Added Successfully'),
                'message' => __('Country added successfully.'),
            ]);
        } else {
            return redirect()->route('countries.statis_create')->with([
                'created' => false,
                'title' => __('Failed'),
                'message' => __('Failed to add country with un-expected error.'),
            ]);
        }
    }

    // Delete Static Country
    public function destroy($enc_country_id)
    {

        // Check Ability
        $this->checkUserAbility('Delete-Country');


        $country = DB::table('static_countries')->where('id', Crypt::decrypt($enc_country_id))->first();

        // Store Logs
        $this->storeSuperLogs('Delete Static Country With Name: ' . $country->name);



        $isDeleted = DB::table('static_countries')->where('id', Crypt::decrypt($enc_country_id))->delete();
        if ($isDeleted) {
            return response()->json([
                'icon' => 'success',
                'title' => __('Deleted'),
                'text' => __('Static country deleted successfully')
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => __('Failed'),
                'text' => __('Failed to delete static country')
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function edit($country_enc_id)
    {
        // Check Ability
        $this->checkUserAbility('Update-Country');

        $country = DB::table('static_countries')->where('id', Crypt::decrypt($country_enc_id))->first();

        // Store Logs
        $this->storeSuperLogs('Show Update Static Country Form With Name: ' . $country->name);

        return response()->view('back-end.supers.countries.edit', [
            'country' => DB::table('static_countries')->where('id', Crypt::decrypt($country_enc_id))->first(),
        ]);
    }

    public function update(UpdateStaticCountryRequest $request, $country_enc_id)
    {
        // Check Ability
        $this->checkUserAbility('Update-Country');


        $isUpdated = DB::table('static_countries')->where('id', Crypt::decrypt($country_enc_id))->update([
            'name' => $request->input('name'),
            'active' => $request->input('active'),
            // 'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Store Logs
        $this->storeSuperLogs('Update Static Country With Name: ' . $request->input('name'));


        if ($isUpdated) {
            return redirect()->route('countries.static_show')->with([
                'status' => __('Country Update Successfully'),
                'code' => 200,
            ]);
        } else {
            return back()->with([
                'status' => __('Failed to update country'),
                'code' => 500,
            ]);
        }
    }

    public function show($enc_country_id)
    {
        return response()->json([
            'country' => DB::table('static_countries')->where('id', Crypt::decrypt($enc_country_id))->first(),
            'status' => true,
        ], Response::HTTP_OK);
    }
}
