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
        $firstUser = User::query()
            ->where('email', 'first-user@example.com')
            ->first();
        if (! $firstUser) {
            User::factory()->create([
                'name' => 'First User',
                'email' => 'first-user@example.com',
                'password' => bcrypt('12345678'),
            ]);
        }

         User::factory(10)->create();

         Product::factory(500)->create();
    }
}
