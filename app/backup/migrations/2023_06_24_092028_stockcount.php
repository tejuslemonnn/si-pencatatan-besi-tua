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
        Schema::create('stockcount', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('sc_no', 255)->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('inventory', 255);
            $table->unsignedBigInteger('warehouse');
            // $table->string('destination', 255);
            $table->date('schedule');
            $table->date('expired')->nullable();
            $table->boolean('status', false);
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
