<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_buruan_sae', function (Blueprint $table) {
            $table->id();

            $table->string('nama')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('rw', 5)->nullable();
            $table->string('jenis_tanaman')->nullable();
            $table->string('luas_area')->nullable();

            $table->string('google_sync_status')->default('pending');
            $table->timestamp('google_synced_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_buruan_sae');
    }
};
