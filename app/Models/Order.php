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
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
        'city',
        'post_code',
        'address1',
        'address2',
        'status',
        'total_price',
        'user_id',

    ];
    
    public function orderItems(){
        return $this->hasMany(orderItem::class);
    }
    
    public function scopeUserId($query,$id) {
        return $query->where('user_id',$id);
    }
    public function scopeGetStatusNewOrder($query) {
        return $query->where('status' ,'new');
    }
    public function scopeGetOrderByStatus($query,$status) {
        return $query->where('status' ,$status);
    }
    
}
