<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display the cart.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('cliente.carrito.index', compact('cart', 'total'));
    }

    /**
     * Add a product to cart.
     */
    public function add(Request $request, $productId)
    {
        $product = Product::with('business')->findOrFail($productId);

        if (!$product->active || !optional($product->business)->is_active) {
            return redirect()->route('cliente.productos.index')
                ->with('error', 'Este producto ya no está disponible.');
        }
        
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->quantity
        ]);

        $cart = session()->get('cart', []);
        
        $quantity = $request->quantity;
        
        if (isset($cart[$productId])) {
            // Verificar stock disponible
            $newQuantity = $cart[$productId]['quantity'] + $quantity;
            if ($newQuantity > $product->quantity) {
                return redirect()->route('cliente.productos.show', $productId)
                    ->with('error', 'No hay suficiente stock disponible.');
            }
            $cart[$productId]['quantity'] = $newQuantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
                'business_id' => $product->business_id,
                'business_name' => $product->business->name ?? 'Negocio'
            ];
        }
        
        session()->put('cart', $cart);
        
        return redirect()->route('cliente.carrito.index')
            ->with('success', 'Producto agregado al carrito correctamente.');
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->quantity
        ]);
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cliente.carrito.index')
            ->with('success', 'Carrito actualizado correctamente.');
    }

    /**
     * Remove item from cart.
     */
    public function remove($productId)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cliente.carrito.index')
            ->with('success', 'Producto eliminado del carrito.');
    }

    /**
     * Clear the entire cart.
     */
    public function clear()
    {
        session()->forget('cart');
        
        return redirect()->route('cliente.carrito.index')
            ->with('success', 'Carrito vaciado correctamente.');
    }

    /**
     * Confirma el carrito: crea un pedido por cada tienda, descuenta el stock y vacía el carrito.
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cliente.carrito.index')
                ->with('error', 'Tu carrito está vacío.');
        }

        try {
            DB::transaction(function () use ($cart) {
                foreach (collect($cart)->groupBy('business_id') as $businessId => $items) {
                    $order = Order::create([
                        'user_id' => Auth::id(),
                        'business_id' => $businessId,
                        'total' => 0,
                        'status' => 'pending',
                    ]);

                    $total = 0;

                    foreach ($items as $item) {
                        $product = Product::lockForUpdate()->find($item['id']);

                        if (!$product || !$product->active) {
                            throw new \DomainException("El producto \"{$item['name']}\" ya no está disponible.");
                        }

                        if ($product->quantity < $item['quantity']) {
                            throw new \DomainException("No hay suficiente stock de \"{$product->name}\". Quedan {$product->quantity} unidades.");
                        }

                        // Se usa el precio actual del producto, no el guardado en la sesión
                        $subtotal = $product->price * $item['quantity'];

                        $order->details()->create([
                            'product_id' => $product->id,
                            'quantity' => $item['quantity'],
                            'price' => $product->price,
                            'unit_price' => $product->price,
                            'subtotal' => $subtotal,
                        ]);

                        $product->decrement('quantity', $item['quantity']);
                        $total += $subtotal;
                    }

                    $order->update(['total' => $total, 'order_number' => 'PED-' . str_pad($order->id, 5, '0', STR_PAD_LEFT)]);
                }
            });
        } catch (\DomainException $e) {
            return redirect()->route('cliente.carrito.index')->with('error', $e->getMessage());
        }

        session()->forget('cart');

        return redirect()->route('cliente.pedidos.index')
            ->with('success', '¡Pedido realizado! La tienda recibirá tu pedido y te contactará para acordar el pago y la entrega.');
    }
}
