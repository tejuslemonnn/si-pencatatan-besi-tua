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
        Schema::create('kepala_perusahaan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('username', 20);
            $table->string('password', 16);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepala_perusahaan');
    }
};
