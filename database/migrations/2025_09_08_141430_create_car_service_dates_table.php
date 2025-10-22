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
        Schema::create('car_service_dates', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_mantenimiento');
            $table->foreignID('car_id')
                    ->constrained('cars')
                    ->onDelete('cascade');
            $table->foreignID('car_service_id')
                    ->constrained('car_services')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('car_service_dates');
    }
};