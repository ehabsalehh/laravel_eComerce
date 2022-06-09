<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable =[
        'product_id',
        'user_id',
        'product_quantity',

    ];
    
    public function CartCount(){
        $cart= Cart::userId(Auth::id())->count();
        return response()->json(['countCart'=>$cart]) ;
     }
     // Get the  user that owns the cart .
     public function user(){
        return $this->belongsTo(User::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
 
    public function scopeProductId($query,$product_id) {
        return $query->where('product_id',$product_id);
    }
    public function scopeUserId($query,$user_id) {
        return $query->where('user_id',$user_id);
    }
   }
