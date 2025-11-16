<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Business;
use App\Models\User;

class BusinessSeeder extends Seeder
{
    public function run(): void
    {
       $emprendedor = User::where('rol_id', 2)->first();

    Business::create([
        'user_id' => $emprendedor->id,
        'name' => 'Mi Primer Negocio',
        'description' => 'Negocio de prueba para testing',
        'address' => 'Calle 123, Ciudad',
        'telephone' => '3001234567'
    ]);
    }
}
