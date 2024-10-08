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
        Schema::create('games_lottery', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_lottery')->comment('campo que almacena el id de la loteria');
            $table->foreign('id_lottery')->references('id')->on('lottery');
            $table->dateTime('game_date')->comment('campo que almacena la fecha de juego');
            $table->bigInteger('reward')->comment('campo que almacena la recompensa del premio');
            $table->bigInteger('id_user')->nullable()->comment('campo que almacena el id del ganador');
            $table->boolean('winner')->nullable()->comment('campo que almacena el numero ganador');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games_lottery');
    }
};
