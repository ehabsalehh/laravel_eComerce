<?php
namespace App\Models\Employee\Product;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Employee\Product\BrandStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;
    protected $fillable =['name','slug','status'];
    protected $casts = ['status' => BrandStatus::class];
    public function products(){
        return $this->hasMany(Product::class)->where('status','active');
    }
}
