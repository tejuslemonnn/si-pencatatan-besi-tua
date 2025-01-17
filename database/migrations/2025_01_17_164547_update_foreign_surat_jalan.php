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
        Schema::table('surat_jalans', function (Blueprint $table) {
            $table->unsignedBigInteger('barang_keluar_besi_tua_id')->nullable();
            $table->foreign('barang_keluar_besi_tua_id')->references('id')->on('barang_keluar_besi_tuas')->onDelete('cascade');
            $table->unsignedBigInteger('barang_keluar_besi_scrap_id')->nullable();
            $table->foreign('barang_keluar_besi_scrap_id')->references('id')->on('barang_keluar_besi_scraps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_jalans', function (Blueprint $table) {
            $table->dropForeign(['barang_keluar_besi_tua_id']);
            $table->dropColumn('barang_keluar_besi_tua_id');
            $table->dropForeign(['barang_keluar_besi_scrap_id']);
            $table->dropColumn('barang_keluar_besi_scrap_id');
        });
    }
};
