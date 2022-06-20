<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $table = 'Orders';
    protected $fillable = [
        'order_number',
        'status',
        'sub_total',
        'total_discount',
        'total',
        'customer_id',
        'shipping_id',
        'employee_id',
    ];
    
    public function orderItems(){
        return $this->hasMany(orderItem::class);
    }
    
    public function scopeCustomerId($query,$id) {
        return $query->where('customer_id',$id);
    }
    public function scopeGetStatusNewOrder($query) {
        return $query->where('status' ,'new');
    }
    public function scopeGetOrderByStatus($query,$status) {
        return $query->where('status' ,$status);
    }
    
}
