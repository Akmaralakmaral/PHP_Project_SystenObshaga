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
        Schema::create('aplications', function (Blueprint $table) {
              $table->id();
            $table->string('fio');
            $table->date('birth_date');
            $table->string('nationality');
            $table->string('gender');
            $table->string('passport_id');
            $table->string('issuing_authority');
            $table->string('iin');
            $table->string('statement_photo'); // Путь к фото заявления
            $table->string('photo_3_4'); // Путь к фото 3/4
            $table->string('education_work_certificate'); // Путь к справке с места учебы/работы
            $table->string('payment_receipt'); // Путь к чеку оплаты
            $table->string('medical_certificate'); // Путь к медицинской справке
            $table->string('fluorography'); // Путь к флюорографии
            $table->string('residence_address');
            $table->unsignedBigInteger('user_id'); // Поле "ID пользователя" (внешний ключ)
            $table->unsignedBigInteger('student_id'); // Поле "ID студента" (внешний ключ)
            $table->unsignedBigInteger('employee_id'); // Поле "ID сотрудника" (внешний ключ)
            $table->unsignedBigInteger('statusaplication_id'); // Поле "ID статуса заявки" (внешний ключ)
            $table->timestamps();

            // Добавляем внешние ключи для соответствующих полей
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('statusaplication_id')->references('id')->on('status_aplications');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aplications');
    }
};
