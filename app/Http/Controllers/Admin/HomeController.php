<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Admin\Setting;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Models\Customer\Checkout\Order;
use App\Models\Employee\Product\Product;
use App\Models\Employee\Product\Category;
use App\Http\Requests\UpdateSettingRequest;
use App\Services\Admin\Home\ChangeAdminPassword;

class HomeController extends Controller
{
    private $settingData;
    public function index(){
        $categories= Category::count();
        $products = Product::count();
        $orders= Order::count();
        $customerPieChart = $this->customerPieChart();
        $data = [];
        $data['categories'] = $categories;
        $data['products'] = $products;
        $data['orders'] = $orders;
        $data['customerPieChart'] = $customerPieChart;
        return $data;
    }
    private $changePassword;
    public function ChangeAdminPassword(Request $Request,ChangeAdminPassword $changePassword){
        $this->changePassword = $changePassword;
       return  $this->changePassword->changePassword($Request);
    }
    public function profile(){
       return Auth()->user();
    }
    public function profileUpdate(Request $request, Admin $admin){
        $request->validate([
            'avatar' => ['image','required']
        ]);
        $admin->addMediaFromRequest('avatar')
                ->toMediaCollection('admin-avatar');
        return ResponseMessage::successResponse();
    }
    public function settingsUpdate(UpdateSettingRequest $request){
        $this->settingData = $request->validated();
        $settings=Setting::first();
        $settings->update($this->settingData);
       return  ResponseMessage::successResponse();
    }
    public function customerPieChart(){
            return Customer::selectRaw('COUNT(*) as registerd_customer,
                                        DAYNAME(created_at) as day_name,DAY(created_at) as day')
            ->groupBy('day_name','day')
            ->where('created_at', '>', now()->subWeek(3))
            ->get();   
    }
    
}