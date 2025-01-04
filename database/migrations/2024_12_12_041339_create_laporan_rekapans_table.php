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
            $table->integer('netto_total_barang');
            $table->integer('netto_ke_pabrik');
            $table->integer('netto_terjual_di_kamal');
            $table->integer('netto_ke_gudang');
            $table->integer('netto_terjual_di_gudang');
            $table->integer('tekor_timbangan');
            $table->integer('total_penjualan_kamal');
            $table->integer('total_penjualan_gudang');
            $table->integer('total_penjualan_pabrik');
            $table->integer('total_penjualan_seluruh');
            $table->integer('pengeluaran');
            $table->integer('modal');
            $table->integer('laba_bersih');
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
