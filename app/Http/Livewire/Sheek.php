<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Sheek extends Component
{
    public $beneficiary_name = '';
    public $amount = 0;
    public $currany = 'Shakel';
    public $bank = 1;
    public $banks = [];
    public $country_id;
    public $countries = [];
    public $desc;
    public $line_type = 0;
    public $underline;
    public $date;

    public function mount()
    {
        $this->countries = Country::where([
            ['admin_id', auth('admin')->user()->id],
            ['active', '1'],
        ])->get();
        $this->country_id = (Country::where([
            ['admin_id', auth('admin')->user()->id],
        ])->first())->id;
    }
    public function render()
    {
        $this->country_id = (Country::where([
            ['admin_id', auth('admin')->user()->id],
        ])->first())->id;
        $this->banks = Bank::where('country_id', $this->country_id)->get();
        $image_name = DB::table('images')->select('img')->where('bank_id', $this->bank)->first();

        if ($this->line_type == 1) {
            $this->underline = '//';
        }else if ($this->line_type == 2) {
            $this->underline = 'يصرف للعميل الأول';
        }else if ($this->line_type == 3) {
            $this->underline = 'غير قابل للصرف';
        }else {
            $this->underline = '';
        }

        return view('livewire.sheek', [
            'image_name' => 'img/' . $image_name->img,
        ]);
    }
}
