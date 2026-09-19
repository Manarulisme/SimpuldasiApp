<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_sekolah', function (Blueprint $table) {
            $table->id();

            $table->string('id_data', 50)->unique();

            $table->string('nama_sekolah', 150);

            $table->enum('jenjang', [
                'TK',
                'SD',
                'SMP',
                'SMA',
                'SMK'
            ]);

            $table->text('alamat');

            $table->unsignedInteger('jumlah_siswa')->default(0);

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
        Schema::dropIfExists('data_sekolah');
    }
};
