<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

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
        $product = Product::findOrFail($productId);
        
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
}