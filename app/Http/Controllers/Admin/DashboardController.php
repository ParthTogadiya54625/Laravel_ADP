<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        $publishers =  Role::with('users')->where('name','publisher-admin')->first();
        $inactivePublishers = $publishers->users->where('status', config('constants.user.status_code.inactive'))->count();
        $activePublishers = $publishers->users->where('status', config('constants.user.status_code.active'))->count();
        return view('admin.dashboard.dashboard', compact('inactivePublishers','activePublishers'));
    }
}
