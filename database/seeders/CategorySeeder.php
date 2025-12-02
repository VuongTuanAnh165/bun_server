<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryNames = [
            'Bún tươi',
            'Bánh cuốn',
            'Nguyên liệu',
        ];

        // Get all users with role = USER
        $users = User::where('role', Role::USER->value)->get();

        foreach ($users as $user) {
            foreach ($categoryNames as $name) {
                Category::create([
                    'name' => $name,
                    'slug' => Str::slug($name) . '-' . $user->id,
                    'description' => fake()->sentence(),
                    'image' => null,
                    'icon' => null,
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}


