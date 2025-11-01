<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalles_pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedidos_id')->constrained('pedidos');
            $table->dateTime('fecha')->nullable();
            $table->decimal('total', 12, 2)->default(0);
            $table->string('metodo')->nullable(); // simulado, stripe, mercadopago
            $table->string('estado')->nullable(); // pendiente, completado, fallido
            $table->string('ruta_factura')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_pagos');
    }
};
