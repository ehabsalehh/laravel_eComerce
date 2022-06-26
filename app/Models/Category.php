<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,
    SoftDeletes
    ;
    protected $table="categories";
    protected $fillable = [
        'name',
        'slug',
        'description',
        'photo',
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
   public static function activeCategory(){
    return Category::where('status','active')->paginate(20);
    }
   

}
