<?php
namespace App\Models\Customer\Checkout;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
       
        'amount',
        'method',
        'status',
        'order_id',
        'customer_id',
    ];
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function employee(){
        return $this->belongsTo(employee::class);
    }
}
