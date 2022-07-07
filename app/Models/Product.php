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
        'size',
        'color',
        'photo',
        'status',        
        'tax',
        'category_id',
        'child_category_id',
        'supplier_id',
        'brand_id',
        'discount_id',

    ];
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
    // Get the  category that owns the product .
    public function category(){
        return $this->belongsTo(category::class);
    }
    public function sub_category(){
        return $this->hasOne(category::class,'id','child_category_id');
    }
    public function inventory(){
        return $this->hasMany(Inventory::class);
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
    // Get the  Brand that owns the product .
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function discount(){
        return $this->belongsTo(Discount::class);
        // return $this->hasOne(Discount::class,'id','discount_id');

    }

    // local scope
    public function scopeProductWith($query){
        return $query->with(['discount','category','sub_category','rating','review']);

    }
    // public function scopeGetProductDiscount($query){
    //     return $query->join('discounts','products.discount_id','discounts.id')
    //     ->select('products.price','discounts.percent')
    //     ->first();
    // }
    public function scopeGetActiveProduct($query){
        return $query->where('status','active');
    }
    public function scopeGetProductByCategory($query,$category_id){
        return $query->OrWhere('category_id',$category_id);
    }
    public function scopeGetProductByChildCategory($query,$category_id){
        return $query->orWhere('child_category_id',$category_id);
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
    public static function activeProduct(){
        return Category::where('status','active')->paginate(20);
    }
    public  function getProductBySlug($slug){
        return Product::with(['category','review'])->where('slug',$slug)->first();
    }
}
