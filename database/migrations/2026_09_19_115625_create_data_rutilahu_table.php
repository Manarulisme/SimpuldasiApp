<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migration.
     */
    public function up(): void
    {
        Schema::create('data_rutilahu', function (Blueprint $table) {

            $table->id();

            // Data yang ditampilkan pada tabel index
            $table->string('nik', 20)->nullable();
            $table->string('nama_kepala_keluarga')->nullable();
            $table->text('alamat')->nullable();
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();
            $table->string('kondisi_rumah')->nullable();
            $table->string('tingkat_prioritas')->nullable();
            $table->string('status_bantuan')->nullable();

            // Sinkronisasi Google Sheets
            $table->string('google_sync_status')->default('pending');
            $table->timestamp('google_synced_at')->nullable();

            // Waktu data
            $table->timestamps();
        });
    }

    /**
     * Membatalkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_rutilahu');
    }
};
