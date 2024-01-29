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
        Schema::create('peserta', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('npp');
            $table->integer('passcode');
            $table->string('unit');
            $table->unsignedBigInteger('id_hadiah')->nullable();
            $table->integer('status');
            $table->foreign('id_hadiah')->references('id')->on('hadiah')->cascadeOnUpdate()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta');
    }
};
