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
        Schema::create('anuncios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anunciante_id')->constrained()->cascadeOnDelete();

            $table->enum('tipo', [
                'banner_vertical',
                'banner_horizontal',
                'banner_noticia',
                'banner_imovel',
                'video_webtv'
            ]);

            $table->string('arquivo');
            $table->string('link')->nullable();

            $table->date('inicio');
            $table->date('fim');

            $table->integer('prioridade')->default(0);
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anuncios');
    }
};
