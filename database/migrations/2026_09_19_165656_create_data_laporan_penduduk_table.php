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
        Schema::create('data_laporan_penduduk', function (Blueprint $table) {

            $table->id();

            // Periode laporan
            $table->string('bulan', 20)->nullable();
            $table->unsignedSmallInteger('tahun')->nullable();

            // Data kependudukan
            $table->unsignedInteger('jumlah_kk')->default(0);
            $table->unsignedInteger('jumlah_laki_laki')->default(0);
            $table->unsignedInteger('jumlah_perempuan')->default(0);

            // Perubahan data penduduk
            $table->unsignedInteger('jumlah_kematian')->default(0);
            $table->unsignedInteger('jumlah_kelahiran')->default(0);
            $table->unsignedInteger('jumlah_pindah_datang')->default(0);
            $table->unsignedInteger('jumlah_pindah_keluar')->default(0);
            $table->unsignedInteger('penduduk_sementara')->default(0);

            // Keterangan
            $table->text('keterangan')->nullable();

            // Google Sheets synchronization
            $table->string('google_sync_status', 30)->default('pending');
            $table->timestamp('google_synced_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_laporan_penduduk');
    }
};
