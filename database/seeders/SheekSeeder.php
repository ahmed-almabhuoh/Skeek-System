<?php

namespace Database\Seeders;

use App\Models\Sheek;
use Illuminate\Database\Seeder;

class SheekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Sheek::factory(20)->create();
    }
}
