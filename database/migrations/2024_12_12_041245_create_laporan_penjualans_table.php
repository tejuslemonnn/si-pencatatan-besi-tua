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
        Schema::create('laporan_penjualans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kendaraan_id');
            $table->foreign('kendaraan_id')->references('id')->on('kendaraans');
            $table->foreignId('kapal_id')->constrained('data_kapals')->cascadeOnUpdate();
            $table->date('tanggal');
            $table->integer('bruto_pabrik', false, 0);
            $table->integer('tara_pabrik', false,0);
            $table->integer('netto_pabrik', false, 0);
            $table->integer('potongan', false, 0);
            $table->integer('netto_bersih');
            $table->integer('harga_satuan');
            $table->integer('harga_total');
            $table->date('tgl_lunas');
            $table->integer('uang_masuk');
            $table->string('keterangan');
            $table->string('pembeli');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_penjualans');
    }
};
