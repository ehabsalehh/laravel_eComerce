<?php
namespace App\Models\Employee\Product;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee\Product\Product;
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
    public function scopeGetInventoryProduct($query,$product)
    {
        return $query->where('product_id',$product);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function locations(){
        return $this->hasMany(location::class);
    }
    
}
