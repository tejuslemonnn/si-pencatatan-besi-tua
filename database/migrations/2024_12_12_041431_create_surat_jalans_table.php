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
            $table->unsignedBigInteger('barang_keluar_id');
            $table->foreign('barang_keluar_id')->references('id')->on('barang_keluars')->onDelete('cascade');
            $table->double('no_surat');
            $table->date('tanggal_surat');
            $table->integer('pengirim');
            $table->integer('penerima');
            $table->string('deskripsi');
            $table->integer('status');
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
