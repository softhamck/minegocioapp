<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\PaymentDetail;

class PaymentsDetailsSeeder extends Seeder
{
    public function run(): void
    {
        $order = Order::first();

        PaymentDetail::create([
            'order_id' => $order->id,
            'date' => now(),
            'total' => $order->total,
            'method' => 'Efectivo',
            'status' => 'completado',
            'invoice_path' => null
        ]);
    }
}
