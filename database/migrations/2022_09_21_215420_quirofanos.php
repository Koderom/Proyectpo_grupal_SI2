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
        Schema::create('quirofanos', function(Blueprint $table){
            $table->id();
            $table->char('estado'); // 'F':full-lleno 'D': disponible 'V': vacio
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
        Schema::dropIfExists('quirofanos');
    }
};
