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
        Schema::create('imovels', function (Blueprint $table) {
            $table->id();
                        $table->string('titulo');
            $table->string('slug')->unique();
            $table->text('descricao')->nullable();

            $table->string('tipo')->nullable(); // casa, apto, terreno
            $table->decimal('valor', 12, 2)->nullable();

            $table->integer('quartos')->nullable();
            $table->integer('banheiros')->nullable();
            $table->integer('garagem')->nullable();
            $table->integer('area')->nullable();

            $table->string('localizacao')->nullable();
            $table->string('youtube_url')->nullable();

            $table->boolean('destaque')->default(false);
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imovels');
    }
};
