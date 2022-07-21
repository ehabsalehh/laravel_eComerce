<?php
namespace App\Models\Employee\Product;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee\Product\Product;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model implements HasMedia
{
    use HasFactory,
    SoftDeletes,
    InteractsWithMedia
    ;
    protected $table="categories";
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'is_parent',
        'parent_id',
    ];
    public function parent_info(){
        return $this->hasOne(Category::class,'id','parent_id');
    }
    public function child_category(){
        return $this->hasMany(Category::class,'parent_id','id')->where('status','active');
    }
    public function products(){
        return $this->hasMany(Product::class)->where('status','active');
    }
    public function sub_products(){
        return $this->hasMany(Product::class,'child_category_id','id')->where('status','active');
    }
    public static function getProductByCat($slug){
        return Category::with('products')->where('slug',$slug)->first();
    }
    public static function getProductBySubCat($slug){
        return Category::with('sub_products')->where('slug',$slug)->first();
    }
   public function scopeSlug($query,$slug) {
    return $query->where('slug',$slug);
   }
   public function scopeActive($query) {
    return $query->where('status','active');
   }
   

}
