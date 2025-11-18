<?php

namespace App\Http\Controllers\Emprendedor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Product;
use App\Models\Order;

class EmprendedorDashboardController extends Controller
{
   public function index()
{
    $user = auth()->user();

    // obtenemos IDs desde la relación correcta
    $businessIds = $user->businesses()->pluck('id')->toArray();

    $businessCount = count($businessIds);
    $productCount = $businessCount > 0
        ? Product::whereIn('business_id', $businessIds)->count()
        : 0;
    $orderCount = $businessCount > 0
        ? Order::whereIn('business_id', $businessIds)->count()
        : 0;

    return view('emprendedor.dashboard', compact(
        'businessCount',
        'productCount',
        'orderCount'
    ));
}

}
