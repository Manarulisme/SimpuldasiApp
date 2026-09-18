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
        Schema::create('data_bmd', function (Blueprint $table) {
  // ID internal Laravel / MySQL
            $table->id();

            // ID BMD diisi manual oleh pihak kelurahan
            $table->string('id_data', 50)->unique();

            // Nama barang
            $table->string('nama_barang', 150);

            // Type barang
            $table->string('type', 150)->nullable();

            // Tahun perolehan
            $table->year('tahun_perolehan')->nullable();

            // Sumber dana
            $table->string('sumber_dana', 100)->nullable();

            // Kondisi barang
            $table->string('kondisi', 50)->nullable();

            // Keterangan
            $table->text('keterangan')->nullable();

            // Status sinkronisasi Google Sheet
            $table->string('google_sync_status', 20)
                ->default('pending');

            // Waktu terakhir berhasil sinkron
            $table->timestamp('google_synced_at')
                ->nullable();

            // created_at dan updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_bmd');
    }
};
