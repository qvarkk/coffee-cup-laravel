<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();

         User::factory()->create([
             'name' => 'admin',
             'email' => 'admin@example.com',
             'password' => Hash::make('admin'),
             'role' => User::ROLE_ADMIN
         ]);

         Category::factory(5)->create();
         Product::factory(20)->create();
    }
}
