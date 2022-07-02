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
        'customer_id',
        'quantity',
    ];
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function customer(){
        return $this->hasOne(Customer::class);
    }
    public function scopeHasProduct($query,$product_id){
        return $query->where('product_id',$product_id);
    }
    public function scopeGetOrderItems($query,$orderId){
       return $query->where('order_id',$orderId);
    } 
    public function scopeGetOrderOwner($query,$customer_id){
        return $query->where('customer_id',$customer_id);
     } 
}
