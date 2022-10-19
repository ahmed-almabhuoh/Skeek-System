<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use Livewire\Component;

class AdminSearchTable extends Component
{
    public $searchTerm = '';

    public function render()
    {
        $admins = Admin::where('name', 'LIKE', '%' . $this->searchTerm . '%')->paginate();

        return view('livewire.admin-search-table', ['admins' => $admins]);
    }
}
