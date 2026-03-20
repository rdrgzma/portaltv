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
        Schema::table('pagamentos', function (Blueprint $table) {
// Adiciona a coluna após user_id
// Adiciona a coluna após user_id
            // nullable() é importante caso já existam pagamentos no banco
            $table->foreignId('anunciante_id')
                ->nullable() 
                ->after('user_id') 
                ->constrained('anunciantes') // Assume que a tabela se chama 'anunciantes'
                ->nullOnDelete(); // Se o anunciante for deletado, mantém o histórico do pagamento mas zera o ID
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagamentos', function (Blueprint $table) {
            //
        });
    }
};
