<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Business;

class BusinessClientController extends Controller
{
    public function index()
    {
        $businesses = Business::latest()->get();
        return view('cliente.tiendas.index', compact('businesses'));
    }

    public function show($business)
    {
        $business = Business::findOrFail($business);
        return view('cliente.tiendas.show', compact('business'));
    }
}
