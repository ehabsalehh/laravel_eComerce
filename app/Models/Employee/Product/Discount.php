<?php

namespace App\Models\Employee\Product;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee\Product\Product;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory,
    SoftDeletes
    ;
    protected $fillable = [
        'name',
        'description',
        'percent',
        'status',
    ];
    public function products(){
        return $this->hasMany(Product::class);
    }


}
