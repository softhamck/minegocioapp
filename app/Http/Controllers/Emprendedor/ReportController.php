<?php

namespace App\Http\Controllers\Emprendedor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $businessIds = Auth::user()->businesses()->pluck('id');

        $totalRevenue = Order::whereIn('business_id', $businessIds)
            ->where('status', 'completed')
            ->sum('total');

        $totalOrders = Order::whereIn('business_id', $businessIds)->count();

        $ordersByStatus = Order::whereIn('business_id', $businessIds)
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $topProducts = OrderDetail::select('product_id', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(subtotal) as total_revenue'))
            ->whereHas('order', function ($q) use ($businessIds) {
                $q->whereIn('business_id', $businessIds)->where('status', '!=', 'cancelled');
            })
            ->with('product:id,name')
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        $monthlySales = Order::whereIn('business_id', $businessIds)
            ->select(
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

        return view('emprendedor.reports.index', compact(
            'totalRevenue',
            'totalOrders',
            'ordersByStatus',
            'topProducts',
            'months',
            'maxMonthlyTotal'
        ));
    }
}
