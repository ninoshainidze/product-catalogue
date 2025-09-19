<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddProductToCartRequest;
use App\Http\Requests\Cart\RemoveProductFromCartRequest;
use App\Http\Resources\Cart\CartResource;
use App\Models\Cart;
use App\Models\UserProductGroup;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProduct(AddProductToCartRequest $request)
    {
        $cartItem = Cart::firstOrNew([
            'user_id' => Auth::id(),
            'product_id' => $request->validated('product_id'),
        ]);

        $cartItem->quantity = $cartItem->exists
            ? $cartItem->quantity + 1
            : 1;

        $cartItem->save();

        return response()->json(['message' => 'Product added to cart']);
    }

    public function removeProduct(RemoveProductFromCartRequest $request)
    {
        Cart::where('user_id', Auth::id())
            ->where('product_id', $request->validated('product_id'))
            ->delete();

        return response()->json(['message' => 'Product removed from cart']);
    }

    public function getCart()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return CartResource::collection($cartItems);
    }

}
