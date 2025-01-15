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
        Schema::create('barang_masuk_besi_tuas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_kapal_id');
            $table->foreign('data_kapal_id')->references('id')->on('data_kapals')->onDelete('cascade');
            $table->date('tanggal');
            // $table->string('nopol');
            $table->integer('bruto');
            $table->integer('tara');
            $table->integer('netto');
            $table->integer('jumlah');
            // $table->unsignedBigInteger('produk_id');
            // $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
            $table->string('nama_barang');
            $table->string('pesanan_dari');
            // $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk_besi_tuas');
    }
};
