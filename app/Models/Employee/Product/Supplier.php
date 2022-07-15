<?php
namespace App\Models\Employee\Product;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'contact_name',
        'address',
        'city',
        'country',
        'phone',
        'postal_code',
    ];
    public function products(){
        return $this->hasMany(Product::class);
    }
}
