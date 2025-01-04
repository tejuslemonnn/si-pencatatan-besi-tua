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
        Schema::create('detailmaterials', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->foreignId('material_id');
            $table->string('product', 255);
            $table->integer('qty');
            $table->string('description', 128)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailmaterials');
    }
};
