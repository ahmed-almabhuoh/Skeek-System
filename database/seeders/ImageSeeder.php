<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('images')->insert(['img' => '', 'bank_id' => '']);

        //
        DB::table('images')->insert(['img' => 'Arab Islamic Bank.jpg', 'bank_id' => '1']);
        DB::table('images')->insert(['img' => 'Palestinian Islamic Bank.jpg', 'bank_id' => '2']);
        DB::table('images')->insert(['img' => 'Jordan Commercial Bank.jpg', 'bank_id' => '3']);
        DB::table('images')->insert(['img' => 'Palestinian Arab Bank.jpg', 'bank_id' => '4']);
        DB::table('images')->insert(['img' => 'Islamic National Bank.jpg', 'bank_id' => '5']);
        DB::table('images')->insert(['img' => 'National Bank.jpg', 'bank_id' => '6']);
        DB::table('images')->insert(['img' => 'Investment Bank.jpg', 'bank_id' => '7']);
        DB::table('images')->insert(['img' => 'Housing Bank.jpg', 'bank_id' => '8']);
        DB::table('images')->insert(['img' => 'Cairo Amman Bank.jpg', 'bank_id' => '9']);
        DB::table('images')->insert(['img' => 'Al Quds Bank.jpg', 'bank_id' => '10']);
        DB::table('images')->insert(['img' => 'Palestine bank.jpg', 'bank_id' => '11']);
    }
}
