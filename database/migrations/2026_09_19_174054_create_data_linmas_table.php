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
        Schema::create('data_linmas', function (Blueprint $table) {
            $table->id();

            $table->string('rw', 10);

            $table->unsignedInteger('jumlah_linmas')->default(0);

            $table->string('nama', 150)->nullable();

            $table->string('nik', 30)->nullable();

            $table->text('alamat')->nullable();

            $table->string('pekerjaan', 100)->nullable();

            $table->unsignedInteger('jumlah_poskamling')->default(0);

            $table->text('keterangan')->nullable();

            $table->string('google_sync_status', 30)
                ->default('pending');

            $table->timestamp('google_synced_at')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Balikkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_linmas');
    }
};
