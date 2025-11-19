<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Product;

class ProductClientController extends Controller
{
    public function index()
    {
        $products = Product::where('active', 1)->paginate(20);
           // Tiendas que tienen al menos un producto activo
        $stores = Business::whereHas('products', function ($q) {
        $q->where('active', 1);
    })->get();
        $categories = collect(); // No tienes categorías aún
        return view('cliente.productos.index', compact('products', 'stores', 'categories'));
    }

    public function show($store, $product)
    {
        $store = Business::findOrFail($store);
        $product = $store->products()->where('id', $product)->where('active', 1)->firstOrFail();

        return view('cliente.productos.show', compact('store', 'product'));
    }

}
