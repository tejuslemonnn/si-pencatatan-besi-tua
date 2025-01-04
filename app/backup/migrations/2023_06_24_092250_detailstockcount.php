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
        Schema::create('detailstockcount', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->foreignId('stockcount_id');
            $table->unsignedBigInteger('product');
            $table->integer('qty');
            $table->longText('description')->nullable();
            // $table->integer('current_qty')->nullable();
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
        //
    }
};
