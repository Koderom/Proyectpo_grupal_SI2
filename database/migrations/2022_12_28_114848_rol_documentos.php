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
        Schema::create('rol_documentos',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('documentacion_id');
            $table->unsignedBigInteger('role_id');
            $table->foreign('documentacion_id')->references('id')->on('documentacions');
            $table->foreign('role_id')->references('id')->on('roles');
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
        Schema::dropIfExists('rol_documentos');
    }
};
