<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class DashboardController extends Controller
{
    public function users()
    {
        return  new UserResource(User::all());
    }
    public function view_user(User $user)
    {
        return  new UserResource($user);
    }
    
}
