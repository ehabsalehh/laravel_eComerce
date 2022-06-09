<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'product_id',
        'user_id',
        'price',
        'product_quantity',
    ];
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function scopeHasProduct($query,$product_id){
        return $query->where('product_id',$product_id);
    }
    public function scopeGetOrrderItems($query,$orderId){
       return $query->where('order_id',$orderId);
    } 
}