<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios_asignados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grupo_trabajo_id')->constrained()->onDelete('cascade');
            $table->foreignId('tarea_id')->constrained()->onDelete('cascade');
            $table->string('cliente');
            $table->decimal('costo_final', 10, 2);
            $table->text('notas_cliente')->nullable();
            $table->enum('estado', ['pendiente', 'en_proceso', 'completado'])->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios_asignados');
    }
};
