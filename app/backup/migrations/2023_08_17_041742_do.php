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
        Schema::create('do', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('do_no', 255)->unique();
            $table->string('itr_no', 255);
            $table->unsignedBigInteger('source');
            $table->unsignedBigInteger('destination');
            $table->date('created_date');
            $table->date('delivery_date')->nullable();
            $table->boolean('status', false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('do');
    }
};
