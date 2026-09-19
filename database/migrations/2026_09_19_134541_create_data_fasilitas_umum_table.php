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
        Schema::create('data_fasilitas_umum', function (Blueprint $table) {

            $table->id();

            $table->string('nama')->nullable();

            $table->string('lokasi')->nullable();

            $table->string('jenis')->nullable();

            $table->text('alamat')->nullable();

            $table->string('sumber_dana')->nullable();

            $table->string('google_sync_status')
                ->default('pending');

            $table->timestamp('google_synced_at')
                ->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_fasilitas_umum');
    }
};
