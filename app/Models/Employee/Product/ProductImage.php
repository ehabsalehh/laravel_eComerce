<?php
namespace App\Models\Employee\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'path',
        'product_id',
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function scopeProduct($query,$productId){
        return $query->where('product_id',$productId);
    }
}
