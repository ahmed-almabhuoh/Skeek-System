<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditSheek extends Component
{
    // Sheek Property
    public $sheek;
    public $beneficiary_name;
    public $amount;
    public $amount_in_word;
    public $currancy = 'Shakel';
    public $bank;
    public $banks;
    public $country;
    public $countries;
    public $selected_country_id = 1;
    public $selected_bank_id = 1;
    public $line_type = 1;
    public $desc = '';
    public $image_name;
    public $date;

    public function mount()
    {
        $this->beneficiary_name = $this->sheek->beneficiary_name;
        $this->amount = $this->sheek->amount;
        $this->currancy = $this->sheek->currancy;
        $this->country = Country::where('id', $this->selected_bank_id)->first();
        $this->countries = Country::where([
            ['admin_id', auth('admin')->user()->id],
            ['active', 1],
        ])->get();
        $this->line_type = $this->sheek->underline_type;
        $this->desc = $this->sheek->desc;
        $this->selected_bank_id = $this->sheek->bank_id;
        $this->date = $this->sheek->date;
    }

    // Converter function from number to word
    public function convertNumber($num = false)
    {
        $num = str_replace(array(',', ''), '' , trim($num));
        if(! $num) {
            return false;
        }
        $num = (int) $num;
        $words = array();
        $list1 = array('', 'واحد', 'اثنان', 'ثلاثة', 'أربعة', 'خمسة', 'ستة', 'سبعة', 'ثمانية', 'تسعة', 'عشرة', 'احدى عشر',
            'اثنا عشر', 'ثلاثة عشر', 'أربعة عشر', 'خمسة عشر', 'ستة عشر', 'سبعة عشر', 'ثمانية عشر', 'تسعة عشر'
        );
        $list2 = array('', 'عشرة', 'عشرون', 'ثلاثون', 'أربعون', 'خمسون', 'ستون', 'سبعون', 'ثمانون', 'تسعون', 'مائة');
        $list3 = array('', 'ألف', 'مليون', 'مليار', 'تريليون', 'كوارديليون', 'كوانتيليون', 'سكستيليون', 'سبتيليون',
            'أوكتيليون', 'نونيليون', 'ديسيليون', 'أنديسيليون', 'دوودوسيليون', 'تريديليون', 'كواتورديليون',
            'كوينديليون', 'سيكسديسليون', 'سبتينديليون', 'أوكتوسيليون', 'نوفومديسيلون', 'فيجينتليون'
        );
        $num_length = strlen($num);
        $levels = (int) (($num_length + 2) / 3);
        $max_length = $levels * 3;
        $num = substr('00' . $num, -$max_length);
        $num_levels = str_split($num, 3);
        for ($i = 0; $i < count($num_levels); $i++) {
            $levels--;
            $hundreds = (int) ($num_levels[$i] / 100);
            $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' مائة' . ( $hundreds == 1 ? '' : '' ) . ' ' : '');
            $tens = (int) ($num_levels[$i] % 100);
            $singles = '';
            if ( $tens < 20 ) {
                $tens = ($tens ? ' و ' . $list1[$tens] . ' ' : '' );
            } elseif ($tens >= 20) {
                $tens = (int)($tens / 10);
                $tens = ' و ' . $list2[$tens] . ' ';
                $singles = (int) ($num_levels[$i] % 10);
                $singles = ' ' . $list1[$singles] . ' ';
            }
            $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
        } //end for loop
        $commas = count($words);
        if ($commas > 1) {
            $commas = $commas - 1;
        }
        $words = implode(' ',  $words);
        $words = preg_replace('/^\s\b(و)/', '', $words );
        $words = trim($words);
        $words = ucfirst($words);
        if ($this->currancy == 'Shakel') {
            $words = 'فقط ' . $words . ' شيكل لا غير';
        }else if ($this->currancy == 'Dollar') {
            $words = 'فقط ' . $words . ' دولار لا غير';
        }else {
            $words = 'فقط ' . $words . ' دينار لا غير';
        }
        return $words;
    }

    public function render()
    {
        $this->amount_in_word = $this->convertNumber($this->amount);
        $this->image_name = 'img/' . (DB::table('images')->select('img')->where('bank_id', $this->selected_bank_id)->first())->img;
        $this->banks = Bank::where('country_id', $this->selected_country_id)->get();
        $this->bank = Bank::where('id', $this->selected_bank_id)->first();
        return view('livewire.edit-sheek');
    }
}
