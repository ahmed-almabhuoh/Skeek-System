<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EditSheek extends Component
{
    // Sheek Property
    public $sheek;
    public $beneficiary_name;
    public $amount;
    public $bank_name;
    public $currancy;
    public $desc;
    public $type;
    public $sheek_id;

    public function mount ($sheek) {
        $this->sheek = $sheek;
        $this->beneficiary_name = $this->sheek->beneficiary_name;
        $this->amount = $this->sheek->amount;
        $this->bank_name = $this->sheek->bank_name;
        $this->currancy = $this->sheek->currancy;
        $this->desc = $this->sheek->desc;
        $this->type = $this->sheek->type;
        $this->sheek_id = $this->sheek->id;
    }

    public function render()
    {
        return view('livewire.edit-sheek');
    }
}
