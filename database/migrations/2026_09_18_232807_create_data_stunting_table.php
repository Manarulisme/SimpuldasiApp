<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_stunting', function (Blueprint $table) {

            $table->id();

            $table->string('nik', 20)->unique();

            $table->string('nama', 150);

            $table->date('tanggal_lahir');

            $table->enum('jenis_kelamin', [
                'Laki-laki',
                'Perempuan'
            ]);

            $table->enum('status', [
                'Normal',
                'Berisiko',
                'Stunting'
            ]);

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
        Schema::dropIfExists('data_stunting');
    }
};
