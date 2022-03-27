<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SheekFactory extends Factory
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
            'beneficiary_name' => $this->faker->word(),
            'amount' => $this->faker->numberBetween(100, 10000),
            'currancy' => $this->faker->randomElement(['paid', 'recived']),
            'desc' => $this->faker->word(),
        ];
    }
}
