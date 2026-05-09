<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Business;

class ProductClientController extends Controller
{
    public function index()
    {
        $products = Product::with('business')->where('active', 1)->latest()->paginate(12);
        $stores = Business::where('is_active', 1)->get(); // Para el filtro de tiendas
        
        return view('cliente.productos.index', compact('products', 'stores'));
    }

    public function show(Product $product)
    {
        $product->load('business');
        
        // Productos relacionados del mismo negocio
        $relatedProducts = Product::where('business_id', $product->business_id)
            ->where('id', '!=', $product->id)
            ->where('active', 1)
            ->limit(4)
            ->get();
        
        return view('cliente.productos.show', compact('product', 'relatedProducts'));
    }
}