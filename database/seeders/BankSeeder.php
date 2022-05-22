<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Country;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Bank::create([
            'name' => 'Arab Islamic Bank',
            'country_id' => Country::inRandomOrder()->first()->id,
            'City' => 'Gaza',
        ]);
        Bank::create([
            'name' => 'Palestinian Islamic Bank',
            'country_id' => Country::inRandomOrder()->first()->id,
            'City' => 'Gaza',
        ]);
        Bank::create([
            'name' => 'Jordan Commercial Bank',
            'country_id' => Country::inRandomOrder()->first()->id,
            'City' => 'Gaza',
        ]);
        Bank::create([
            'name' => 'Palestinian Arab Bank',
            'country_id' => Country::inRandomOrder()->first()->id,
            'City' => 'Gaza',
        ]);
        Bank::create([
            'name' => 'Islamic National Bank',
            'country_id' => Country::inRandomOrder()->first()->id,
            'City' => 'Gaza',
        ]);
        Bank::create([
            'name' => 'National Bank',
            'country_id' => Country::inRandomOrder()->first()->id,
            'City' => 'Gaza',
        ]);
        Bank::create([
            'name' => 'Investment Bank',
            'country_id' => Country::inRandomOrder()->first()->id,
            'City' => 'Gaza',
        ]);
        Bank::create([
            'name' => 'Housing Bank',
            'country_id' => Country::inRandomOrder()->first()->id,
            'City' => 'Gaza',
        ]);
        Bank::create([
            'name' => 'Cairo Amman Bank',
            'country_id' => Country::inRandomOrder()->first()->id,
            'City' => 'Gaza',
        ]);
        Bank::create([
            'name' => 'Al Quds Bank',
            'country_id' => Country::inRandomOrder()->first()->id,
            'City' => 'Gaza',
        ]);
        Bank::create([
            'name' => 'Palestine bank',
            'country_id' => Country::inRandomOrder()->first()->id,
            'City' => 'Gaza',
        ]);

    }
}
