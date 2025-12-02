<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => Role::ADMIN->value,
            'status' => UserStatus::ACTIVE->value,
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'iframe_map' => null,
            'content' => fake()->paragraph(),
        ]);

        // Some regular users (owners of customers)
        $owners = User::factory(10)->create([
            'role' => Role::USER->value,
            'status' => UserStatus::ACTIVE->value,
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'iframe_map' => null,
            'content' => fake()->paragraph(),
        ]);

        // Some customers with mixed statuses
        foreach (range(1, 5) as $_) {
            $owner = $owners->random();

            User::factory()->create([
                'role' => Role::CUSTOMER->value,
                'status' => fake()->randomElement([
                    UserStatus::ACTIVE->value,
                    UserStatus::INACTIVE->value,
                    UserStatus::PENDING->value,
                ]),
                'owner_id' => $owner->id,
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
                'iframe_map' => null,
                'content' => fake()->paragraph(),
            ]);
        }
    }
}


