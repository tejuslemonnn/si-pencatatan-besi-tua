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
        Schema::create('barang_keluar_besi_tuas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_jalan_id');
            $table->foreign('surat_jalan_id')->references('id')->on('surat_jalans')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('kode');
            $table->integer('bruto');
            $table->integer('tara');
            $table->integer('netto');
            $table->integer('harga');
            $table->integer('jumlah_harga');
            $table->string('nama_barang');
            $table->string('pesanan_dari');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluar_besi_tuas');
    }
};
