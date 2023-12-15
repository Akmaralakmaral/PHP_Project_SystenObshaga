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
        Schema::create('passes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id'); // Поле "id студент" (внешний ключ)
            $table->foreign('student_id')->references('id')->on('students');

            $table->date('start_date');
            $table->date('end_date');

            $table->unsignedBigInteger('room_id'); // Поле "id комнаты" (внешний ключ)
            $table->foreign('room_id')->references('id')->on('rooms');

            $table->unsignedBigInteger('employee_id'); // Поле "id сотрудника" (внешний ключ)
            $table->foreign('employee_id')->references('id')->on('employees');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passes');
    }
};
