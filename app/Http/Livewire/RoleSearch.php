<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleSearch extends Component
{
    public $searchTerm = '';
    protected $roles;

    public function mount($roles)
    {
        $this->roles = $roles;
    }
    public function render()
    {
        $this->roles = Role::where('name', 'LIKE', '%' . $this->searchTerm . '%')->withCount('permissions')->paginate();
        return view('livewire.role-search', [
            'roles' => $this->roles,
        ]);
    }
}
