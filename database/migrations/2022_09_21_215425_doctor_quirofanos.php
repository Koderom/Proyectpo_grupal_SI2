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
        Schema::create('doctor_quirofanos', function(Blueprint $table){
            $table->id();
            $table->string('funcion',100);
            // para mas atributos
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->unsignedBigInteger('reserva_quirofano_id');
            $table->foreign('reserva_quirofano_id')->references('id')->on('reserva_quirofanos');
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
        Schema::dropIfExists('doctor_quirofanos');
    }
};
