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
        Schema::create('campeonato', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->unsignedBigInteger('primeiro');
            $table->foreign('primeiro')->references('id')->on('times');
            $table->unsignedBigInteger('segundo');
            $table->foreign('segundo')->references('id')->on('times');
            $table->unsignedBigInteger('terceiro');
            $table->foreign('terceiro')->references('id')->on('times');
            $table->unsignedBigInteger('quarto');
            $table->foreign('quarto')->references('id')->on('times');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campeonato');
    }
};
