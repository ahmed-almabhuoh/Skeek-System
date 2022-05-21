<?php

namespace Database\Seeders;

use App\Models\Bank;
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
            'country' => 'Palestine',
            'City' => 'Gaza',
        ]);
        Bank::create([
            'name' => 'Palestinian Islamic Bank',
            'country' => 'Palestine',
            'City' => 'Gaza',
        ]);
        Bank::create([
            'name' => 'Jordan Commercial Bank',
            'country' => 'Palestine',
            'City' => 'Gaza',
        ]);
        Bank::create([
            'name' => 'Palestinian Arab Bank',
            'country' => 'Palestine',
            'City' => 'Gaza',
        ]);
        Bank::create([
            'name' => 'Islamic National Bank',
            'country' => 'Palestine',
            'City' => 'Gaza',
        ]);
        Bank::create([
            'name' => 'National Bank',
            'country' => 'Palestine',
            'City' => 'Gaza',
        ]);
        Bank::create([
            'name' => 'Investment Bank',
            'country' => 'Palestine',
            'City' => 'Gaza',
        ]);
        Bank::create([
            'name' => 'Housing Bank',
            'country' => 'Palestine',
            'City' => 'Gaza',
        ]);
        Bank::create([
            'name' => 'Cairo Amman Bank',
            'country' => 'Palestine',
            'City' => 'Gaza',
        ]);
        Bank::create([
            'name' => 'Al Quds Bank',
            'country' => 'Palestine',
            'City' => 'Gaza',
        ]);
        Bank::create([
            'name' => 'Palestine bank',
            'country' => 'Palestine',
            'City' => 'Gaza',
        ]);
    }
}
