<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $totalRevenue = Order::where('status', 'completed')->sum('total');
        $totalOrders = Order::count();

        $ordersByStatus = Order::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $usersByRole = User::select('rol_id', DB::raw('count(*) as total'))
            ->where('rol_id', '!=', 1)
            ->groupBy('rol_id')
            ->with('rol')
            ->get();

        $totalBusinesses = Business::count();
        $activeBusinesses = Business::where('is_active', true)->count();

        $topProducts = OrderDetail::select('product_id', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(subtotal) as total_revenue'))
            ->whereHas('order', fn ($q) => $q->where('status', '!=', 'cancelled'))
            ->with('product:id,name')
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        $monthlySales = Order::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw('SUM(total) as total')
            )
            ->where('status', 'completed')
            ->where('created_at', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $months = collect(range(5, 0))->map(function ($i) use ($monthlySales) {
            $date = now()->subMonths($i);
            $key = $date->format('Y-m');

            return [
                'label' => ucfirst($date->translatedFormat('M Y')),
                'total' => (float) ($monthlySales[$key]->total ?? 0),
            ];
        });

        $maxMonthlyTotal = max(1, $months->max('total'));

        return view('admin.reports.index', compact(
            'totalRevenue',
            'totalOrders',
            'ordersByStatus',
            'usersByRole',
            'totalBusinesses',
            'activeBusinesses',
            'topProducts',
            'months',
            'maxMonthlyTotal'
        ));
    }
}
