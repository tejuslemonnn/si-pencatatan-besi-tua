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
            $table->unsignedBigInteger('data_kapal_id');
            $table->foreign('data_kapal_id')->references('id')->on('data_kapals')->onDelete('cascade');
            $table->unsignedBigInteger('surat_jalan_id');
            $table->foreign('surat_jalan_id')->references('id')->on('surat_jalans')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('kode');
            $table->integer('bruto');
            $table->integer('tara');
            $table->integer('netto');
            // $table->integer('harga');
            $table->integer('jumlah_harga');
            // $table->string('nama_barang');
            $table->unsignedBigInteger('produk_id');
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
            // $table->string('pesanan_dari');
            $table->unsignedBigInteger('perusahaan_id');
            $table->foreign('perusahaan_id')->references('id')->on('perusahaans')->onDelete('cascade');
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
