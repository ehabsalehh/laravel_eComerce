<?php
namespace App\Http\Controllers\Customer\Review;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\WishListResource;
use App\Models\Customer\Review\WishList;
use App\Services\Customer\Review\StoreWishlist;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    private $store;
    public function index(){
        $wishList = WishList::query()->Customer()->with('product')->get();
        return  WishListResource::collection($wishList);
    }
    public function show(WishList $wishList){
        return new WishListResource($wishList);
    }
    public function store(Request $request,StoreWishlist $store){
        $this->store = $store;
       return $this->store->store($request);
    }
    public function count(){
        return  WishList::getCustomerWishList()->count();
    }    
    public function destroy(WishList $wishList){
        $wishList->delete();
        return ResponseMessage::successResponse();
    }

}
