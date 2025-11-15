<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    public function index() {

        $totalUsers = User::where('rol_id', '!=', 1)->count();
        $totalOrders = Order::count(); 
        $totalProducts = Product::count(); 

        return view('admin.dashboard', compact('totalUsers', 'totalOrders', 'totalProducts'));
    }

}
