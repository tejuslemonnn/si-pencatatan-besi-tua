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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_kapal_id');
            $table->foreign('data_kapal_id')->references('id')->on('data_kapals')->onDelete('cascade');
            // $table->unsignedBigInteger('kategori_id');
            // $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
            $table->double('kode');
            $table->string('nama');
            // $table->integer('berat');
            $table->integer('qty')->default(0);
            $table->integer('harga');
            // $table->string('picture')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
