<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Business;

class ProductClientController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('business')
            ->where('active', 1)
            ->whereHas('business', fn ($q) => $q->where('is_active', 1));

        // Búsqueda por nombre o descripción del producto, o por nombre de la tienda
        if ($request->filled('buscar')) {
            $texto = trim($request->buscar);
            $query->where(function ($q) use ($texto) {
                $q->where('name', 'like', "%{$texto}%")
                  ->orWhere('description', 'like', "%{$texto}%")
                  ->orWhereHas('business', fn ($b) => $b->where('name', 'like', "%{$texto}%"));
            });
        }

        if ($request->filled('tienda')) {
            $query->where('business_id', $request->integer('tienda'));
        }

        match ($request->orden) {
            'precio_asc' => $query->orderBy('price'),
            'precio_desc' => $query->orderByDesc('price'),
            'nombre' => $query->orderBy('name'),
            default => $query->latest(),
        };

        // withQueryString conserva la búsqueda y los filtros al cambiar de página
        $products = $query->paginate(12)->withQueryString();
        $stores = Business::where('is_active', 1)->get(); // Para el filtro de tiendas
        
        return view('cliente.productos.index', compact('products', 'stores'));
    }

    public function show(Product $product)
    {
        $product->load('business');

        // Un producto inactivo o de una tienda inactiva no se muestra a clientas
        abort_unless($product->active && optional($product->business)->is_active, 404);
        
        // Productos relacionados del mismo negocio
        $relatedProducts = Product::where('business_id', $product->business_id)
            ->where('id', '!=', $product->id)
            ->where('active', 1)
            ->limit(4)
            ->get();
        
        return view('cliente.productos.show', compact('product', 'relatedProducts'));
    }
}