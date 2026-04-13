<?php

namespace App\Http\Controllers\Emprendedor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index($businessId)
    {
        $business = auth()->user()->businesses()->findOrFail($businessId);
        $products = $business->products()->latest()->get();

        return view('emprendedor.business.products.index', compact('business', 'products'));
    }

    public function create($businessId)
    {
        $business = auth()->user()->businesses()->findOrFail($businessId);
        return view('emprendedor.business.products.create', compact('business'));
    }

    public function store(Request $request, $businessId)
    {
        $business = auth()->user()->businesses()->findOrFail($businessId);

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'description'=> 'nullable|string',
            'price'      => 'required|numeric|min:0',
            'quantity'   => 'required|integer|min:0',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active'     => 'boolean', // ← Cambiado a boolean
        ]);

        $data = [
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
            'business_id' => $business->id,
            'active' => $request->has('active') ? 1 : 0, // ← Manejo correcto del checkbox/select
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
        $business = auth()->user()->businesses()->findOrFail($businessId);
        $product = $business->products()->findOrFail($productId);

        return view('emprendedor.business.products.edit', compact('business', 'product'));
    }

    public function update(Request $request, $businessId, $productId)
    {
        $business = auth()->user()->businesses()->findOrFail($businessId);
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
            // Eliminar imagen anterior
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
        $business = auth()->user()->businesses()->findOrFail($businessId);
        $product = $business->products()->findOrFail($productId);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('emprendedor.business.products.index', $business->id)
            ->with('success', 'Producto eliminado correctamente');
    }
}