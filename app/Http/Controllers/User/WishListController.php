<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Request;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\WishListResource;
use App\Http\Requests\StoredWishListRequest;
use App\Http\Traits\WishList\AddWishListTrait;

class WishListController extends Controller
{
    use AddWishListTrait;
    public function index(){
        $wishList = WishList::getUserWishList()->get();
        return  WishListResource::collection($wishList);
    }
    
    public function Add_to_wish_list(StoredWishListRequest $request){
        $this->addWishList($request);
        return ResponseMessage::succesfulResponse();
    }
    public function show(WishList $wishList){
        
        return new WishListResource($wishList);
    }
    public function wish_list_count(){
        $wishlist =WishList::getUserWishList()->count();
        return response()->json(['WishListCount'=>$wishlist]) ;
    }
    
    public function deleteWishList(WishList $wishList){
        $wishList->delete();
    }

}
