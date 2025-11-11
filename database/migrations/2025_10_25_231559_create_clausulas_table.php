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
        Schema::create('clausulas', function (Blueprint $table) {
            $table->id();

            // Relacionamento (cada empresa pode ter seu catálogo de cláusulas)
            $table->foreignId('team_id')->nullable()->constrained()->cascadeOnDelete();

            // Identificação
            $table->string('titulo', 255);
            $table->text('conteudo'); // texto padrão da cláusula
            
            // Tipo de contrato para melhor organização
            $table->enum('tipo', [
                'trabalho',
                'servico_prestacao',
                'servico_consultoria', 
                'servico_representacao',
                'servico_mandato',
                'servico_empreitada',
                'servico_agencia',
                'servico_mediacao',
                'geral' // para cláusulas comuns a vários tipos
            ])->default('trabalho');

            // Controle de versão (útil se for editar cláusulas depois)
            $table->integer('versao')->default(1);

            // Estado
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');

            // Auditoria

            $table->foreignId('criado_por')->nullable()->constrained('users')->cascadeOnDelete();

            $table->timestamps();
            
            // Índices para melhor performance
            $table->index(['team_id', 'tipo', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clausulas');
    }
};
