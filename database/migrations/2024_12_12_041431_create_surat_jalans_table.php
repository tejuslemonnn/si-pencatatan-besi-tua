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
        Schema::create('surat_jalans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kendaraan_id');
            $table->foreign('kendaraan_id')->references('id')->on('kendaraans')->onDelete('cascade');
            $table->unsignedBigInteger('barang_keluar_besi_tua_id')->nullable();
            $table->foreign('barang_keluar_besi_tua_id')->references('id')->on('barang_keluar_besi_tuas')->onDelete('cascade');
            $table->unsignedBigInteger('barang_keluar_besi_scrap_id')->nullable();
            $table->foreign('barang_keluar_besi_scrap_id')->references('id')->on('barang_keluar_besi_scraps')->onDelete('cascade');
            $table->string('no_surat');
            $table->date('tanggal_surat');
            $table->integer('netto_bersih');
            $table->string('penerima');
            $table->string('deskripsi');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_jalans');
    }
};
