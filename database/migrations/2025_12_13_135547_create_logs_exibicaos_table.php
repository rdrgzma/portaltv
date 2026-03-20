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
        Schema::create('logs_exibicaos', function (Blueprint $table) {
            $table->id();
            
            $table->string('tipo'); // video, anuncio
            $table->unsignedBigInteger('referencia_id');

            $table->dateTime('inicio');
            $table->dateTime('fim')->nullable();

            $table->integer('visualizacoes')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs_exibicaos');
    }
};
