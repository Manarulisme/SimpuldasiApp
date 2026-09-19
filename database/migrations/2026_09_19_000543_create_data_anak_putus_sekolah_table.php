<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_anak_putus_sekolah', function (Blueprint $table) {
            $table->id();

            $table->string('id_data', 50)->unique();

            $table->string('nik', 20)->unique();

            $table->string('nama', 150);

            $table->string('rw', 10)->nullable();

            $table->unsignedTinyInteger('usia');

            $table->string('jenjang_terakhir', 100);

            $table->string('alasan', 255);

            $table->text('keterangan')->nullable();

            $table->enum('google_sync_status', [
                'pending',
                'synced',
                'failed'
            ])->default('pending');

            $table->timestamp('google_synced_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_anak_putus_sekolah');
    }
};
