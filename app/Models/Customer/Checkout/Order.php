<?php
namespace App\Models\Customer\Checkout;

use App\Enums\Employee\Order\OrderStatus;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Employee\Order\Shipping;
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
        'coupon',
        'customer_id',
        'shipping_id',
    ];
    
    public function orderItems(){
        return $this->hasMany(orderItem::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function shipping(){
        return $this->belongsTo(Shipping::class);
    }
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function scopeCustomerId($query,$id) {
        return $query->where('customer_id',$id);
    }
    public function scopeGetStatusNewOrder($query) {
        return $query->where('status' ,OrderStatus::New);
    }
    public function scopeGetOrderByStatus($query,$status) {
        return $query->where('status',$status);
    }
    
}
