<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'user_id',
        'title',
        'price'
    ];

    public function cartItems()
    {
        return $this->hasMany(Cart::class, 'product_id', 'product_id');
    }

    public function groupItems()
    {
        return $this->hasMany(ProductGroupItem::class, 'product_id', 'product_id');
    }
}
