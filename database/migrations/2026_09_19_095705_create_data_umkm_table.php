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
        Schema::create('data_umkm', function (Blueprint $table) {
            $table->id();

            // Identitas Pelaku UMKM
            $table->string('nama_pelaku_usaha');
            $table->string('nik', 20)->nullable();
            $table->string('no_kk', 20)->nullable();
            $table->string('no_telepon', 20)->nullable();

            // Data Usaha
            $table->string('nama_usaha');
            $table->string('jenis_usaha')->nullable();
            $table->text('alamat_usaha')->nullable();
            $table->string('kelurahan')->default('Binong');
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten_kota')->nullable();

            // Legalitas
            $table->string('nib')->nullable();
            $table->string('npwp')->nullable();
            $table->string('izin_usaha')->nullable();

            // Data Usaha
            $table->string('produk_utama')->nullable();
            $table->decimal('modal_usaha', 15, 2)->nullable();
            $table->decimal('omzet_bulanan', 15, 2)->nullable();
            $table->unsignedInteger('jumlah_tenaga_kerja')->nullable();

            // Klasifikasi
            $table->enum('skala_usaha', [
                'Mikro',
                'Kecil',
                'Menengah'
            ])->nullable();

            // Status
            $table->enum('status_usaha', [
                'Aktif',
                'Tidak Aktif'
            ])->default('Aktif');

            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_umkm');
    }
};
