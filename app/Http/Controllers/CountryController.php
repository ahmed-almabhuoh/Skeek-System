<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCountryRequest;
use App\Models\Country;
use Dotenv\Validator;
use Illuminate\Http\Request;
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
        //
        return response()->view('back-end.countries.create');
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
            return redirect()->route('countries.index')->with(['suc_msg' => 'Country ' . $request->input('name') . ' created successfully.',]);
        } else {
            return redirect()->route('countries.create')->with(['err_msg' => 'Failed to store country.',]);
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
    public function update(Request $request, Country $country)
    {
        $validator = Validator($request->only([
            'name',
            'active',
        ]), [
            'name' => 'required|string|min:3|max:45',
            'active' => 'required|boolean',
        ]);
        //
        if (!$validator->fails()) {
            $country->name = $request->input('name');
            $country->active = $request->input('active');
            $isUpdated = $country->save();

            return response()->json([
                'message' => $isUpdated ? 'Country updated successfully' : 'Faild to update country',
            ], $isUpdated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
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
}
