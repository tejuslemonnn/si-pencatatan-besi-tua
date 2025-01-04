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
    //     Schema::create('barang_keluars', function (Blueprint $table) {
    //         $table->id();
    //         $table->unsignedBigInteger('user_id');
    //         $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    //         $table->unsignedBigInteger('produk_id');
    //         $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
    //         $table->unsignedBigInteger('kendaraan_id');
    //         $table->foreign('kendaraan_id')->references('id')->on('kendaraans')->onDelete('cascade');
    //         $table->string('nama_barang');
    //         $table->integer('qty_total');
    //         $table->date('delivery_date');
    //         $table->string('tujuan_pengiriman');
    //         $table->integer('status');
    //         $table->string('catatan')->nullable();
    //         $table->timestamps();
    //     });
    // }

    public function up(): void
    {
        Schema::create('barang_keluar_kapal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_kapal_id')->constrained('data_kapals')->cascadeOnUpdate();
            $table->date('tanggal');
            $table->char('no_polisi', 15);
            $table->integer('bruto');
            $table->integer('tara');
            $table->integer('netto');
            $table->integer('netto_total');
            $table->string('nama_barang');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluar_kapal');
    }
};
