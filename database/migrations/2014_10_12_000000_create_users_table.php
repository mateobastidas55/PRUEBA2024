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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('campo que almacena el nombre del usuario');
            $table->string('lastname')->comment('campo que almacena el apellido del usuario');
            $table->string('email')->unique()->comment('campo que almacena el correo del usuario');
            $table->date('birt_day')->commment('campo que almacena la fecha de cumpleaños del usuario');
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedBigInteger('id_notification_method_favorite');
            $table->foreign('id_notification_method_favorite')->references('id')->on('notification_methods');
            $table->string('password');
            $table->unsignedBigInteger('id_rol');
            $table->foreign('id_rol')->references('id')->on('rol');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
