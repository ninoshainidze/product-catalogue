<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProductGroup extends Model
{
    use HasFactory;

    protected $table = 'user_product_groups';
    protected $fillable = [
        'user_id',
        'discount',
    ];

    public function items()
    {
        return $this->hasMany(ProductGroupItem::class, 'user_product_group_id', 'user_product_group_id');
    }
}
