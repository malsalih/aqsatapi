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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('notes')->nullable();
            $table->string('image')->nullable();
            $table->integer('balance')->default(0);
            $table->integer('qast')->default(0);
            $table->foreignId('qast_period_id')->nullable();
            $table->dateTime('last_payment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
