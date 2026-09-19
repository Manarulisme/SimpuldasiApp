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
        Schema::create('laporan_bulanan', function (Blueprint $table) {
            $table->id();

            // Menu/data yang dilaporkan
            $table->string('menu', 100);

            // Nama/judul laporan
            $table->string('judul_laporan', 255);

            // Periode laporan
            $table->unsignedTinyInteger('bulan');
            $table->unsignedSmallInteger('tahun');

            // Nama file PDF
            $table->string('nama_file', 255)->nullable();

            // Lokasi/path file PDF jika nantinya disimpan
            $table->string('file_path', 500)->nullable();

            // Status laporan
            $table->string('status', 30)->default('draft');

            // Keterangan tambahan
            $table->text('keterangan')->nullable();

            // Waktu laporan dibuat
            $table->timestamp('generated_at')->nullable();

            $table->timestamps();

            // Mempercepat pencarian laporan berdasarkan menu dan periode
            $table->index(['menu', 'tahun', 'bulan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_bulanan');
    }
};
