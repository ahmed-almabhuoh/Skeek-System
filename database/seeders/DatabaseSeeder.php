<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // Bank::factory(1)->create();
        Bank::create([
            'name' => 'New Bank',
            'country' => 'German',
            'City' => 'Gaza',
        ]);
    }
}
