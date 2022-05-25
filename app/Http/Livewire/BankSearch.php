<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use Livewire\Component;

class BankSearch extends Component
{
    public $searchTerm;
    public $banks;

    public function mount () {
        $this->banks = Bank::where('admin_id', auth('admin')->user()->id)->get();
    }

    public function render()
    {
        $this->banks = Bank::where([
            ['admin_id', auth('admin')->user()->id],
            ['name', 'LIKE', '%' . $this->searchTerm . '%'],
        ])->get();
        return view('livewire.bank-search');
    }
}
