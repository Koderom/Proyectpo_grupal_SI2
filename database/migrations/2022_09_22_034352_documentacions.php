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
        Schema::create('documentacions', function(Blueprint $table){
            $table->id();
            $table->dateTime('fecha_registro');
            $table->string('tipo_documento');

            $table->unsignedBigInteger('expediente');
            $table->foreign('expediente')->references('id')->on('expedientes');
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
        Schema::drop('documentacions');
    }
};
