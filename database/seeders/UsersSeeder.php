<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'rol_id' => 1,
            'email' => 'admin@minegocioapp.com',
            'password' => Hash::make('admin123'),
        ]);
    }
}
