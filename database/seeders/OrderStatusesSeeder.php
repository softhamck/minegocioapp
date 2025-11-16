<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('order_statuses')->insert([
            ['name' => 'Pendiente'],
            ['name' => 'Enviado'],
            ['name' => 'Completado'],
            ['name' => 'Cancelado'],
        ]);
    }
}
