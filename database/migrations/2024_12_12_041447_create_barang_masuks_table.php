<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('barang_masuks', function (Blueprint $table) {
    //         $table->id();
    //         $table->unsignedBigInteger('produk_id');
    //         $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
    //         $table->double('no_barang_masuk');
    //         $table->date('tanggal');
    //         $table->string('nama_barang');
    //         $table->string('keterangan');
    //         $table->integer('status');
    //         $table->timestamps();
    //     });
    // }

    public function up(): void
    {
        Schema::create('barang_masuk_gudang', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('bruto');
            $table->integer('tara');
            $table->integer('netto');
            $table->integer('netto_total');
            $table->string('nama_barang');
            $table->string('lokasi');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk_gudang');
    }
};
