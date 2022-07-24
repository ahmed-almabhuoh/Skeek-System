<?php

namespace Database\Seeders;

use App\Models\Super;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Super::factory(1)->create();
    }
}
