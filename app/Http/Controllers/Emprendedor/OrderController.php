<?php

namespace App\Http\Controllers\Emprendedor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders for the entrepreneur.
     */
    public function index(Request $request)
    {
        // Obtener los IDs de los negocios del emprendedor
        $businessIds = Auth::user()->businesses()->pluck('id');
        
        // Query base de pedidos
        $query = Order::whereIn('business_id', $businessIds)
            ->with(['user', 'business', 'details.product'])
            ->latest();
        
        // Búsqueda por ID o cliente
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function($q2) use ($search) {
                      $q2->where('name', 'LIKE', "%{$search}%")
                         ->orWhere('email', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        // Filtrar por estado
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filtrar por negocio
        if ($request->filled('business_id')) {
            $query->where('business_id', $request->business_id);
        }
        
        $orders = $query->paginate(15);
        $statuses = ['pending', 'processing', 'completed', 'cancelled'];
        $businesses = Auth::user()->businesses;
        
        return view('emprendedor.orders.index', compact('orders', 'statuses', 'businesses'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        // Verificar que el pedido pertenece a un negocio del emprendedor
        $businessIds = Auth::user()->businesses()->pluck('id');
        if (!$businessIds->contains($order->business_id)) {
            abort(403, 'No tienes permiso para ver este pedido');
        }
        
        $order->load(['user', 'business', 'details.product']);
        
        return view('emprendedor.orders.show', compact('order'));
    }

    /**
     * Update the status of the specified order.
     */
    public function updateStatus(Request $request, Order $order)
    {
        // Verificar que el pedido pertenece a un negocio del emprendedor
        $businessIds = Auth::user()->businesses()->pluck('id');
        if (!$businessIds->contains($order->business_id)) {
            abort(403, 'No tienes permiso para modificar este pedido');
        }
        
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);
        
        $order->update(['status' => $request->status]);
        
        return redirect()->route('emprendedor.orders.show', $order)
            ->with('success', 'Estado del pedido actualizado correctamente');
    }
}