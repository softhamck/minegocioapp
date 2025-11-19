<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if(empty($cart)) {
            return back()->with('error', 'El carrito está vacío.');
        }

        // Todos los productos deben ser del mismo negocio (MVP)
        $businessId = collect($cart)->pluck('business_id')->unique()->first();

        $order = Order::create([
            'business_id'       => $businessId,
            'user_id'           => auth()->id(),
            'order_statuses_id' => 1, // pendiente
            'order_number'      => Str::upper(Str::random(8)),
            'total'             => collect($cart)->sum(fn($i) => $i['price'] * $i['quantity'])
        ]);

        foreach ($cart as $item) {
            OrderDetail::create([
                'order_id'   => $order->id,
                'product_id' => $item['id'],
                'quantity'   => $item['quantity'],
                'unit_price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('cliente.pedido.show', $order->id);
    }

    public function show($order)
    {
        $order = Order::where('user_id', auth()->id())->findOrFail($order);
        return view('cliente.pedido.show', compact('order'));
    }
}
