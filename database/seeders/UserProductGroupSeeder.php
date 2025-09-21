<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductGroupItem;
use App\Models\User;
use App\Models\UserProductGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserProductGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or fetch a random user
        $user = User::inRandomOrder()->first() ?? User::factory()->create();

        // Create sample products for that user
        $products = Product::inRandomOrder()->take(2)->get();

        $group = UserProductGroup::create([
            'user_id' => $user->id,
            'discount' => random_int(10,80),
        ]);

        // Assign selected products to the discount group
        foreach ($products as $product) {
            ProductGroupItem::create([
                'user_product_group_id' => $group->id,
                'product_id' => $product->id,
            ]);
        }
    }
}
