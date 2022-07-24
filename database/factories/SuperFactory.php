<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class SuperFactory extends Factory
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
            'name' => 'Ahmad Almabhoh',
            'email' => 'az54546@gmail.com',
            'password' => Hash::make('Laravel0599!'),
        ];
    }
}
