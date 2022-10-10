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
        Schema::create('cupos', function(Blueprint $table){
            $table->id();
            $table->char('estado',1);//D:disponible R:reservado
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->timestamps();

            $table->unsignedBigInteger('agenda_id');
            $table->foreign('agenda_id')->references('id')->on('agendas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cupos');
    }
};
