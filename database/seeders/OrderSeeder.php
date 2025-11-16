<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Business;
use App\Models\User;


class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $business = \App\Models\Business::first();
        $user = \App\Models\User::where('rol_id', 3)->first(); 

        Order::create([
        'business_id' => $business->id,
        'user_id' => $user->id,
        'order_statuses_id' => 1,
        'order_number' => 'ORD-1001',
        'total' => 150.50,
    ]);
         
    }
}
