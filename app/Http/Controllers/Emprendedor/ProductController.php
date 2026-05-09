<?php

namespace App\Http\Controllers\Emprendedor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Business;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index($businessId)
    {
        $business = Auth::user()->businesses()->findOrFail($businessId);
        $products = $business->products()->latest()->get();

        return view('emprendedor.business.products.index', compact('business', 'products'));
    }

    public function create($businessId)
    {
        $business = Auth::user()->businesses()->findOrFail($businessId);
        return view('emprendedor.business.products.create', compact('business'));
    }

    public function store(Request $request, $businessId)
    {
        $business = Auth::user()->businesses()->findOrFail($businessId);

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'description'=> 'nullable|string',
            'price'      => 'required|numeric|min:0',
            'quantity'   => 'required|integer|min:0',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active'     => 'boolean',
        ]);

        $data = [
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
            'business_id' => $business->id,
            'active' => $request->has('active') ? 1 : 0,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()
            ->route('emprendedor.business.products.index', $business->id)
            ->with('success', 'Producto creado correctamente');
    }

    public function edit($businessId, $productId)
    {
        $business = Auth::user()->businesses()->findOrFail($businessId);
        $product = $business->products()->findOrFail($productId);

        return view('emprendedor.business.products.edit', compact('business', 'product'));
    }

    public function update(Request $request, $businessId, $productId)
    {
        $business = Auth::user()->businesses()->findOrFail($businessId);
        $product = $business->products()->findOrFail($productId);

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'description'=> 'nullable|string',
            'price'      => 'required|numeric|min:0',
            'quantity'   => 'required|integer|min:0',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active'     => 'boolean',
        ]);

        $data = [
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
            'active' => $request->has('active') ? 1 : 0,
        ];

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()
            ->route('emprendedor.business.products.index', $business->id)
            ->with('success', 'Producto actualizado correctamente');
    }

    public function destroy($businessId, $productId)
    {
        $business = Auth::user()->businesses()->findOrFail($businessId);
        $product = $business->products()->findOrFail($productId);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('emprendedor.business.products.index', $business->id)
            ->with('success', 'Producto eliminado correctamente');
    }

    /**
     * Mostrar todos los productos de todos los negocios del emprendedor
     */
    public function allProducts(Request $request)
    {
        // Obtener los IDs de los negocios del usuario autenticado
        $businessIds = Auth::user()->businesses()->pluck('id');
        
        // Query base de productos
        $query = Product::whereIn('business_id', $businessIds)
            ->with('business')
            ->latest();
        
        // Búsqueda
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }
        
        // Filtrar por negocio
        if ($request->filled('business_id')) {
            $query->where('business_id', $request->business_id);
        }
        
        // Filtrar por estado
        if ($request->filled('status')) {
            $query->where('active', $request->status);
        }
        
        // Ordenar
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->latest();
                break;
        }
        
        $products = $query->paginate(12);
        $businesses = Auth::user()->businesses;
        
        return view('emprendedor.products.all', compact('products', 'businesses'));
    }
}