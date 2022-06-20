<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory
    ;
    protected $fillable = [
        'quantity',
        'product_id',
        'location_id',
    ];
    public function scopeGetInventoryProdut($query,$product)
    {
        return $query->where('product_id',$product);
    }
}
