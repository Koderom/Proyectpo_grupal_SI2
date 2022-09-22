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
        Schema::create('historial_clinicos', function(Blueprint $table){
            $table->id();
            $table->string('enfermedad_diagnosticada',150);
            $table->string('manifestaciones_clinicas',150);
            $table->dateTime('fecha_registro');
            $table->string('estado_paciente');

            $table->unsignedBigInteger('administrativo_id');//persona que registra el historial
            $table->foreign('administrativo_id')->references('id')->on('administrativos');
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
        Schema::drop('historial_clinicos');
    }
};
