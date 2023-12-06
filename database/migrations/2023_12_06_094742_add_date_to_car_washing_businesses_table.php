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
        Schema::table('car_washing_businesses', function (Blueprint $table) {
            $table->date('date')->after('id'); // 在 'id' 字段后添加 'date' 字段
        });
    }

    /**
     * Reverse the migrations.
     */
    
    public function down(): void
    {
        Schema::table('car_washing_businesses', function (Blueprint $table) {
            $table->dropColumn('date');
        });
    }
};
