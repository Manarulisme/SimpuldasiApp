<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('data_pkl', function (Blueprint $table) {
            $table->id();

            $table->string('nama_pkl', 150);
            $table->string('jenis_dagangan', 100);
            $table->string('lokasi', 255)->nullable();
            $table->text('keterangan')->nullable();

            // Status sinkronisasi Google Sheets
            $table->string('google_sync_status', 30)
                ->default('pending');

            $table->dateTime('google_synced_at')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Balikkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pkl');
    }
};
