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
        Schema::create('bitacoras', function(Blueprint $table){
            $table->id();
            $table->string('objeto', 50)->nullable();
            $table->string('entidad_id', 50)->nullable();
            $table->string('entidad_descripcion', 50)->nullable();
            $table->string('verbo', 20);
            $table->dateTime('fecha_hora');
            $table->unsignedBigInteger('user_id');
            $table->string('user_name');
            $table->unsignedBigInteger('persona_id');
            $table->string('nombre_completo');
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
        Schema::dropIfExists('bitacoras');
    }
};
