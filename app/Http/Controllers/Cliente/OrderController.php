<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['business', 'details.product'])
            ->latest()
            ->paginate(10);
        
        return view('cliente.pedidos.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        
        $order->load(['business', 'details.product']);
        
        return view('cliente.pedidos.show', compact('order'));
    }

    /**
     * La clienta cancela un pedido pendiente; las unidades vuelven al inventario.
     */
    public function cancel(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'pending') {
            return redirect()->route('cliente.pedidos.show', $order)
                ->with('error', 'Solo puedes cancelar pedidos pendientes. Para otros cambios, contacta a la tienda.');
        }

        $order->loadMissing('details.product');
        foreach ($order->details as $detail) {
            $detail->product?->increment('quantity', $detail->quantity);
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('cliente.pedidos.show', $order)
            ->with('success', 'Pedido cancelado correctamente.');
    }
}
