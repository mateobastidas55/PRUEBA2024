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
        Schema::create('lottery', function (Blueprint $table) {
            $table->id();
            $table->string('lottery_name')->comment('campo que almacena el nombre de la loteria');
            $table->string('description')->comment('campo que almacena la descripcion de la loteria');
            $table->boolean('status')->comment('campo que almacena el estado de la loteria');
            $table->string('game_rules')->comment('campo que almacena las reglas de juego de la loteria');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lottery');
    }
};
