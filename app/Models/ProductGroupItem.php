<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGroupItem extends Model
{
    use HasFactory;

    protected $table = 'product_group_items';

    protected $fillable = [
        'user_product_group_id',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function group()
    {
        return $this->belongsTo(UserProductGroup::class, 'user_product_group_id', 'user_product_group_id');
    }
}
