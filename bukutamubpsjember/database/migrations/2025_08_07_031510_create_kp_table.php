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
        Schema::create('kp', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('tahun', 4)->change();
            $table->varchar('bulan', 2)->change();
            $table->varchar('hari', 2)->change();
            $table->varchar('waktu', 8)->change();
            $table->varchar('email', 64)->change();
            $table->varchar('kepuasan', 11)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kp');
    }
};
