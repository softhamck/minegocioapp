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
        Schema::create('detalles_metricas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('negocio_id')->constrained('negocios');
            $table->date('fecha');
            $table->decimal('ventas_totales', 12, 2)->default(0);
            $table->integer('ordenes')->default(0);
            $table->integer('clientes')->default(0);
            $table->timestamps();

            $table->unique(['negocio_id','fecha']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_metricas');
    }
};
