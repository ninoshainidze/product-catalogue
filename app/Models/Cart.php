<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getDiscountAttribute(): float|int
    {
        $groups = UserProductGroup::where('user_id', $this->user_id)
            ->with('products')
            ->get();

        $cartItems = self::where('user_id', $this->user_id)->get()->keyBy('product_id');

        foreach ($groups as $group) {
            $groupProductIds = $group->products->pluck('id')->toArray();

            if (collect($groupProductIds)->every(fn($id) => $cartItems->has($id))) {
                $minQty = collect($groupProductIds)->map(fn($id) => $cartItems[$id]->quantity)->min();

                if (in_array($this->product_id, $groupProductIds)) {
                    $unitDiscount = $this->product->price * $group->discount / 100;
                    return round($unitDiscount * $minQty, 2);
                }
            }
        }

        return 0;
    }
}
