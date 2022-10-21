<?php

namespace App\Http\Livewire;

use App\Models\Super;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class CreateSuperConstraints extends Component
{
    public $roles;
    public $usePasswordGenerator = false;
    public $password = '';
    public $name = '';
    public $role_id = 0;
    public $email = '';
    public $emailIsExists = false;

    public function render()
    {
        $this->roles = Role::get();
        if ($this->usePasswordGenerator) {
            $this->password = Str::random(10);
        }

        if (Super::where('email', '=', $this->email)->count()) {
            $this->emailIsExists = true;
        }else {
            $this->emailIsExists = false;
        }
        return view('livewire.create-super-constraints');
    }
}
