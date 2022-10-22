<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateUserWithConstraintsForModal extends Component
{
    public $userPasswordGenerator = false;
    public $password = '';
    public $name = '';
    public $email = '';
    public $emailIsExists = false;

    public function render()
    {
        if ($this->userPasswordGenerator) {
            $this->password = Str::random(10);
        }

        if (Admin::where('email', '=', $this->email)->count()) {
            $this->emailIsExists = true;
        } else {
            $this->emailIsExists = false;
        }
        return view('livewire.create-user-with-constraints-for-modal');
    }
}
