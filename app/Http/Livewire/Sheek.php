<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class Sheek extends Component
{
    public $beneficiary_name = '';
    public $amount = 1;
    public $amount_in_words = '';
    public $currany;
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
        ])->first())->id ?? 0;
        $this->bank = (Bank::where([
            ['admin_id', auth('admin')->user()->id],
        ])->first())->id ?? 0;
    }

    public function another()
    {
        if ($this->amount == '')
            $this->amount = 1;
            
        $Arabic = new \ArPHP\I18N\Arabic();

        $Arabic->setNumberFeminine(1);
        $Arabic->setNumberFormat(1);

        $integer = $this->amount;

        $text = $Arabic->int2str($integer);

        if ($this->currany == 'Shakel') {
            $text = 'فقط ' . $text . ' شيكل لا غير';
        } else if ($this->currany == 'Dollar') {
            $text = 'فقط ' . $text . ' دولار لا غير';
        } else {
            $text = 'فقط ' . $text . ' دينار لا غير';
        }

        return $text;
    }

    public function render()
    {
        $this->amount_in_words = $this->another();
        $this->country_id = (Country::where([
            ['admin_id', auth('admin')->user()->id],
            ['id', $this->country_id],
        ])->first())->id ?? 0;
        $this->banks = Bank::where('country_id', $this->country_id)->get();
        $image_name = DB::table('images')->select('img')->where('bank_id', $this->bank)->first();

        if ($this->line_type == 1) {
            $this->underline = '//';
        } else if ($this->line_type == 2) {
            $this->underline = 'يصرف للعميل الأول';
        } else if ($this->line_type == 3) {
            $this->underline = 'غير قابل للصرف';
        } else {
            $this->underline = '';
        }

        if (!($this->country_id == 0))
            if (is_null($image_name))
                return view('livewire.sheek', [
                    'message' => 'You have no bank',
                ]);
            else
                return view('livewire.sheek', [
                    'image_name' => 'img/' . $image_name->img,
                    'message' => null,
                ]);
        else
            return view('livewire.sheek', [
                'message' => 'You have no country',
            ]);
    }
}
