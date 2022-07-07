<?php

namespace App\Http\Controllers\Customer;

use App\Models\WishList;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\WishListResource;
use App\Http\Requests\StoredWishListRequest;
use App\Http\Traits\WishList\AddWishListTrait;

class WishListController extends Controller
{
    use AddWishListTrait;
    public function index(){
        $wishList = WishList::getCustomerWishList()->with('product')->get();
        return  WishListResource::collection($wishList);
    }
    
    public function addToWishList(StoredWishListRequest $request){
       return $this->addWishList($request);
    }
    public function show($wishListId){
        $wishList= WishList::findOrFail($wishListId);
        return new WishListResource($wishList);
    }
    public function wishListCount(){
        return  WishList::getCustomerWishList()->count();
    }    
    public function deleteWishList(WishList $wishList){
        $wishList->delete();
        return ResponseMessage::succesfulResponse();
    }

}
