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
        Schema::create('detail_do', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->foreignId('do_id');
            $table->unsignedBigInteger('product');
            $table->string('product_name', 255);
            $table->integer('qty');
            // $table->integer('current_qty')->nullable();
            $table->longText('description')->nullable();
            // $table->string('source', 255);
            // $table->string('destination', 255);
            // $table->date('schedule');
            // $table->integer('transfer_qty');
            // $table->integer('return_qty')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_do');
    }
};
