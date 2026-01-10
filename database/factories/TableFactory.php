<?php
// File: database/factories/TableFactory.php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Nama default akan kita timpa (override) di Seeder
            'name' => 'Meja ' . $this->faker->unique()->numberBetween(1, 100),
        ];
    }
}