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
    public $amount_in_words = '';
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
        ])->first())->id ?? 0;
        $this->bank = (Bank::where([
            ['admin_id', auth('admin')->user()->id],
        ])->first())->id ?? 0;
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
        if ($this->currany == 'Shakel') {
            $words = 'فقط ' . $words . ' شيكل لا غير';
        }else if ($this->currany == 'Dollar') {
            $words = 'فقط ' . $words . ' دولار لا غير';
        }else {
            $words = 'فقط ' . $words . ' دينار لا غير';
        }
        return $words;
    }

    public function render()
    {
        $this->amount_in_words = $this->convertNumber($this->amount);
        $this->country_id = (Country::where([
            ['admin_id', auth('admin')->user()->id],
        ])->first())->id ?? 0;
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
