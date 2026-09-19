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
        Schema::table('data_umkm', function (Blueprint $table) {
            $table->string('google_sync_status', 255)
                ->default('pending')
                ->after('keterangan');

            $table->timestamp('google_synced_at')
                ->nullable()
                ->after('google_sync_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_umkm', function (Blueprint $table) {
            $table->dropColumn([
                'google_sync_status',
                'google_synced_at',
            ]);
        });
    }
};

