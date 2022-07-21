<?php
namespace App\Models\Customer\Review;
use product;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WishList extends Model
{
    use HasFactory;
    protected $table ='wish_lists';
    protected $fillable = [
       'product_id',
       'customer_id',
    ];
    public function product(){
        return $this->belongsTo(product::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function scopeCustomer($query){
        return $query->where('customer_id',auth()->id());
    }
    public function scopeProduct($query,$productId){
        return $query->where('product_id',$productId);
    }
    
    
    
}
