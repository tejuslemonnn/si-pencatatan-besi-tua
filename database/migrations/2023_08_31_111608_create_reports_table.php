<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('itr_id');
            $table->unsignedBigInteger('product');
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('from_warehouse_id');
            $table->string('product_name', 255);
            $table->integer('current_qty');
            $table->integer('in_qty');
            $table->integer('out_qty')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
