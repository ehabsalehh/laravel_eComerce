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
       'user_id',
    ];
    public function product(){
        return $this->belongsTo(product::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function scopeGetUserWishList($query){
        return $query->where('user_id',Auth::id());
    }
    
}
