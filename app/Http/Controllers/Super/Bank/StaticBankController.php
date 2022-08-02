<?php

namespace App\Http\Controllers\Super\Bank;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStaticBankRequest;
use App\Http\Requests\UpdateStaticBankRequest;
use App\Models\Currancy;
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
        $countries = DB::table('static_countries')->get();
        $currancies = Currancy::all();
        return response()->view('back-end.supers.banks.index', [
            'banks' => $banks,
            'countries' => $countries,
            'currancies' => $currancies,
        ]);
    }

    // Show Add New Bank
    public function create()
    {
        $countries = DB::table('static_countries')->get();
        $currancies = Currancy::where('active', true)->get();
        return response()->view('back-end.supers.banks.create', [
            'countries' => $countries,
            'currancies' => $currancies,
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
                'active' => $request->input('active'),
                'currancy_id' => $request->input('currancy_id'),
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


    // Show Edit Static Bank
    public function edit($id)
    {
        $bank = DB::table('static_bank')->where('id', $id)->first();
        $countries = DB::table('static_countries')->get();
        $currancies = Currancy::where('active', true)->get();

        return response()->view('back-end.supers.banks.edit', [
            'bank' => $bank,
            'countries' => $countries,
            'currancies' => $currancies,
        ]);
    }

    // Update Static Bank
    public function update(UpdateStaticBankRequest $request, $id)
    {
        if ($request->hasFile('image')) {
            $sheekImageName = time() . '_sheek_images' . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storePubliclyAs('public/img/', $sheekImageName);

            $isUpdated = DB::table('static_bank')->where('id', $id)->update([
                'name' => $request->input('name'),
                'city' => $request->input('city'),
                'img' => $sheekImageName,
                'active' => $request->input('active'),
                'country_id' => $request->input('country_id'),
                'currancy_id' => $request->input('currancy_id'),
                'updated_at' => now(),
            ]);
        } else {
            $isUpdated = DB::table('static_bank')->where('id', $id)->update([
                'name' => $request->input('name'),
                'active' => $request->input('active'),
                'city' => $request->input('city'),
                'country_id' => $request->input('country_id'),
                'currancy_id' => $request->input('currancy_id'),
                'updated_at' => now(),
            ]);
        }

        if ($isUpdated) {
            session([
                'created' => true,
                'title' => 'Updaeed Successfully',
                'message' => 'Bank ' . $request->input('name') . ' updated successfully.',
            ]);
            return redirect()->route('banks.static_index');
        } else {
            session([
                'created' => false,
                'title' => 'Failed',
                'message' => 'Failed to update bank with un-expected error.',
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
