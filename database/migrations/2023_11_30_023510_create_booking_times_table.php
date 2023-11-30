<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('booking_times', function (Blueprint $table) {
            $table->id();
            $table->integer('available_slots')->unsigned();
            $table->time('time_slot');
            $table->time('operating_start_time');
            $table->time('operating_end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_times');
    }
};
