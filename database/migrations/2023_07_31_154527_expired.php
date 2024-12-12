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
        Schema::create('expired', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('type', 255);
            $table->string('warehouse', 255);
            // $table->date('schedule');
            $table->date('expired');
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
