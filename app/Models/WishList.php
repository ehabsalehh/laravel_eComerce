<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
    public function scopeGetCustomerWishList($query){
        return $query->where('customer_id',Auth::id());
    }
    
}
