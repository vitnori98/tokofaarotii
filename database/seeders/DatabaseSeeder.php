<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat Kategori
        $frozen = Category::create(['name' => 'Frozen']);
        $bakery = Category::create(['name' => 'Bakery']);

        // Buat Produk Frozen
        Product::create([
            'category_id' => $frozen->id,
            'name' => 'Nugget Ayam',
            'description' => 'Nugget ayam premium',
            'price' => 25000,
            'unit' => 'Pack',
        ]);

        Product::create([
            'category_id' => $frozen->id,
            'name' => 'Sosis Sapi',
            'description' => 'Sosis sapi berkualitas',
            'price' => 30000,
            'unit' => 'Pack',
        ]);

        // Buat Produk Bakery
        Product::create([
            'category_id' => $bakery->id,
            'name' => 'Roti Tawar',
            'description' => 'Roti tawar lembut',
            'price' => 15000,
            'unit' => 'Pcs',
        ]);

        Product::create([
            'category_id' => $bakery->id,
            'name' => 'Donat',
            'description' => 'Donat manis lembut',
            'price' => 5000,
            'unit' => 'Pcs',
        ]);
    }
}