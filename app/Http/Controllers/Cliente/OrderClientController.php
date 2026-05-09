<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the user's orders.
     */
    public function index(Request $request)
    {
        $query = Order::where('user_id', Auth::id())
            ->with(['business', 'details.product'])
            ->latest();

        // Filtrar por estado
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10);
        $statuses = ['pending', 'processing', 'completed', 'cancelled'];

        return view('cliente.pedidos.index', compact('orders', 'statuses'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        // Verificar que el pedido pertenece al usuario autenticado
        if ($order->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver este pedido');
        }

        $order->load(['business', 'details.product']);

        return view('cliente.pedidos.show', compact('order'));
    }

    /**
     * Cancel the specified order.
     */
    public function cancel(Order $order)
    {
        // Verificar que el pedido pertenece al usuario autenticado
        if ($order->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para cancelar este pedido');
        }

        // Solo se pueden cancelar pedidos pendientes o en proceso
        if (!in_array($order->status, ['pending', 'processing'])) {
            return redirect()->route('cliente.pedidos.show', $order)
                ->with('error', 'No se puede cancelar un pedido que ya está completado o cancelado.');
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('cliente.pedidos.show', $order)
            ->with('success', 'Pedido cancelado correctamente.');
    }
}