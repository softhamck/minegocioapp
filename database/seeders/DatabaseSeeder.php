<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UsersSeeder::class,
            BusinessSeeder::class,
            OrderStatusesSeeder::class,
            ProductsSeeder::class,
            OrderSeeder::class,
            OrderDetailsSeeder::class,
            PaymentsDetailsSeeder::class,
        ]);
    }
}
