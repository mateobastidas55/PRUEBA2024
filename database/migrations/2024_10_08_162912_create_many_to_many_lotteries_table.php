<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('many_to_many_lotteries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->comment('campo que almacena el id del usuario al que le pertenece la loteria');
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger('id_lottery')->comment('campo que almacena el id de la loteria asociada');
            $table->foreign('id_lottery')->references('id')->on('games_lottery');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('many_to_many_lotteries');
    }
};
