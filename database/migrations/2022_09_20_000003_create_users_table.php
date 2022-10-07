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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('persona_id');
            $table->string('name')->unique();// Usuario
            $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable(); //pregunta al grupo
            $table->string('password');
            $table->rememberToken();

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
        Schema::dropIfExists('users');
    }
};
