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
        Schema::create('personas', function(Blueprint $table){
            $table->id();
            $table->string('nombre',120);
            $table->string('apellido_paterno',120);
            $table->string('apellido_materno',120);
            $table->char('sexo',1);
            $table->unsignedInteger('edad');
            $table->date('fecha_nacimiento');
            $table->unsignedInteger('telefono');
            $table->text('direccion');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::drop('personas');
    }
};
