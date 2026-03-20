<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('regional_news_items', function (Blueprint $table) {
            $table->id();
            $table->string('rss_id')->unique();          // md5(link) — identificador do item RSS
            $table->string('state', 5);                   // ex: rs, sp, br
            $table->string('state_name');                 // ex: Rio Grande do Sul
            $table->string('title');
            $table->string('link');                       // URL da notícia original
            $table->text('description')->nullable();
            $table->longText('full_content')->nullable();
            $table->string('image')->nullable();          // URL da imagem
            $table->string('source')->nullable();         // Nome da fonte (G1 RS etc.)
            $table->string('author')->nullable();
            $table->timestamp('published_at')->nullable();

            $table->boolean('destaque')->default(false);  // Destacar no site público
            $table->boolean('publicado')->default(false); // Publicar no site público

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regional_news_items');
    }
};
