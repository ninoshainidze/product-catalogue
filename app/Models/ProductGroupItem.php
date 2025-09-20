<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductGroupItem extends Model
{
    use HasFactory;

    protected $table = 'product_group_items';

    protected $fillable = [
        'user_product_group_id',
        'product_id'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(UserProductGroup::class, 'user_product_group_id', 'user_product_group_id');
    }
}
