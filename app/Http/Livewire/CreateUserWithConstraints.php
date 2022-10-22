<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;

class CreateUserWithConstraints extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $emailIsExists = false;
    public $usePasswordGenerator = false;

    public function render()
    {
        if ($this->usePasswordGenerator) {
            $this->password = Str::random(10);
        }
        return view('livewire.create-user-with-constraints');
    }
}
