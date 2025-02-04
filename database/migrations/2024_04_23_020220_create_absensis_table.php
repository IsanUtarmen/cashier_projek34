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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->string('namaKaryawan');
            $table->date('tanggalMasuk');
            $table->time('waktuMasuk');
            $table->enum('status', ['masuk', 'cuti', 'sakit']); // Tambahkan daftar nilai yang diperbolehkan
            $table->time('waktuKeluar'); // Ubah menjadi timestamp dan tambahkan nullable
            $table->timestamps(); // Hanya diperlukan sekali


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
