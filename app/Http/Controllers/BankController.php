<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBankRequest;
use App\Http\Requests\UpdateBankRequest;
use App\Models\Bank;
use App\Models\Country;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class BankController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Bank::class, 'bank');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // Store Logs
        $this->storeUserLogs('show banks');

        $countries = Country::where([
            ['admin_id', auth('admin')->user()->id],
            ['active', '1'],
        ])->get();
        $banks = Bank::where('admin_id', auth('admin')->user()->id)->with('country')->get();
        return response()->view('back-end.banks.index', [
            'banks' => $banks,
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
        // Store Logs
        $this->storeUserLogs('show create bank');

        $countries = Country::where([
            ['admin_id', auth('admin')->user()->id],
            ['active', '1'],
        ])->get();

        session([
            'created' => false,
            'title' => 'Failed',
            'message' => 'Wrong inputs, re-enter and retry agian.',
        ]);
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
    public function store(CreateBankRequest $request)
    {
        $bank = new Bank();
        $bank->name = $request->input('name');
        $bank->city = $request->input('city');
        $bank->country_id = $request->input('country_id') ?? (Country::where('admin_id', auth('admin')->user()->id)->first())->id;
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

        if ($isCreated) {
            // Store Logs
            $this->storeUserLogs('create bank');
            session([
                'created' => true,
                'title' => 'Bank Created',
                'message' => 'Bank ' . $request->input('name') . ' created successfully',
            ]);
            return redirect()->route('banks.index');
        } else {
            session([
                'created' => true,
                'title' => 'Failed',
                'message' => 'Failed to create new bank',
            ]);
            return redirect()->route('banks.create');
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
        // Store Logs
        $this->storeUserLogs('show edit bank');
        $countries = Country::where([
            ['admin_id', auth()->user()->id],
            ['active', '1'],
        ])->get();

        // Initial User Session
        session([
            'created' => false,
            'title' => 'Failed',
            'message' => 'Wrong inputs, re-enter and retry agian.',
        ]);
        return response()->view('back-end.banks.edit', [
            'bank' => $bank,
            'img' => DB::table('images')->where('bank_id', $bank->id)->first(),
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
    public function update(UpdateBankRequest $request, Bank $bank)
    {
        $bank->name = $request->input('name');
        $bank->city = $request->input('city');
        $bank->country_id = $request->input('country_id');
        $bank->active = $request->input('active');
        $isUpdated = $bank->save();
        if ($request->hasFile('sheek_image')) {
            //abc.png
            // Delete previos image
            Storage::delete('public/img/' . (DB::table('images')->select('img')->where('bank_id', $bank->id)->first())->img);

            // Set the new image for the bank "Laravel Storage"
            $sheekImageName = time() . '_sheek_images' . '.' . $request->file('sheek_image')->getClientOriginalExtension();
            $request->file('sheek_image')->storePubliclyAs('public/img/', $sheekImageName);

            // Store image
            DB::table('images')->where([
                ['bank_id', $bank->id]
            ])->update([
                'img' => $sheekImageName,
                'bank_id' => $bank->id,
            ]);
        }

        if ($isUpdated) {
            // Store Logs
            $this->storeUserLogs('edit bank');
            session([
                'created' => true,
                'title' => 'Success',
                'message' => 'Bank ' . $request->input('name') . ' updated successfully.',
            ]);
            return redirect()->route('banks.index');
        } else {
            session([
                'created' => false,
                'title' => 'Failed',
                'message' => 'Failed to update bank ' . $request->input('name') . '.',
            ]);
            return redirect()->route('banks.edit', $bank->id);
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

            // Store Logs
            $this->storeUserLogs('delete bank');
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

    public function showSpecificBanks(Country $country)
    {
        // Store Logs
        $this->storeUserLogs('show country\'s banks');
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
