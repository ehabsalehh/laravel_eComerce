<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table="categories";
    protected $fillable = [
        'name',
        'slug',
        'description',
        'photo',
        'popular',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];
    //  Get the products for the product.
   public function products()
   {
       return $this->hasMany(Product::class);
   }

   public function scopeSlug($query,$slug) {
    return $query->where('slug',$slug);
    }

}
