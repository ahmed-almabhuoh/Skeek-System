<?php

namespace App\Http\Controllers;

use App\Models\Currancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportsController extends Controller
{
    //
    public function getCountryReport()
    {
        $countries = DB::table('static_countries')->get();

        $pdf = Pdf::loadView('reports.pdf.country-report', [
            'countries' => $countries,
        ]);
        return $pdf->download('country.pdf');
    }

    public function getAllStaticBanksReport()
    {
        $banks = DB::table('static_bank as banks')->get();
        foreach ($banks as $bank) {
            $country_name = DB::table('static_countries')->where('id', $bank->country_id)->first()->name;
            $country_name = DB::table('static_countries')->where('id', $bank->country_id)->first()->name;
            $currancy_name = Currancy::findOrFail($bank->currancy_id)->name;
            $bank->country_name = $country_name;
            $bank->currancy_name = $currancy_name;
        }

        $pdf = Pdf::loadView('reports.pdf.banks-report', [
            'banks' => $banks,
        ]);

        return $pdf->download('banks.pdf');
    }
}
