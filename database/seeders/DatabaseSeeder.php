<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminUser = User::query()
            ->where('email', 'admin-user@email.com')
            ->first();
        if (! $adminUser) {
            User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin-user@email.com',
                'password' => bcrypt('12345678'),
                'is_admin' => true,
            ]);
        }

        User::factory(15)->create();

        $randomOwnerUsers = fake()->numberBetween(1, 15);

        Product::factory(250)->create(['owner_id' => $adminUser->id]);
        Product::factory(250)->create(['owner_id' => $randomOwnerUsers]);
    }
}
