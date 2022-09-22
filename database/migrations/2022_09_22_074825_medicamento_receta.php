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
        Schema::create('medicamento_recetas', function(Blueprint $table){
            $table->id();
            $table->unsignedInteger('cantidad_total');
            $table->string('dosis', 120);
            $table->string('frecuescia',120);


            $table->unsignedBigInteger('medicamento_id');
            $table->foreign('medicamento_id')->references('id')->on('medicamentos');
            $table->unsignedBigInteger('receta_id');
            $table->foreign('receta_id')->references('id')->on('recetas');
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
        Schema::create('medicamento_recetas');
    }
};
