<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Country;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $banks = Bank::where('admin_id', auth('admin')->user()->id)->with('country')->get();
        return response()->view('back-end.banks.index', [
            'banks' => $banks,
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
        $countries = Country::where([
            ['admin_id', auth('admin')->user()->id],
            ['active', '1'],
        ])->get();
        return response()->view('back-end.banks.create', [
            'countries' => $countries,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->only([
            'name',
            'city',
            'sheek_image',
            'active',
        ]), [
            'name' => 'required|string|min:3|max:45',
            'city' => 'required|string|min:3|max:45',
            'sheek_image' => 'required|image|max:2048|mimes:jpg,png',
            'active' => 'required|boolean',
        ], [
            'sheek_image.max' => 'File is too large, try agian.',
        ]);
        //
        if (!$validator->fails()) {
            $bank = new Bank();
            $bank->name = $request->input('name');
            $bank->city = $request->input('city');
            $bank->country_id = $request->input('country_id');
            $bank->admin_id = auth('admin')->user()->id;
            $isCreated = $bank->save();
            if ($request->hasFile('sheek_image')) {
                //abc.png
                $sheekImageName = time() . '_sheek_images' . '.' . $request->file('sheek_image')->getClientOriginalExtension();
                $request->file('sheek_image')->storePubliclyAs('public/img/', $sheekImageName);
                DB::table('images')->insert([
                    'img' => $sheekImageName,
                    'bank_id' => $bank->id,
                ]);
            }

            return response()->json([
                'message' => $isCreated ? 'Bank added successfully' : 'Faild to add bank',
            ], $isCreated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        //
        $countries = Country::where([
            ['admin_id', auth()->user()->id],
            ['active', '1'],
        ])->get();
        return response()->view('back-end.banks.edit', [
            'bank' => $bank,
            'countries' => $countries,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        $validator = Validator($request->only([
            'name',
            'city',
            'sheek_image',
            'active',
        ]), [
            'name' => 'required|string|min:3|max:45',
            'city' => 'required|string|min:3|max:45',
            'sheek_image' => 'nullable',
            'active' => 'required|boolean',
        ]);
        //
        if (!$validator->fails()) {
            $bank->name = $request->input('name');
            $bank->city = $request->input('city');
            $bank->country_id = $request->input('country_id');
            $bank->active = $request->input('active');
            $isCreated = $bank->save();
            if ($request->hasFile('sheek_image')) {
                //abc.png
                Storage::delete('public/img/' . (DB::table('images')->select('img')->where('bank_id', $bank->id)->first())->img);
                $sheekImageName = time() . '_sheek_images' . '.' . $request->file('sheek_image')->getClientOriginalExtension();
                $request->file('sheek_image')->storePubliclyAs('public/img/', $sheekImageName);
                DB::table('images')->where([
                    ['bank_id', $bank->id]
                ])->update([
                    'img' => $sheekImageName,
                    'bank_id' => $bank->id,
                ]);
            }

            return response()->json([
                'message' => $isCreated ? 'Bank added successfully' : 'Faild to add bank',
            ], $isCreated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        //
        $bank_id = $bank->id;
        if ($bank->delete()) {
            Storage::delete('public/img/' . (DB::table('images')->select('img')->where('bank_id', $bank_id)->first())->img);
            DB::table('images')->where('bank_id', $bank_id)->delete();
            return response()->json([
                'icon' => 'success',
                'title' => 'Deleted',
                'text' => 'Bank deleted successfully',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => 'Faild',
                'text' => 'Faild to delete bank',
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function showSpecificBanks (Country $country) {
        $banks = Bank::where([
            ['country_id', $country->id],
            ['admin_id', auth('admin')->user()->id],
        ])->get();
        return response()->view('back-end.banks.spacific-banks', [
            'banks' => $banks,
            'country' => $country,
        ]);
    }
}
