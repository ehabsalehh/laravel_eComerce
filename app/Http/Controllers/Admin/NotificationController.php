<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Admin\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        return  $notifications = auth()->user()->unreadNotifications;
    }
    public function show(Request $request)
    {   
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();
    }
    public function delete(Notification $notification){
        $notification->delete();
    }
    public function deleteAll(){
        $admin = Admin::where('id',auth()->id())->first();
        $admin->notifications()->delete();
    }
}
