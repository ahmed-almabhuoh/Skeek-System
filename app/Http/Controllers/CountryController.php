<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Bank;
use App\Models\Country;
use App\Models\Currancy;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CountryController extends Controller
{
    public  function __construct()
    {
        $this->authorizeResource(Country::class, 'country');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Store Logs
        $this->storeUserLogs('show countries');
        //
        $countries = Country::where('admin_id', auth()->user()->id)->withCount('banks')->get();
        return response()->view('back-end.countries.index', [
            'countries' => $countries,
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
        $this->storeUserLogs('show create country');
        //

        $static_countries = DB::table('static_countries')->where('active', 1)->get();
        $static_banks = DB::table('static_bank')->where('active', 1)->get();
        $currancies = Currancy::where('active', 1)->get();

        session([
            'created' => false,
            'title' => 'Failed',
            'message' => 'Wrong inputs, re-enter and retry agian.',
        ]);

        return response()->view('back-end.countries.create', [
            'static_countries' => $static_countries,
            'static_banks' => $static_banks,
            'currancies' => $currancies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCountryRequest $request)
    {
        $country = new Country();
        $country->name = $request->input('name');
        $country->active = $request->input('active');
        $country->admin_id = auth('admin')->user()->id;
        $isCreated = $country->save();

        if ($isCreated) {
            // Store Logs
            $this->storeUserLogs('create country');
            session([
                'created' => true,
                'title' => 'Added Successfully',
                'message' => 'Country ' . $request->input('name') . ' added successfully.',
            ]);
            return redirect()->route('countries.index');
        } else {
            session([
                'created' => false,
                'title' => 'Failed',
                'message' => 'Failed to add country with un-expected error.',
            ]);
            return redirect()->route('countries.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        //
        // Store Logs
        $this->storeUserLogs('show edit country');
        return response()->view('back-end.countries.edit', [
            'country' => $country,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country->name = $request->input('name');
        $country->active = $request->input('active');
        $isUpdated = $country->save();

        if ($isUpdated) {
            // Store Logs
            $this->storeUserLogs('update country');
            session([
                'created' => true,
                'title' => 'Updated Successfully',
                'message' => 'Country ' . $request->input('name') . ' updated successfully.',
            ]);
            return redirect()->route('countries.index');
        } else {
            session([
                'created' => false,
                'title' => 'Failed',
                'message' => 'Failed to update country with un-expected error.',
            ]);
            return redirect()->route('countries.edit', $country);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        //
        if ($country->delete()) {
            // Store Logs
            $this->storeUserLogs('delete country');
            return response()->json([
                'icon' => 'success',
                'title' => 'Deleted',
                'text' => 'Country deleted successfully',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => 'Faild!',
                'text' => 'Faild to delete country',
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function displayCountryBanks(Country $country)
    {
        return response()->view('back-end.countries.country-banks', [
            'country' => $country,
            // 'banks' => $country->banks,
        ]);
    }
}
