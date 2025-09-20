<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddProductToCartRequest;
use App\Http\Requests\Cart\RemoveProductFromCartRequest;
use App\Http\Requests\Cart\SetCartProductQuantityRequest;
use App\Http\Resources\Cart\CartResource;
use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct(public CartService $cartService)
    {
    }

    public function addProduct(AddProductToCartRequest $request)
    {
        $this->cartService->addProduct(Auth::id(), $request->validated('product_id'));
        return response()->json(['message' => 'Product added to cart']);
    }

    public function removeProduct(RemoveProductFromCartRequest $request)
    {
        $this->cartService->removeProduct(Auth::id(), $request->validated('product_id'));
        return response()->json(['message' => 'Product removed from cart']);
    }


    public function setProductQuantity(SetCartProductQuantityRequest $request)
    {
        $this->cartService->setProductQuantity(
            Auth::id(),
            $request->validated('product_id'),
            $request->validated('quantity')
        );

        return response()->json(['message' => 'Product quantity updated']);
    }

    public function getCart()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return CartResource::collection($cartItems);
    }
}
