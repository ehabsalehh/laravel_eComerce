<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory,Notifiable;
    // protected $table = 'reviews';
    protected $fillable = [
        'product_id',
        'customer_id',
        'customer_review'
     ];
     public function product(){
         return $this->belongsTo(product::class);
     }
     public function customer(){
         return $this->belongsTo(Customer::class);
     }
}
