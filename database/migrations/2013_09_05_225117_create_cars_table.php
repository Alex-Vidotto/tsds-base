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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('matricula')->unique();
            $table->foreignId('car_model_id')
                    ->constrained('car_models')
                    ->onDelete('restrict');
            $table->string('foto')->nullable();
            $table->foreignId('grupo_trabajo_id')
                    ->nullable()
                    ->constrained('grupo_trabajos')
                    ->onDelete('cascade');
            $table->string('estado')->default('disponible');
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
        Schema::dropIfExists('cars');
    }
};
