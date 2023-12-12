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
        Schema::create('applications', function (Blueprint $table) {
             $table->id();
            $table->string('fio');
            $table->date('birth_date');
            $table->string('nationality');
            $table->string('gender');
            $table->string('passport_id');
            $table->string('issuing_authority');
            $table->string('iin');

            $table->text('statement_photo_path')->nullable();
            $table->text('education_work_certificate_path')->nullable();
            $table->text('photo_3_4_path')->nullable();
            $table->text('payment_receipt_path')->nullable();
            $table->text('medical_certificate_path')->nullable();
            $table->text('fluorography_path')->nullable();



            $table->string('residence_address');
            $table->unsignedBigInteger('user_id'); // Поле "ID пользователя" (внешний ключ)
            $table->unsignedBigInteger('student_id')->nullable(); // Поле "ID студента" (внешний ключ)



            $table->unsignedBigInteger('employee_id')->nullable(); // Поле "ID сотрудника" (внешний ключ)
            $table->unsignedBigInteger('statusaplication_id')->nullable(); // Поле "ID статуса заявки" (внешний ключ)
            $table->timestamps();

            // Добавляем внешние ключи для соответствующих полей
            $table->foreign('user_id')->references('id')->on('users')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->nullable();
            $table->foreign('statusaplication_id')->references('id')->on('status_aplications')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
