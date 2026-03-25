<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anuncios', function (Blueprint $table) {
            // Torna o arquivo nullable pois agora é opcional (pode usar youtube_url)
            $table->string('arquivo')->nullable()->change();

            // Adiciona suporte a link direto do YouTube
            $table->string('youtube_url')->nullable()->after('arquivo');
        });
    }

    public function down(): void
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->dropColumn('youtube_url');
            $table->string('arquivo')->nullable(false)->change();
        });
    }
};
