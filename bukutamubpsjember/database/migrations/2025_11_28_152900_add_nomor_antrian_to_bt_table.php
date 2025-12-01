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
        Schema::table('bt', function (Blueprint $table) {
            // Tambah kolom baru
            $table->integer('nomor_antrian')->nullable()->after('k_lain');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bt', function (Blueprint $table) {
            // Jika rollback, hapus kembali kolomnya
            $table->dropColumn('nomor_antrian');
        });
    }
};
