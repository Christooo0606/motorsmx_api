<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'status', 'popular', 'image', 'meta_title', 'meta_description', 'meta_keyword'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
