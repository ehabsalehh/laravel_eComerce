<?php
namespace App\Models\Employee\Order;

use App\Enums\Employee\Order\CouponStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
       
        'code',
        'percent',
        'status',
    ];
    public function discount($total){
        return ($this->percent/100)* $total??0; 
    }
    public function scopeCode($query,$code){
        return $query->where('code',$code);
    }
    public function scopeStatusActive($query){
        return $query->where('status',CouponStatus::Active);
    }
    public function scopeStatusInActive($query){
        return $query->where('status',CouponStatus::Inactive);
    }
}
