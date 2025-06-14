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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('barang_keluar_besi_tuas')->nullable();
            $table->foreign('barang_keluar_besi_tuas')->references('id')->on('barang_keluar_besi_tuas')->onDelete('cascade');
            $table->unsignedBigInteger('barang_keluar_besi_scraps')->nullable();
            $table->foreign('barang_keluar_besi_scraps')->references('id')->on('barang_keluar_besi_scraps')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
