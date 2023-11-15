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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Поле "id пользователя" (внешний ключ)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('specialty_name');
            //$table->string('specialty_name'); // Поле "наименование специальности"
            $table->string('phone_number'); // Поле "номер телефона"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
