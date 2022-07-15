<?php
namespace App\Models\Employee\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable =['name','slug','status'];
    public function products(){
        return $this->hasMany(Product::class)->where('status','active');
    }
}
