<?php

namespace App\Http\Controllers\Emprendedor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

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
            'price'      => 'required|numeric',
            'quantity'   => 'required|integer',
            'image'      => 'nullable|image|max:2048',
            'active'     => 'nullable|in:0,1,2',
        ]);

        $data = $validated;
        $data['business_id'] = $business->id;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        \App\Models\Product::create($data);

        return redirect()
            ->route('emprendedor.business.products.index', $business->id)
            ->with('success', 'Product created successfully');
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
            'price'      => 'required|numeric',
            'quantity'   => 'required|integer',
            'image'      => 'nullable|image|max:2048',
            'active'     => 'nullable|in:0,1,2',
        ]);

        $data = $validated;

        if ($request->hasFile('image')) {
            // optional: delete old file if exists
            if ($product->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()
            ->route('emprendedor.business.products.index', $business->id)
            ->with('success', 'Product updated successfully');
    }

    public function destroy($businessId, $productId)
    {
        $business = auth()->user()->businesses()->findOrFail($businessId);
        $product = $business->products()->findOrFail($productId);

        // optional: delete image file
        if ($product->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('emprendedor.business.products.index', $business->id)
            ->with('success', 'Product deleted');
    }
}
