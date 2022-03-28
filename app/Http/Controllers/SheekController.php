<?php

namespace App\Http\Controllers;

use App\Models\Sheek;
use Dotenv\Validator;
use Illuminate\Http\Request;

class SheekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sheeks = Sheek::all();
        return response()->view('back-end.sheek.index', [
            'sheeks' => $sheeks,
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
        return response()->view('back-end.sheek.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'beneficiary_name' => 'required|string|min:3|max:50',
            'amount' => 'required|integer|min:1',
            'currancy' => 'required|string|in:Dollar,Dinar|Shakel',
            'desc' => 'nullable',
            'status' => 'required|string|in:recived,paid',
        ]);

        $sheek = new Sheek();
        $sheek->beneficiary_name = $request->input('beneficiary_name'); 
        $sheek->amount = $request->input('amount'); 
        $sheek->currancy = $request->input('currancy'); 
        $sheek->desc = $request->input('desc'); 
        $sheek->status = $request->input('status'); 
        $isSaved = $sheek->save();

        if ($isSaved) {
            return redirect()->back();
        }else {
            return redirect()->back();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sheek  $sheek
     * @return \Illuminate\Http\Response
     */
    public function show(Sheek $sheek)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sheek  $sheek
     * @return \Illuminate\Http\Response
     */
    public function edit(Sheek $sheek)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sheek  $sheek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sheek $sheek)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sheek  $sheek
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sheek $sheek)
    {
        //
    }
}
