<?php

namespace App\Http\Controllers\Emprendedor;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
    /**
     * Display a listing of the businesses.
     */
    public function index()
    {
        $businesses = Business::where('user_id', Auth::id())->get();
        $totalProducts = Product::whereHas('business', function($query) {
            $query->where('user_id', Auth::id());
        })->count();
        $totalOrders = 0; // Ajusta según tu lógica de órdenes
        
        return view('emprendedor.business.index', compact('businesses', 'totalProducts', 'totalOrders'));
    }

    /**
     * Show the form for creating a new business.
     */
    public function create()
    {
        return view('emprendedor.business.create');
    }

    /**
     * Store a newly created business in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'telephone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $business = Business::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'description' => $validated['description'],
            'telephone' => $validated['telephone'],
            'address' => $validated['address'] ?? null,
            'is_active' => true,
        ]);

        return redirect()->route('emprendedor.business.show', $business)
            ->with('success', 'Negocio creado correctamente');
    }

    /**
     * Display the specified business.
     */
    public function show(Business $business)
    {
        // Verificar que el negocio pertenece al usuario autenticado
        if ($business->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver este negocio');
        }

        $productsCount = $business->products()->count();
        $ordersCount = 0; // Ajusta según tu lógica
        $totalSales = 0; // Ajusta según tu lógica

        return view('emprendedor.business.show', compact('business', 'productsCount', 'ordersCount', 'totalSales'));
    }

    /**
     * Show the form for editing the specified business.
     */
    public function edit(Business $business)
    {
        // Verificar que el negocio pertenece al usuario autenticado
        if ($business->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar este negocio');
        }

        return view('emprendedor.business.edit', compact('business'));
    }

    /**
     * Update the specified business in storage.
     */
    public function update(Request $request, Business $business)
    {
        // Verificar que el negocio pertenece al usuario autenticado
        if ($business->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar este negocio');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'telephone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $business->update($validated);

        return redirect()->route('emprendedor.business.show', $business)
            ->with('success', 'Negocio actualizado correctamente');
    }

    /**
     * Remove the specified business from storage.
     */
    public function destroy(Business $business)
    {
        // Verificar que el negocio pertenece al usuario autenticado
        if ($business->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar este negocio');
        }

        // Verificar si tiene productos asociados
        if ($business->products()->count() > 0) {
            return back()->with('error', 'No puedes eliminar un negocio que tiene productos asociados');
        }

        $business->delete();

        return redirect()->route('emprendedor.business.index')
            ->with('success', 'Negocio eliminado correctamente');
    }
}