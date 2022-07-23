<?php
namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Customer\Checkout\Cart;
use App\Models\Customer\Review\Rating;
use App\Models\Customer\Review\Review;
use App\Models\Customer\Checkout\Order;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer\Review\WishList;
use Illuminate\Notifications\Notifiable;
use App\Models\Customer\Checkout\OrderItem;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'phone',
        'country',
        'city',
        'postal_code',
        'address1',
        'address2',
        'shipper_address',
        'shipper_city',
        'billing_address',
        'billing_city',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //orderItem, cart, wishlist,
    public function carts(){
        return $this->hasMany(Cart::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
    public function ratings(){
        return $this->hasMany(Rating::class);
    }
    public function reviews(){
       
        return $this->hasMany(Review::class);
    }
    public function wishLists(){
        return $this->hasMany(WishList::class);
    }
    public function scopeId($query){
        return $query->where('id',auth()->id());
    }

}
