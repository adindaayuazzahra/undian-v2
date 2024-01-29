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
        Schema::create('display', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_hadiah')->nullable();
            $table->integer('status');
            $table->foreign('id_hadiah')->references('id')->on('hadiah')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('display');
    }
};
