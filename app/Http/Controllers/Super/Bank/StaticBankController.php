<?php

namespace App\Http\Controllers\Super\Bank;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStaticBankRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class StaticBankController extends Controller
{
    //

    // Show All Banks
    public function index()
    {
        $banks = DB::table('static_bank')->get();
        return response()->view('back-end.supers.banks.index', [
            'banks' => $banks,
        ]);
    }

    // Show Add New Bank
    public function create()
    {
        $countries = DB::table('static_countries')->get();
        return response()->view('back-end.supers.banks.create', [
            'countries' => $countries,
        ]);
    }

    public function store(CreateStaticBankRequest $request)
    {
        if ($request->hasFile('image')) {
            $sheekImageName = time() . '_sheek_images' . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storePubliclyAs('public/img/', $sheekImageName);

            $isCreated = DB::table('static_bank')->insert([
                'name' => $request->input('name'),
                'city' => $request->input('city'),
                'img' => $sheekImageName,
                'country_id' => $request->input('country_id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if ($isCreated) {
            session([
                'created' => true,
                'title' => 'Added Successfully',
                'message' => 'Bank ' . $request->input('name') . ' added successfully.',
            ]);
            return redirect()->route('banks.static_index');
        } else {
            session([
                'created' => false,
                'title' => 'Failed',
                'message' => 'Failed to add bank with un-expected error.',
            ]);
            return redirect()->route('banks.statis_create');
        }
    }

    // Delete Static Bank
    public function delete($id)
    {
        $isDeleted = DB::table('static_bank')->where('id', $id)->delete();
        if ($isDeleted) {
            return response()->json([
                'icon' => 'success',
                'title' => 'Deleted',
                'text' => 'Static bank deleted successfully'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => 'Failed',
                'text' => 'Failed to delete static bank'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
