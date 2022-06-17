<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,
    SoftDeletes
    ;
    protected $table="categories";
    protected $fillable = [
        'name',
        'slug',
        'description',
        'photo',
        'status',
        'is_parent',
        'parent_id',
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
