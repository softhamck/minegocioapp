<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Business;

class StoreClientController extends Controller
{
    public function index()
    {
        $stores = Business::whereHas('products', function ($q) {
            $q->where('active', 1);
        })->get();

        return view('cliente.tiendas.index', compact('stores'));
    }

    public function show($store)
    {
        $store = Business::findOrFail($store);
        $products = $store->products()->where('active', 1)->get();

        return view('cliente.tiendas.show', compact('store', 'products'));
    }
}
