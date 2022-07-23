<?php
namespace App\Models\Employee\Product;
use App\Models\Customer;
use Spatie\MediaLibrary\HasMedia;
use App\Models\Customer\Review\Rating;
use App\Models\Customer\Review\Review;
use App\Models\Employee\Product\Brand;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee\Product\Category;
use App\Models\Employee\Product\Discount;
use App\Models\Employee\Product\Inventory;
use App\Models\Customer\Checkout\OrderItem;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Employee\Product\ProductImage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements HasMedia
{
    use HasFactory,
    SoftDeletes,
    InteractsWithMedia
    ;
    protected $fillable = [
        'name',
        'slug',
        'small_description',
        'description',
        'price',
        'size',
        'color',
        'status',        
        'tax',
        'category_id',
        'child_category_id',
        'supplier_id',
        'brand_id',
        'discount_id',

    ];
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
    public function productImages(){
        return $this->hasMany(ProductImage::class);
    }
    public function category(){
        return $this->belongsTo(category::class);
    }
    public function sub_category(){
        return $this->hasOne(category::class,'id','child_category_id');
    }
    public function inventories(){
        return $this->hasMany(Inventory::class);
    }
    public function rating(){
        return $this->hasMany(Rating::class);
    }
    public function review(){
        return $this->hasMany(Review::class);
    }
    public function Customer(){
        return $this->belongsTo(Customer::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function discount(){
        return $this->belongsTo(Discount::class);
    }

    public function scopeProductWith($query){
        return $query->with(['discount','category','sub_category','rating','review']);

    }   
    public function scopeActive($query){
        return $query->where('status','active');
    }
    public function scopeByCategory($query,$category_id){
        return $query->Where('category_id',$category_id);
    }
    public function scopeByChildCategory($query,$category_id){
        return $query->Where('child_category_id',$category_id);
    }
    public function scopeSlug($query,$slug) {
        return $query->where('slug',$slug);
    }
    public function scopeId($query,$id) {
        return $query->where('id',$id);
    }
    public function scopeGetProductByName($query,$name){
        return $query->where('name','like',"%$name%");
    }
    public static function activeProduct(){
        return Category::where('status','active')->paginate(20);
    }
}
