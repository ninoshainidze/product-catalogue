<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserProductGroup extends Model
{
    use HasFactory;

    protected $table = 'user_product_groups';
    protected $fillable = [
        'user_id',
        'discount',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'product_group_items',
            'user_product_group_id',
            'product_id'
        );
    }
}
