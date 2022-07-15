<?php
namespace App\Models\Customer\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rating extends Model
{
    use HasFactory;
    protected $table ='ratings';
    protected $fillable = [
       'product_id',
       'customer_id',
       'stars_rated',
    ];

    public function product(){
        return $this->belongsTo(product::class);
    }
    public function Customer(){
        return $this->belongsTo(Customer::class);
    }
    public function scopeCustomer($query){
        return $query->where('customer_id',Auth::id());
    }
}
