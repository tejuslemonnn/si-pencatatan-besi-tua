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
        Schema::create('laporan_rekapans', function (Blueprint $table) {
            $table->id();
            $table->integer('keseluruhan');
            $table->integer('besi_tua_ke_pabrik');
            $table->integer('terjual_di_kamal');
            $table->integer('masuk_gudang_sb');
            $table->integer('tekor_timbangan');
            $table->integer('status');
            $table->integer('penjualan');
            $table->integer('total_penjualan');
            $table->integer('pengeluaran');
            $table->integer('modal');
            $table->integer('laba_besih');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_rekapans');
    }
};
