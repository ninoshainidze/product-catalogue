<?php

namespace App\Services;

use App\Models\Cart;

class CartService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function addProduct(int $userId, int $productId): void
    {
        $cartItem = Cart::firstOrNew([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        $cartItem->quantity = $cartItem->exists
            ? $cartItem->quantity + 1
            : 1;

        $cartItem->save();
    }

    public function removeProduct(int $userId, int $productId): void
    {
        Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->delete();
    }

    public function setProductQuantity(int $userId, int $productId, int $quantity): void
    {
        // If the quantity is zero, remove the product from the cart
        if ($quantity === 0) {
            Cart::where('user_id', $userId)
                ->where('product_id', $productId)
                ->delete();
            return;
        }

        Cart::updateOrCreate(
            ['user_id' => $userId, 'product_id' => $productId],
            ['quantity' => $quantity]
        );
    }
}
