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
        Schema::create('barang_keluar_besi_scraps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_kapal_id');
            $table->foreign('data_kapal_id')->references('id')->on('data_kapals')->onDelete('cascade');
            $table->unsignedBigInteger('surat_jalan_id');
            $table->foreign('surat_jalan_id')->references('id')->on('surat_jalans')->onDelete('cascade');
            $table->string('kode');
            $table->date('tanggal');
            $table->integer('bruto_sb');
            $table->integer('tara_sb');
            $table->integer('netto_sb');
            $table->integer('bruto_pabrik');
            $table->integer('tara_pabrik');
            $table->integer('netto_pabrik');
            $table->integer('pot');
            $table->integer('netto_bersih');
            $table->integer('harga');
            $table->integer('jumlah_harga');
            // $table->string('pesanan_dari');
            $table->unsignedBigInteger('perusahaan_id');
            $table->foreign('perusahaan_id')->references('id')->on('perusahaans')->onDelete('cascade');
            $table->boolean('status')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluar_besi_scraps');
    }
};
