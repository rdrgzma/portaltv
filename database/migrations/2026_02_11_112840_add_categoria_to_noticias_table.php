<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('noticias', function (Blueprint $table) {
            // Adiciona a coluna categoria após o conteúdo
            $table->string('categoria')->nullable()->after('conteudo');
        });
    }
    
    public function down(): void
    {
        Schema::table('noticias', function (Blueprint $table) {
            $table->dropColumn('categoria');
        });
    }
};
