<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ClienteDashboardController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id());

        $totalOrders = (clone $orders)->where('status', 'completed')->count();
        $pendingOrders = (clone $orders)->whereIn('status', ['pending', 'processing'])->count();
        $totalSpent = (clone $orders)->where('status', 'completed')->sum('total');
        $cartCount = collect(session('cart', []))->sum('quantity');
        $recentOrders = (clone $orders)->with('business')->latest()->limit(5)->get();

        return view('cliente.dashboard', compact(
            'totalOrders', 'pendingOrders', 'totalSpent', 'cartCount', 'recentOrders'
        ));
    }
}
