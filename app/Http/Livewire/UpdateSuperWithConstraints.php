<?php

namespace App\Http\Livewire;

use App\Models\Super;
use Livewire\Component;
use Illuminate\Support\Str;

class UpdateSuperWithConstraints extends Component
{
    public $super;
    public $userPasswordGeneration = false;
    public $password = '';

    public function mount(Super $super)
    {
        $this->super = $super;
    }

    public function render()
    {
        if ($this->userPasswordGeneration) {
            $this->password = Str::random(10);
        }
        return view('livewire.update-super-with-constraints');
    }
}
