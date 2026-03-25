<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anuncios', function (Blueprint $table) {
            // Define qual fonte de mídia será exibida: 'arquivo' ou 'youtube'
            $table->string('exibir_midia')->default('arquivo')->after('youtube_url');
        });
    }

    public function down(): void
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->dropColumn('exibir_midia');
        });
    }
};
