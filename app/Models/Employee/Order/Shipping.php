<?php
namespace App\Models\Employee\Order;
use App\Models\Customer\Checkout\Order;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Employee\Order\ShippingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipping extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'price',
        'phone',
        'status',

    ];
    protected $casts = ['status' => ShippingStatus::class];
    public function orders(){
        return $this->hasMany(Order::class);
    }
    
}
