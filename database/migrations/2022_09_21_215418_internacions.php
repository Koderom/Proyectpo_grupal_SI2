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
        Schema::create('internacions', function(Blueprint $table){
            $table->id();
            //agregar mas atributos
            $table->unsignedBigInteger('tipo_internacion_id');
            $table->foreign('tipo_internacion_id')->references('id')->on('tipo_internacions');
            $table->unsignedBigInteger('sala_id');
            $table->foreign('sala_id')->references('id')->on('salas');
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
        Schema::dropIfExists('internacions');
    }
};
