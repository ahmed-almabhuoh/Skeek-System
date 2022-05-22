<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => 'Ahmad',
            'email' => 'az540546@gmail.com',
            'country_id' => Country::inRandomOrder()->first()->id,
            'password' => Hash::make('password'),
        ];
    }
}
