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
        schema::create('salas', function(Blueprint $table){
            $table->id();
            $table->unsignedInteger('nro_sala');
            $table->unsignedInteger('capacidad');
            $table->char('tipo_sala');//I -> internacion, C->consultorio, Q->quirofano

            $table->unsignedBigInteger('sector_id');
            $table->foreign('sector_id')->references('id')->on('sectors');
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
        schema::drop('salas');
    }
};
