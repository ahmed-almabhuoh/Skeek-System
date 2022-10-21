<?php

namespace App\Http\Livewire;

use App\Models\Super;
use Livewire\Component;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AddSuperWithConstraintsForModal extends Component
{
    public $userPasswordGenerator = false;
    public $super_password = '';
    public $roles;
    public $name = '';
    public $role_id = 0;
    public $email = '';
    public $emailIsExists = false;

    public function render()
    {
        if ($this->userPasswordGenerator) {
            $this->super_password = Str::random(10);
        }

        if (Super::where('email', '=', $this->email)->count()) {
            $this->emailIsExists = true;
        } else {
            $this->emailIsExists = false;
        }

        $this->roles = Role::get();
        return view('livewire.add-super-with-constraints-for-modal');
    }
}
