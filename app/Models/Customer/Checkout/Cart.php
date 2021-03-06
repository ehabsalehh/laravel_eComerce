<?php
namespace App\Models\Customer\Checkout;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable =[
        'product_id',
        'customer_id',
        'quantity',
    ];
    
    public function CartCount(){
        $cart= Cart::CustomerId(auth()->id())->count();
        return response()->json(['countCart'=>$cart]) ;
     }
     // Get the  Customer that owns the cart .
     public function Customer(){
        return $this->belongsTo(Customer::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
 
    public function scopeProductId($query,$product_id) {
        return $query->where('product_id',$product_id);
    }
    public function scopeCustomerId($query,$customer_id) {
        return $query->where('customer_id',$customer_id);
    }
   }
