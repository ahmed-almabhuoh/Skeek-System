<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Sheek;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class SheekController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Sheek::class, 'sheek');
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
        $this->storeUserLogs('show sheeks');
        $sheeks = Sheek::where('admin_id', auth()->user()->id)->with('bank')->get();
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
        // Store Logs
        $this->storeUserLogs('show create sheek');
        // $banks = Bank::all();
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
        $validator = Validator($request->only([
            'beneficiary_name',
            'amount',
            'currancy',
            'bank_id',
            'desc',
            'type',
            'underline_type',
            'date',
        ]), [
            'beneficiary_name' => 'required|string|min:5|max:50',
            'amount' => 'required|integer|min:1',
            'currancy' => 'required|string|in:Dollar,Dinar,Shakel',
            'bank_id' => 'required|integer|exists:banks,id',
            'desc' => 'nullable',
            'underline_type' => 'required|integer|in:1,2,3',
            'type' => 'required|string|in:paid,recived',
            'date' => 'required|string|min:6|max:20',
        ], [
            'bank_id.required' => 'You have to choose a bank',
        ]);
        //
        if (!$validator->fails()) {
            $sheek = new Sheek();
            $sheek->beneficiary_name = $request->input('beneficiary_name');
            $sheek->amount = $request->input('amount');
            $sheek->currancy = $request->input('currancy');
            $sheek->bank_id = $request->input('bank_id');
            $sheek->desc = $request->input('desc');
            $sheek->type = $request->input('type');
            // $sheek->img = DB::table('images')->select('id')->where('bank_id', $request->input('bank_id'))->first();
            $sheek->img = (DB::table('images')->select('id')->where('bank_id', $request->input('bank_id'))->first())->id;
            $sheek->underline_type = $request->input('underline_type');
            $sheek->date = $request->input('date');
            $sheek->admin_id = auth()->user()->id;
            $isCreated = $sheek->save();

            // Store Logs
            $this->storeUserLogs('create sheek');
            return response()->json([
                'message' => $isCreated ? 'Sheed added successfylly' : 'Faild to add sheek',
            ], $isCreated ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
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
        // Store Logs
        $this->storeUserLogs('show edit sheek');
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
        $validator = Validator($request->only([
            'beneficiary_name',
            'amount',
            'currancy',
            'bank_id',
            'desc',
            'type',
            'underline_type',
            'date',
        ]), [
            'beneficiary_name' => 'required|string|min:5|max:50',
            'amount' => 'required|integer|min:1',
            'currancy' => 'required|string|in:Dollar,Dinar,Shakel',
            'bank_id' => 'required|integer|exists:banks,id',
            'desc' => 'nullable',
            'type' => 'required|string|in:paid,recived',
            'underline_type' => 'required|integer|in:1,2,3',
            'date' => 'required|string',
        ]);
        //
        if (!$validator->fails()) {
            $sheek->beneficiary_name = $request->input('beneficiary_name');
            $sheek->amount = $request->input('amount');
            $sheek->currancy = $request->input('currancy');
            $sheek->bank_id = $request->input('bank_id');
            $sheek->desc = $request->input('desc');
            $sheek->type = $request->input('type');
            // $sheek->img = DB::table('images')->select('id')->where('bank_id', $request->input('bank_id'))->first();
            $sheek->img = (DB::table('images')->select('id')->where('bank_id', $request->input('bank_id'))->first())->id;
            $sheek->underline_type = $request->input('underline_type');
            $sheek->date = $request->input('date');
            $isUpdated = $sheek->save();

            // Store Logs
            $this->storeUserLogs('update sheek');

            return response()->json([
                'message' => $isUpdated ? 'Sheek updated successfully' : 'Faild to update sheek',
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
     * @param  \App\Models\Sheek  $sheek
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sheek $sheek)
    {
        //
        if ($sheek->delete()) {
            // Store Logs
            $this->storeUserLogs('delete sheek');
            return response()->json([
                'icon' => 'success',
                'title' => 'Deleted',
                'text' => 'Sheek deleted successfully',
            ]);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => 'Faild!',
                'text' => 'Faild to delete sheek',
            ]);
        }
    }

    public function statisics()
    {
        // Store Logs
        $this->storeUserLogs('dispaly sheeks statics');
        $recived_sheek_num = Sheek::where([
            ['admin_id', auth('admin')->user()->id],
            ['type', 'recived'],
        ])->count();

        $paid_sheek_num = Sheek::where([
            ['admin_id', auth('admin')->user()->id],
            ['type', 'paid'],
        ])->count();

        $amount_paid_sheek = Sheek::where([
            ['admin_id', auth('admin')->user()->id],
            ['type', 'paid'],
        ])->sum('amount');

        $amount_recived_sheek = Sheek::where([
            ['admin_id', auth('admin')->user()->id],
            ['type', 'recived'],
        ])->sum('amount');

        return response()->view('back-end.home', [
            'recived_sheek_num' => $recived_sheek_num ?? 0,
            'paid_sheek_num' => $paid_sheek_num ?? 0,
            'amount_paid_sheek' => $amount_paid_sheek ?? 0,
            'amount_recived_sheek' => $amount_recived_sheek ?? 0,
        ]);
    }

    public function recivedSheek()
    {
        $sheeks = Sheek::where([
            ['type', 'recived'],
            ['admin_id', auth('admin')->user()->id],
        ])->get();
        return response()->view('back-end.sheek.search-for-recived-sheek', [
            'sheeks' => $sheeks,
        ]);
    }

    public function paidSheeks()
    {
        $sheeks = Sheek::where([
            ['type', 'recived'],
            ['admin_id', auth('admin')->user()->id],
        ])->get();
        return response()->view('back-end.sheek.search-for-paid-sheek', [
            'sheeks' => $sheeks,
        ]);
    }
}
