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
        schema::create('pacientes', function(Blueprint $table){
            $table->id();
            $table->unsignedInteger('persona_id');
            $table->string('nombre_tutor');
            $table->unsignedInteger('numero_telefono_tutor');
            $table->unsignedBigInteger('sala_id')->nullable();//duda

            $table->foreign('sala_id')->references('id')->on('salas');//
            $table->foreign('persona_id')->references('id')->on('personas');
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
        Schema::drop('pacientes');
    }
};
