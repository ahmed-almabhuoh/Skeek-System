<?php

namespace App\Http\Livewire;

use App\Models\Currancy;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchStaticBank extends Component
{
    public $searchTerm = '';

    public function render()
    {
        $static_banks = DB::table('static_bank')->where('name', 'LIKE', '%' . $this->searchTerm . '%')->paginate();
        $countries = DB::table('static_countries')->get();
        // scopeActive
        $currancies = Currancy::active()->get();

        return view('livewire.search-static-bank', [
            'banks' => $static_banks,
            'countries' => $countries,
            'currancies' => $countries,
        ]);
    }
}
