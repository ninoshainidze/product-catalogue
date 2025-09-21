<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Hash;

class TestUserWithCartSeeder extends Seeder
{
    public function run(): void
    {
        // Create a test user
        $user = User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        // Create 3 products for the user
        $products = Product::factory()->count(3)->create(['user_id' => $user->id]);

        // Add products to cart with specific quantities
        Cart::factory()->create([
            'user_id' => $user->id,
            'product_id' => $products[0]->id,
            'quantity' => 1,
        ]);
        Cart::factory()->create([
            'user_id' => $user->id,
            'product_id' => $products[1]->id,
            'quantity' => 3,
        ]);
        Cart::factory()->create([
            'user_id' => $user->id,
            'product_id' => $products[2]->id,
            'quantity' => 2,
        ]);
    }
}
