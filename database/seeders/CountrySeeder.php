<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Country::create([
            'name' => 'Palestine',
            'admin_id' => Admin::inRandomOrder()->first()->id,
        ]);
    }
}
