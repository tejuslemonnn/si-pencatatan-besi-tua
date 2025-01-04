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
        Schema::create('materialreqs', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('material_no', 255)->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('request');
            $table->unsignedBigInteger('destination');
            // $table->string('product', 60);
            // $table->integer('qty');
            $table->date('schedule');
            $table->date('expired')->nullable();
            // $table->string('description', 128);
            $table->boolean('status', false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materialreqs');
    }
};
