<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Support\Money;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('business')->latest()->paginate(15);

        // Estadísticas sobre todos los productos, no solo los de la página actual
        $stats = [
            'inventoryValue' => (float) Product::sum(DB::raw('price * quantity')),
            'active'         => Product::where('active', 1)->count(),
            'lowStock'       => Product::where('quantity', '<=', 5)->count(),
        ];

        return view('admin.products.index', compact('products', 'stats'));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->merge(['price' => Money::parse($request->input('price'))]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ], [
            'price.numeric' => 'Escribe el precio solo con números, por ejemplo 80.600.',
            'price.min' => 'El precio no puede ser negativo.',
            'quantity.integer' => 'La cantidad debe ser un número entero.',
            'quantity.min' => 'La cantidad no puede ser negativa.',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(Product $product)
    {
        // Verificar si el producto tiene detalles de pedido
        if ($product->orderDetails()->exists()) {
            return redirect()->route('admin.products.index')
                ->with('error', 'No se puede eliminar este producto porque tiene pedidos asociados.');
        }
        
        // Eliminar la imagen asociada
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto eliminado correctamente');
    }
}