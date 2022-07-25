<?php

namespace App\Models\Employee\Product;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee\Product\Product;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\Employee\Product\DiscountStatus;
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
    protected $casts = ['status' => DiscountStatus::class];
    public function products(){
        return $this->hasMany(Product::class);
    }


}
