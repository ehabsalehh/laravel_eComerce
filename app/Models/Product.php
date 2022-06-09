<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'quantity',
        'tax',
        'photo',        
        'category_id',
        'popular',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];
    public function orderItems(){
        return $this->hasMany(orderItems::class);
    }
    public function rating(){
        return $this->hasMany(Rating::class);
    }
    public function review(){
        return $this->hasMany(Review::class);
    }
    // Get the  user that owns the product .
    public function user(){
        return $this->belongsTo(User::class);
    }
    // Get the  category that owns the product .
    public function category(){
        return $this->belongsTo(category::class);
    }
    // local scope
    public function scopeGetActiveProduct($query){
        return $query->where('status','active');
    }
    public function scopeGetProductByCategory($query,$category_id){
        return $query->where('category_id',$category_id);
    }
    public function scopeSlug($query,$slug) {
        return $query->where('slug',$slug);
    }
    public function scopeId($query,$id) {
        return $query->where('id',$id);
    }
    public function scopeGetProductByName($query,$name){
        return $query->where('name','like',"%$name%");
    }
}
