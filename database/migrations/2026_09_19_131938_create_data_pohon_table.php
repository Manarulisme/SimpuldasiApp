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
Schema::create('data_pohon', function (Blueprint $table) {


    $table->id();

    $table->string('jenis_pohon')->nullable();

    $table->text('lokasi')->nullable();

    $table->integer('jumlah')->nullable();

    $table->string('kondisi')->nullable();

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
        Schema::dropIfExists('data_pohon');
    }
};
