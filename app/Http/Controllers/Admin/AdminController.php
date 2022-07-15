<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Models\Customer\Customer;
use App\services\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Employee\Product\Category;use App\Models\Customer\Checkout\Order;use App\Models\Employee\Product\Product;use Illuminate\Support\Carbon;

class AdminController extends Controller
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
    public function settingsUpdate(UpdateSettingRequest $request){
        $this->settingData = $request->validated();
        $settings=Setting::first();
        $settings->update($this->settingData);
        ResponseMessage::successResponse();
    }
    public function customerPieChart(){
            return Customer::selectRaw('COUNT(*) as registerd_customer,
                                        DAYNAME(created_at) as day_name,DAY(created_at) as day')
            ->groupBy('day_name','day')
            ->where('created_at', '>', Carbon::now()->subWeek(3))
            ->get();   
    }
    
}