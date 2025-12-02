<?php

namespace Database\Seeders;

use App\Enums\Unit;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            return;
        }

        $products = [
            [
                'name' => 'Bún tươi loại 1',
                'unit' => Unit::KG,
                'price_per_unit' => 15000,
            ],
            [
                'name' => 'Bún tươi loại 2',
                'unit' => Unit::KG,
                'price_per_unit' => 12000,
            ],
            [
                'name' => 'Bún khô gói 500g',
                'unit' => Unit::PACK,
                'price_per_unit' => 25000,
            ],
        ];

        foreach ($products as $data) {
            // Create 3 products for each category
            foreach ($categories as $category) {
                Product::create([
                    'name' => $data['name'],
                    'slug' => Str::slug($data['name']) . '-' . $category->id,
                    'description' => fake()->sentence(),
                    'image' => null,
                    'icon' => null,
                    'price_per_unit' => $data['price_per_unit'],
                    'unit' => $data['unit']->value,
                    'tags' => null,
                    'content' => fake()->paragraph(),
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}


