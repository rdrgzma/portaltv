<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anuncios', function (Blueprint $table) {
            // Altera de ENUM para STRING para dar flexibilidade aos novos tipos
            $table->string('tipo')->change(); 
        });
    }

    public function down(): void
    {
        Schema::table('anuncios', function (Blueprint $table) {
            // Reverte para o estado original se necessário
            $table->enum('tipo', [
                'banner_vertical',
                'banner_horizontal',
                'banner_noticia',
                'banner_imovel',
                'video_webtv'
            ])->change();
        });
    }
};
