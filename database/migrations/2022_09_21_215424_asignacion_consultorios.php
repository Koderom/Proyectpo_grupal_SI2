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
        Schema::create('asignacion_consultorios', function(Blueprint $table){
            $table->id();
            $table->date('fecha_inicio');
            $table->unsignedInteger('cantidad_dias');
            $table->date('fecha_finalizacion');
            $table->time('hora_entrada');
            //$table->unsignedTinyInteger('horas_asigandas');
            $table->time('hora_salida');
            //Espacio para mas atributos
            $table->unsignedBigInteger('consultorio_id');
            $table->foreign('consultorio_id')->references('id')->on('consultorios');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors');
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
        Schema::dropIfExists('asignacion_consultorios');
    }
};
