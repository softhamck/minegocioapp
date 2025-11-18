<?php

namespace App\Http\Controllers\Emprendedor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index()
    {
        $businesses = auth()->user()->businesses;
        return view('emprendedor.business.index', compact('businesses'));
    }

    public function create()
    {
        return view('emprendedor.business.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'phone' => 'nullable',
        ]);

        auth()->user()->businesses()->create($request->all());

        return redirect()
            ->route('emprendedor.business.index')
            ->with('success', 'Negocio creado con éxito');
    }

    public function show($business)
    {
        $business = auth()->user()->businesses()->findOrFail($business);

        return view('emprendedor.business.show', compact('business'));
    }

}
