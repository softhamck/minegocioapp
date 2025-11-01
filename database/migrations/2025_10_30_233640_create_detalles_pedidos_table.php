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
        Schema::create('detalles_pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedidos_id')->constrained('pedidos');
            $table->foreignId('productos_id')->constrained('productos');
            $table->integer('cantidad')->default(1);
            $table->decimal('precio_unitario', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->computed('cantidad * precio_unitario')->nullable(); // opcional, DB depende
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_pedidos');
    }
};
