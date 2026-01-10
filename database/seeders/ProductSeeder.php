<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // 1. Ambil ID kategori berdasarkan slug untuk referensi
        // Array akan berbentuk: ['espresso-based' => 1, 'manual-brew' => 2, ...]
        $catIds = Category::pluck('id', 'slug')->toArray();

        $products = [
            // --- ESPRESSO BASED ---
            [
                'category' => 'espresso-based',
                'name' => 'Espresso',
                'description' => 'Single shot espresso yang kuat',
                'price' => 20000,
            ],
            [
                'category' => 'espresso-based',
                'name' => 'Espresso Cubano',
                'description' => 'Espresso dengan campuran gula saat ekstraksi',
                'price' => 20000,
            ],
            [
                'category' => 'espresso-based',
                'name' => 'Piccolo',
                'description' => 'Latte kecil dengan rasa kopi yang lebih kuat',
                'price' => 25000,
            ],
            [
                'category' => 'espresso-based',
                'name' => 'Cappucino',
                'description' => 'Espresso, susu panas, dan busa susu yang tebal',
                'price' => 26000,
            ],
            [
                'category' => 'espresso-based',
                'name' => 'Mochacino',
                'description' => 'Perpaduan espresso, cokelat, dan susu',
                'price' => 28000,
            ],
            [
                'category' => 'espresso-based',
                'name' => 'Americano',
                'description' => 'Espresso dengan tambahan air panas',
                'price' => 22000,
            ],

            // --- MANUAL BREW ---
            [
                'category' => 'manual-brew',
                'name' => 'V60',
                'description' => 'Seduhan manual pour-over dengan filter kertas',
                'price' => 30000,
            ],
            [
                'category' => 'manual-brew',
                'name' => 'Japanesse',
                'description' => 'Kopi seduh manual metode Jepang dingin',
                'price' => 30000,
            ],
            [
                'category' => 'manual-brew',
                'name' => 'Japanesse (SP Beans)',
                'description' => 'Japanesse ice coffee dengan biji kopi spesial',
                'price' => 35000,
            ],
            [
                'category' => 'manual-brew',
                'name' => 'Japanesse Lemon',
                'description' => 'Japanesse ice coffee dengan sentuhan lemon segar',
                'price' => 30000,
            ],

            // --- SIGNATURE COFFEE ---
            [
                'category' => 'signature-coffee',
                'name' => 'Empire States',
                'description' => 'Kopi susu gula aren signature',
                'price' => 22000,
            ],
            [
                'category' => 'signature-coffee',
                'name' => 'Choco Empire',
                'description' => 'Perpaduan kopi signature dengan cokelat',
                'price' => 27000,
            ],
            [
                'category' => 'signature-coffee',
                'name' => 'Strawberry Tokyo',
                'description' => 'Kopi susu creamy dengan rasa strawberry',
                'price' => 25000,
            ],
            [
                'category' => 'signature-coffee',
                'name' => 'Empire Banana',
                'description' => 'Kopi susu dengan rasa pisang yang unik',
                'price' => 27000,
            ],

            // --- VARIANT LATTE ---
            [
                'category' => 'variant-latte',
                'name' => 'Berry Latte',
                'description' => 'Latte lembut dengan rasa berry',
                'price' => 30000,
            ],
            [
                'category' => 'variant-latte',
                'name' => 'Kyoto Latte',
                'description' => 'Latte dengan campuran Matcha premium',
                'price' => 33000,
            ],
            [
                'category' => 'variant-latte',
                'name' => 'Kuroo Latte',
                'description' => 'Charcoal latte yang unik',
                'price' => 33000,
            ],
            [
                'category' => 'variant-latte',
                'name' => 'Caramel Latte',
                'description' => 'Latte dengan sirup karamel manis',
                'price' => 30000,
            ],
            [
                'category' => 'variant-latte',
                'name' => 'Hazelnut Latte',
                'description' => 'Latte dengan aroma kacang hazelnut',
                'price' => 30000,
            ],
            [
                'category' => 'variant-latte',
                'name' => 'Vanilla Latte',
                'description' => 'Latte klasik dengan aroma vanilla',
                'price' => 30000,
            ],
            [
                'category' => 'variant-latte',
                'name' => 'Cheese Latte',
                'description' => 'Latte dengan topping krim keju gurih',
                'price' => 35000,
            ],

            // --- DESERT & ICE CREAM (Slug: desert-ice-cream) ---
            [
                'category' => 'desert-ice-cream',
                'name' => 'Matcha Rush',
                'description' => 'Dessert matcha yang menyegarkan',
                'price' => 28000,
            ],
            [
                'category' => 'desert-ice-cream',
                'name' => 'Triple Choco',
                'description' => 'Dessert cokelat berlapis',
                'price' => 28000,
            ],

            // --- OUR SIGNATURE ---
            [
                'category' => 'our-signature',
                'name' => 'Pineapple Pie',
                'description' => 'Mocktail Pineapple Jus dengan Cheese Foam yang legit, cocok buat yang lagi santai',
                'price' => 25000,
            ],
            [
                'category' => 'our-signature',
                'name' => 'Summer Sweet',
                'description' => 'Mocktail Teh Sweet & Sour, dengan Buah Peach, Cherry dan Madu bikin hari kamu menyenangkan',
                'price' => 25000,
            ],
            [
                'category' => 'our-signature',
                'name' => 'Pandora',
                'description' => 'Mocktail kopi dengan Pineapple, Lemon dan Orange yang nyegerin, cocok buat kamu yang lagi butuh energy yang fun',
                'price' => 28000,
            ],
            [
                'category' => 'our-signature',
                'name' => 'Simmer',
                'description' => 'Mocktail dari buah Delima dan Teh telang dengan hint Mint yang nyaman buat lewatin harimu',
                'price' => 25000,
            ],
            [
                'category' => 'our-signature',
                'name' => 'Cupid',
                'description' => 'One of a Kind Mocktail Coconut Water dan Strawberry yang bikin hari hari mu bersemangat',
                'price' => 30000,
            ],

            // --- LITE BITE ---
            [
                'category' => 'lite-bite',
                'name' => 'Banana Katsu',
                'description' => 'Pisang goreng tepung ala katsu',
                'price' => 28000,
            ],
            [
                'category' => 'lite-bite',
                'name' => 'French Fries',
                'description' => 'Kentang goreng renyah',
                'price' => 22000,
            ],
            [
                'category' => 'lite-bite',
                'name' => 'Upperside Mix Platter',
                'description' => 'Campuran sosis, kentang, dan nugget',
                'price' => 30000,
            ],
            [
                'category' => 'lite-bite',
                'name' => 'Tahu Lada Garam',
                'description' => 'Tahu goreng dengan bumbu lada garam pedas gurih',
                'price' => 22000,
            ],
            [
                'category' => 'lite-bite',
                'name' => 'Banana Snow',
                'description' => 'Pisang goreng dengan taburan gula halus',
                'price' => 22000,
            ],
            [
                'category' => 'lite-bite',
                'name' => 'Chicken Wings',
                'description' => 'Sayap ayam goreng bumbu spesial',
                'price' => 30000,
            ],

            // --- SHARING ---
            [
                'category' => 'sharing',
                'name' => 'Tahu Lada Garam L',
                'description' => 'Porsi besar Tahu Lada Garam untuk berbagi',
                'price' => 30000,
            ],
            [
                'category' => 'sharing',
                'name' => 'Upperside Mix Platter L',
                'description' => 'Porsi besar Mix Platter untuk berbagi',
                'price' => 45000,
            ],
            [
                'category' => 'sharing',
                'name' => 'French Fries L',
                'description' => 'Porsi besar Kentang Goreng',
                'price' => 30000,
            ],

            // --- NOODLE ---
            [
                'category' => 'noodle',
                'name' => 'Mie Tek Tek The Upperside Kuah',
                'description' => 'Mie kuah tradisional dengan bumbu spesial Upperside',
                'price' => 30000,
            ],
            [
                'category' => 'noodle',
                'name' => 'Mie Tek Tek The Upperside Goreng',
                'description' => 'Mie goreng tradisional dengan bumbu spesial Upperside',
                'price' => 30000,
            ],

            // --- MAIN COURSE ---
            [
                'category' => 'main-course',
                'name' => 'Sop Iga Nusantara',
                'description' => 'Sop iga sapi kuah rempah nusantara',
                'price' => 65000,
            ],
            [
                'category' => 'main-course',
                'name' => 'Iga Bakar Upperside',
                'description' => 'Iga sapi bakar dengan bumbu kecap spesial',
                'price' => 65000,
            ],
            [
                'category' => 'main-course',
                'name' => 'Nasi Goreng Manhattan',
                'description' => 'Nasi goreng gaya western',
                'price' => 30000,
            ],
            [
                'category' => 'main-course',
                'name' => 'Nasi Goreng Kampung',
                'description' => 'Nasi goreng tradisional dengan ikan teri',
                'price' => 30000,
            ],
            [
                'category' => 'main-course',
                'name' => 'Nasi Goreng Katsu',
                'description' => 'Nasi goreng dengan topping chicken katsu',
                'price' => 35000,
            ],
            [
                'category' => 'main-course',
                'name' => 'Chicken Katsu Scramble Egg',
                'description' => 'Nasi ayam katsu dengan telur orak-arik',
                'price' => 37000,
            ],
            [
                'category' => 'main-course',
                'name' => 'Chicken Katsu Chili Garlic',
                'description' => 'Nasi ayam katsu dengan bumbu bawang pedas',
                'price' => 35000,
            ],

            // --- RICE BOWL ---
            [
                'category' => 'rice-bowl',
                'name' => 'Rice Bowl Beef Blackpapper',
                'description' => 'Nasi dengan daging sapi lada hitam',
                'price' => 37000,
            ],
            [
                'category' => 'rice-bowl',
                'name' => 'Rice Bowl Beef Teriyaki',
                'description' => 'Nasi dengan daging sapi saus teriyaki',
                'price' => 37000,
            ],
            [
                'category' => 'rice-bowl',
                'name' => 'Rice Bowl Chicken Teriyaki',
                'description' => 'Nasi dengan ayam saus teriyaki',
                'price' => 30000,
            ],
            [
                'category' => 'rice-bowl',
                'name' => 'Rice Bowl Chicken Blackpapper',
                'description' => 'Nasi dengan ayam lada hitam',
                'price' => 30000,
            ],

            // --- WESTERN ---
            [
                'category' => 'western',
                'name' => 'Spagheti Aglio e Olio',
                'description' => 'Pasta dengan bawang putih dan minyak zaitun',
                'price' => 30000,
            ],
            [
                'category' => 'western',
                'name' => 'Spagheti Carbonara',
                'description' => 'Pasta dengan saus krim dan keju',
                'price' => 30000,
            ],
            [
                'category' => 'western',
                'name' => 'Spagheti Bolognese',
                'description' => 'Pasta dengan saus daging tomat',
                'price' => 30000,
            ],
            [
                'category' => 'western',
                'name' => 'Chicken Cordon Bleu',
                'description' => 'Dada ayam isi keju dan daging asap',
                'price' => 40000,
            ],
            [
                'category' => 'western',
                'name' => 'With Fries/Rice',
                'description' => 'Menu tambahan nasi atau kentang',
                'price' => 40000,
            ],
        ];

        foreach ($products as $p) {
            // Kita gunakan Str::slug untuk memastikan formatnya sama dengan di CategorySeeder
            $slug = Str::slug($p['category']); 
            
            // Cek apakah kategori ada di database
            if (isset($catIds[$slug])) {
                Product::create([
                    'category_id' => $catIds[$slug], // Ambil ID dari array
                    'name' => $p['name'],
                    'description' => $p['description'],
                    'price' => $p['price'],
                    'is_available' => true,
                    'image' => null,
                ]);
            }
        }
    }
}