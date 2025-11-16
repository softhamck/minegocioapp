<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Business;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
         $business = Business::first();

    Product::create([
        'business_id' => $business->id,
        'name' => 'Producto de prueba 1',
        'description' => 'Descripción del producto de prueba',
        'price' => 100,
        'quantity' => 20,   // corregido (antes stock)
        'active' => true,
    ]);

    Product::create([
        'business_id' => $business->id,
        'name' => 'Producto de prueba 2',
        'description' => 'Otro producto de prueba',
        'price' => 50,
        'quantity' => 15,   // corregido
        'active' => true,
    ]);
    }
}
