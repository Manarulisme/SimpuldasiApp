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
        Schema::create('data_umum_kepegawaian', function (Blueprint $table) {
            $table->id();
            $table->string('jenis', 50);
            $table->string('nomor', 100);
            $table->string('nama', 150);
            $table->string('golongan', 20);
            $table->string('pangkat', 100);
            $table->string('jabatan', 150);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_umum_kepegawaian');
    }
};
