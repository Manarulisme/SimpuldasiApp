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
        Schema::create('data_posyandu', function (Blueprint $table) {
 $table->id();

            $table->string('id_data', 50)->unique();

            $table->string('jenis', 100);
            $table->string('nama', 150);

            $table->string('rw', 10)->nullable();

            $table->integer('jumlah_kader')->default(0);

            $table->text('keterangan')->nullable();

            // Status sinkronisasi ke Google Sheets
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
        Schema::dropIfExists('data_posyandu');
    }
};
