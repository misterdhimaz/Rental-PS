<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Console;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ConsoleSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua kategori yang sudah dibuat oleh CategorySeeder
        $categories = Category::all();

        foreach ($categories as $cat) {
            // Tentukan harga default berdasarkan kategori
            $price = 0;
            $subName = "";

            if ($cat->name == 'PS5') {
                $price = 15000;
                $subName = "PRO VIP";
            } elseif ($cat->name == 'PS4') {
                $price = 8000;
                $subName = "SLIM PRO";
            } elseif ($cat->name == 'PS3') {
                $price = 5000;
                $subName = "SUPER SLIM";
            } elseif ($cat->name == 'PS2') {
                $price = 3000;
                $subName = "MATRIX LEGACY";
            }

            // Buat 5 unit untuk setiap kategori
            for ($i = 1; $i <= 5; $i++) {
                $unitName = "{$cat->name} {$subName} 0{$i}";

                Console::create([
                    'name' => $unitName,
                    'slug' => Str::slug($unitName) . '-' . Str::random(3),
                    'category_id' => $cat->id,
                    'price_per_hour' => $price,
                    'status' => 'available'
                ]);
            }
        }
    }
}
