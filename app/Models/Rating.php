<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
