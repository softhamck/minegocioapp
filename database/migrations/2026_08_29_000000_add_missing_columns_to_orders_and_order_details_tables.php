<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // El modelo Order y los controladores (Admin/Emprendedor/Cliente) usan estas
        // columnas, pero la tabla original solo tenía order_statuses_id y total.
        Schema::table('orders', function (Blueprint $table) {
            if (! Schema::hasColumn('orders', 'status')) {
                $table->string('status')->default('pending')->after('order_number');
            }
            if (! Schema::hasColumn('orders', 'shipping_address')) {
                $table->text('shipping_address')->nullable()->after('status');
            }
            if (! Schema::hasColumn('orders', 'payment_method')) {
                $table->string('payment_method')->nullable()->after('shipping_address');
            }
            if (! Schema::hasColumn('orders', 'payment_status')) {
                $table->string('payment_status')->default('pending')->after('payment_method');
            }
            if (! Schema::hasColumn('orders', 'notes')) {
                $table->text('notes')->nullable()->after('payment_status');
            }
        });

        // El modelo OrderDetail usa 'price' y 'subtotal', pero la tabla original
        // solo tenía 'unit_price' y 'total' (columna calculada).
        Schema::table('order_details', function (Blueprint $table) {
            if (! Schema::hasColumn('order_details', 'price')) {
                $table->decimal('price', 12, 2)->default(0)->after('quantity');
            }
            if (! Schema::hasColumn('order_details', 'subtotal')) {
                $table->decimal('subtotal', 12, 2)->default(0)->after('price');
            }
        });

        // Rellenar las columnas nuevas a partir de los datos existentes.
        DB::table('order_details')->orderBy('id')->each(function ($detail) {
            DB::table('order_details')->where('id', $detail->id)->update([
                'price' => $detail->unit_price,
                'subtotal' => $detail->quantity * $detail->unit_price,
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['status', 'shipping_address', 'payment_method', 'payment_status', 'notes']);
        });

        Schema::table('order_details', function (Blueprint $table) {
            $table->dropColumn(['price', 'subtotal']);
        });
    }
};
