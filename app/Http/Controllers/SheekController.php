<?php

namespace App\Http\Controllers;

use App\Models\Sheek;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $validator = Validator($request->all(), [
            'beneficiary_name' => 'required|string|min:5|max:50',
            'amount' => 'required|integer|min:1',
            'currancy' => 'required|string|in:Dollar,Dinar,Shakel',
            // Return to this :)
            'bank' => 'required|string',
            'desc' => 'nullable',
            'status' => 'required|string|in:paid,recived',
        ]);
        //
        if (!$validator->fails()) {
            $sheek = new Sheek();
            $sheek->beneficiary_name = $request->get('beneficiary_name');
            $sheek->amount = $request->get('amount');
            $sheek->currancy = $request->get('currancy');
            $sheek->bank_name = $request->get('bank');
            $sheek->desc = $request->get('desc');
            $sheek->type = $request->get('status');
            $isCreated = $sheek->save();

            return response()->json([
                'message' => $isCreated ? 'Sheed added successfylly' : 'Faild to add sheek',
            ], $isCreated ? Response::HTTP_CREATED : Response::HTTP_BAD_GATEWAY);
        }else{
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_GATEWAY);
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
        return response()->view('back-end.sheek.edit', [
            'sheek' => $sheek,
        ]);
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
