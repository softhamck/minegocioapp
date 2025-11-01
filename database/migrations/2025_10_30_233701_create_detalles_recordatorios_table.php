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
        Schema::create('detalles_recordatorios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('negocio_id')->constrained('negocios');
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->dateTime('fecha_recordatorio')->nullable();
            $table->boolean('estado')->default(false); // completado o no
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_recordatorios');
    }
};
