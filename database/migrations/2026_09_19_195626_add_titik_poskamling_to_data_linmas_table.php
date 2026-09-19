<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_linmas', function (Blueprint $table) {
            $table->string('titik_poskamling', 255)
                ->nullable()
                ->after('jumlah_poskamling');
        });
    }

    public function down(): void
    {
        Schema::table('data_linmas', function (Blueprint $table) {
            $table->dropColumn('titik_poskamling');
        });
    }
};
