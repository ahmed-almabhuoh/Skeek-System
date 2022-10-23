<?php

namespace App\Http\Controllers\Super\Bank;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStaticBankRequest;
use App\Http\Requests\UpdateStaticBankRequest;
use App\Models\Currancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class StaticBankController extends Controller
{
    //

    // Show All Banks
    public function index()
    {
        // Check Ability
        $this->checkUserAbility('Read-Bank', ['Update-Bank', 'Delete-Bank'], '||');

        // Store Logs
        $this->storeSuperLogs('Store Static Banks');

        $banks = DB::table('static_bank')->paginate();
        $countries = DB::table('static_countries')->get();
        // scopeActive
        $currancies = Currancy::active()->get();
        return response()->view('back-end.supers.banks.index', [
            'banks' => $banks,
            'countries' => $countries,
            'currancies' => $currancies,
        ]);
    }

    // Show Add New Bank
    public function create()
    {
        // Check Ability
        $this->checkUserAbility('Create-Bank');

        // Store Logs
        $this->storeSuperLogs('Show Create Static Bank Form');

        $countries = DB::table('static_countries')->get();
        $currancies = Currancy::where('active', true)->get();
        return response()->view('back-end.supers.banks.create', [
            'countries' => $countries,
            'currancies' => $currancies,
        ]);
    }

    public function store(CreateStaticBankRequest $request)
    {
        // Check Ability
        $this->checkUserAbility('Create-Bank');


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


        // Store Logs
        $this->storeSuperLogs('Create New Static Bank with name: ' . $request->input('name'));

        if ($isCreated) {
            return redirect()->route('banks.static_index')->with([
                'created' => true,
                'title' => __('Added Successfully'),
                'message' => __('Bank added successfully.'),
            ]);
        } else {
            return redirect()->route('banks.static_index')->with([
                'created' => false,
                'title' => __('Failed'),
                'message' => __('Failed to add bank with un-expected error.'),
            ]);
        }
    }


    // Show Edit Static Bank
    public function edit($bank_enc_id)
    {
        // Check Ability
        $this->checkUserAbility('Update-Bank');

        $bank = DB::table('static_bank')->where('id', Crypt::decrypt($bank_enc_id))->first();
        $countries = DB::table('static_countries')->get();
        $currancies = Currancy::where('active', true)->get();

        // Store Logs
        $this->storeSuperLogs('Show Edit Static Bank Form with name: ' . $bank->name);

        return response()->view('back-end.supers.banks.edit', [
            'bank' => $bank,
            'countries' => $countries,
            'currancies' => $currancies,
        ]);
    }

    // Update Static Bank
    public function update(UpdateStaticBankRequest $request, $bank_enc_id)
    {
        // Check Ability
        $this->checkUserAbility('Update-Bank');

        $bank = DB::table('static_banks')->where('id', Crypt::decrypt($bank_enc_id))->first();

        if ($request->hasFile('image')) {
            $sheekImageName = time() . '_sheek_images' . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storePubliclyAs('public/img/', $sheekImageName);

            $isUpdated = DB::table('static_bank')->where('id', Crypt::decrypt($bank_enc_id))->update([
                'name' => $request->input('name'),
                'city' => $request->input('city'),
                'img' => $sheekImageName,
                'active' => $request->input('active'),
                'country_id' => $request->input('country_id'),
                'currancy_id' => $request->input('currancy_id'),
                'updated_at' => now(),
            ]);
        } else {
            $isUpdated = DB::table('static_bank')->where('id', Crypt::decrypt($bank_enc_id))->update([
                'name' => $request->input('name'),
                'active' => $request->input('active'),
                'city' => $request->input('city'),
                'country_id' => $request->input('country_id'),
                'currancy_id' => $request->input('currancy_id'),
                'updated_at' => now(),
            ]);
        }

        // Store Logs
        $this->storeSuperLogs('Update Static Bank with name: ' + $bank->name);

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
                'title' => __('Failed'),
                'message' => __('Failed to update bank with un-expected error.'),
            ]);
            return redirect()->route('banks.statis_create');
        }
    }

    // Delete Static Bank
    public function delete($enc_bank_id)
    {
        // Check Ability

        $this->checkUserAbility('Delete-Bank');

        $bank = DB::table('static_bank')->where('id', Crypt::decrypt($enc_bank_id))->first();

        // Store Logs
        $this->storeSuperLogs('Delete Static Bank With Name: ' . $bank->name);

        $isDeleted = DB::table('static_bank')->where('id',  Crypt::decrypt($enc_bank_id))->delete();
        if ($isDeleted) {
            return response()->json([
                'icon' => 'success',
                'title' => __('Deleted'),
                'text' => __('Static bank deleted successfully')
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => __('Failed'),
                'text' => __('Failed to delete static bank')
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function show($enc_bank_id)
    {
        $bank = DB::table('static_bank')->where('id', Crypt::decrypt($enc_bank_id))->first();
        $country = DB::table('static_countries')->where('id', $bank->country_id)->first();
        $currancy = DB::table('currancies')->where('id', $bank->currancy_id)->first();
        return response()->json([
            'bank' => $bank,
            'country' => $country,
            'currancy' => $currancy,
            'status' => true,
        ], Response::HTTP_OK);
    }
}
