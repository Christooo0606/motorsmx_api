<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'cate_id', 'name', 'slug', 'small_description', 'description', 'original_price', 'selling_price',
        'image', 'qty', 'tax', 'status', 'trending', 'meta_title', 'meta_keyword', 'meta_description'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
