<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SearchForRecivedSheek extends Component
{
    public $searchTerm;
    public $sheeks;

    public function mount () {
        $this->sheeks = \App\Models\Sheek::where([
            ['admin_id', auth('admin')->user()->id],
            ['type', 'LIKE', 'recived'],
        ])->get();
    }

    public function render()
    {
        $this->sheeks = \App\Models\Sheek::where([
            ['admin_id', auth('admin')->user()->id],
            ['type', 'LIKE', 'recived'],
            ['beneficiary_name', 'LIKE', '%' . $this->searchTerm . '%'],
        ])->get();
        return view('livewire.search-for-recived-sheek');
    }
}
