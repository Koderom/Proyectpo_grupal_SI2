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
        Schema::create('cama_pacientes', function(Blueprint $table){
            $table->id();
            $table->date('fecha_ingreso');
            $table->unsignedInteger('dias_estida');
            //para mas atributos
            $table->unsignedBigInteger('cama_id');
            $table->foreign('cama_id')->references('id')->on('camas');
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
        Schema::dropIfExists('cama_pacientes');
    }
};
