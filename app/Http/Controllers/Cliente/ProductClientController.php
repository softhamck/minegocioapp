<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductClientController extends Controller
{
    public function index() {
        $products = Producto::all();
        return view('cliente.productos.index', compact('products'));
    }

    public function show($id) {
        $product = Product::findOrFail($id);
        return view('cliente.productos.show', compact('products'));
    }
}
