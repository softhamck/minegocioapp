<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'business', 'details.product']);

        // Búsqueda por ID de pedido o cliente
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

        $orders = $query->latest()->paginate(15);
        $statuses = ['pending', 'processing', 'completed', 'cancelled'];

        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'business', 'details.product']);
        
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Estado del pedido actualizado correctamente');
    }

    public function destroy(Order $order)
    {
        // Verificar si se puede eliminar (solo pedidos cancelados o pendientes)
        if (!in_array($order->status, ['pending', 'cancelled'])) {
            return redirect()->route('admin.orders.index')
                ->with('error', 'No se puede eliminar un pedido en proceso o completado.');
        }

        $order->details()->delete();
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Pedido eliminado correctamente');
    }
}