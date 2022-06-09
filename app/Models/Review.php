<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = [
        'product_id',
        'user_id',
        'user_review'
     ];
     public function product(){
         return $this->belongsTo(product::class);
     }
     public function user(){
         return $this->belongsTo(User::class);
     }
}