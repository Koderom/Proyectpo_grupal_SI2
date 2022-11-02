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
        Schema::create('reserva_quirofanos', function(Blueprint $table){
            $table->id();
            $table->dateTime('fecha_hora_entrada');
            $table->unsignedTinyInteger('cantidad_horas');
            $table->dateTime('fecha_hora_salida');
            $table->string('tipo_intervencion');
            $table->string('procedimiento');
            //para mas atributos
            $table->unsignedBigInteger('quirofano_id');
            $table->foreign('quirofano_id')->references('id')->on('quirofanos');
            
            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes');
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
        Schema::dropIfExists('reserva_quirofanos');
    }
};
