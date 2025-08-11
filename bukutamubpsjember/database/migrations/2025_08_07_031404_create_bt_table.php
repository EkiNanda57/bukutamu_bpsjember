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
        Schema::create('bt', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->string('bulan');
            $table->string('hari');
            $table->string('waktu');
            $table->string('nama');
            $table->string('email');
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('umur');
            $table->string('asal');
            $table->string('jk');
            $table->string('pendidikan');
            $table->string('pekerjaan');
            $table->string('keperluan');
            $table->string('k_lain')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bt');
    }
};
