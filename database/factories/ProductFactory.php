<?php
// File: database/factories/ProductFactory.php

namespace Database\Factories;

use App\Models\Category; // <-- Jangan lupa import
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Kita akan tentukan category_id di Seeder
            'category_id' => Category::factory(), 
            
            'name' => ucwords($this->faker->words(3, true)), // Misal: "Kopi Susu Enak"
            'description' => $this->faker->sentence(10),
            'image' => null, // Biarkan null dulu agar cepat
            
            // Harga realistis (kelipatan 1000, antara 15rb - 60rb)
            'price' => $this->faker->numberBetween(15, 60) * 1000, 
            
            // 90% kemungkinan produk ini tersedia
            'is_available' => $this->faker->boolean(90), 
        ];
    }
}