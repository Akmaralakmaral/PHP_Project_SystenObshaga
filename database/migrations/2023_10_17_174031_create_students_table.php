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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('departaments_id');
            $table->foreign('departaments_id')->references('id')->on('departaments');

            $table->unsignedBigInteger('faculty_id'); // Поле "ID факультета" (внешний ключ)
            $table->foreign('faculty_id')->references('id')->on('faculties');

            $table->unsignedBigInteger('course_id'); // Поле "ID курса" (внешний ключ)
            $table->foreign('course_id')->references('id')->on('courses');

            $table->unsignedBigInteger('user_id'); // Поле "ID пользователя" (внешний ключ)
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('group'); // Поле "группа"
            $table->string('direction'); // Поле "направление"
            $table->string('phone_number'); // Поле "номер телефона"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
