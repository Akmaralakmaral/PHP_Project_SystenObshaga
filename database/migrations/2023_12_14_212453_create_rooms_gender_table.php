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
        Schema::create('rooms_gender', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('room_number');
            $table->string('roomGender');
            $table->unsignedBigInteger('obshaga_id');
            $table->foreign('obshaga_id')->references('id')->on('obshagas');
            $table->unsignedBigInteger('room_status_id');
            $table->foreign('room_status_id')->references('id')->on('status_rooms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms_gender');
    }
};
