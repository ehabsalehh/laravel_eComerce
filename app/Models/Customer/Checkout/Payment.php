<?php
namespace App\Models\Customer\Checkout;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->belongsTo(Employee::class);
    }
}
