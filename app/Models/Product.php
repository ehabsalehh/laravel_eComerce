<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory,
    SoftDeletes
    ;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'small_description',
        'description',
        'price',
        'photo',
        'status',        
        'tax',
        'category_id',
        'child_category_id',
        'brand_id',
        'inventory_id',
        'discount_id',


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
    // Get the  Customer that owns the product .
    public function Customer(){
        return $this->belongsTo(Customer::class);
    }
    // Get the  category that owns the product .
    public function category(){
        return $this->belongsTo(category::class);
    }
    // Get the  Brand that owns the product .
    public function brand(){
        return $this->belongsTo(Brand::class);
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
