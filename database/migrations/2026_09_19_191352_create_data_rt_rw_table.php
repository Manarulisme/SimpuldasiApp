<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_rt_rw', function (Blueprint $table) {

            $table->id();

            $table->string('nama_rt', 150);

            $table->string('nomor_rt', 20);

            $table->string('nama_rw', 150);

            $table->string('nomor_rw', 20);

            $table->date('tanggal_mulai')->nullable();

            $table->date('tanggal_berakhir')->nullable();

            $table->string('google_sync_status', 30)
                ->default('pending');

            $table->timestamp('google_synced_at')
                ->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_rt_rw');
    }
};
