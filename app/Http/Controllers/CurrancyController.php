<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCurrancyRequest;
use App\Http\Requests\UpdateCurrancyRequest;
use App\Models\Currancy;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CurrancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $currancies = Currancy::all();
        return response()->view('back-end.supers.currancies.index', [
            'currancies' => $currancies,
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
        return response()->view('back-end.supers.currancies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCurrancyRequest $request)
    {
        //
        $currancy = new Currancy();
        $currancy->name = $request->input('name');
        $currancy->active = $request->input('active');
        $isCreated = $currancy->save();

        if ($isCreated) {
            session([
                'created' => true,
                'title' => 'Added Successfully',
                'message' => 'Currancy ' . $request->input('name') . ' added successfully.',
            ]);
            return redirect()->route('currancies.index');
        } else {
            session([
                'created' => false,
                'title' => 'Failed',
                'message' => 'Failed to add Currancy with un-expected error.',
            ]);
            return redirect()->route('currancies.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currancy  $currancy
     * @return \Illuminate\Http\Response
     */
    public function show(Currancy $currancy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currancy  $currancy
     * @return \Illuminate\Http\Response
     */
    public function edit(Currancy $currancy)
    {
        //
        return response()->view('back-end.supers.currancies.edit', [
            'currancy' => $currancy,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Currancy  $currancy
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCurrancyRequest $request, Currancy $currancy)
    {
        //
        $currancy->name = $request->input('name');
        $currancy->active = $request->input('active');
        $isCreated = $currancy->save();

        if ($isCreated) {
            session([
                'created' => true,
                'title' => 'Added Successfully',
                'message' => 'Currancy ' . $request->input('name') . ' updated successfully.',
            ]);
            return redirect()->route('currancies.index');
        } else {
            session([
                'created' => false,
                'title' => 'Failed',
                'message' => 'Failed to updated currancy with un-expected error.',
            ]);
            return redirect()->route('currancies.edit', $currancy->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currancy  $currancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currancy $currancy)
    {
        //
        if ($currancy->delete()) {
            return response()->json([
                'icon' => 'success',
                'title' => 'Deleted',
                'text' => 'Currancy deleted successfully',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => 'Faild!',
                'text' => 'Faild to delete currancy',
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
