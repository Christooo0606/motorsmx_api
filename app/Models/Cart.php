<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id', 'prod_id', 'prod_qty'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'prod_id');
    }
}
