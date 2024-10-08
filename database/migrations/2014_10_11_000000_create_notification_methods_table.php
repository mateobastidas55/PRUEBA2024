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
        Schema::create('notification_methods', function (Blueprint $table) {
            $table->id();
            $table->string('notification_method_name')->comment('campo que almacena el nombre del metodo de notificacion, sms, email, whatsapp, etc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_methods');
    }
};
