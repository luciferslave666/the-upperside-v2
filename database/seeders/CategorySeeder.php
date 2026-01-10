<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Daftar Kategori dari Menu The Upperside
        $categories = [
            'Espresso Based',
            'Manual Brew',
            'Signature Coffee',
            'Variant Latte',
            'Desert & Ice Cream',
            'Our Signature',
            'Lite Bite',
            'Sharing',
            'Noodle',
            'Main Course',
            'Rice Bowl',
            'Western'
        ];

        foreach ($categories as $cat) {
            // Gunakan firstOrCreate agar tidak duplikat jika di-seed ulang
            Category::firstOrCreate(
                ['slug' => Str::slug($cat)],
                ['name' => $cat]
            );
        }
    }
}