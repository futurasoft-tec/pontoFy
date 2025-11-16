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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            
            // Relacionamento
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->foreignId('colaborador_id')->constrained('colaboradores')->cascadeOnDelete();

            // Identificação
            $table->string('codigo', 50);
            $table->unique(['team_id', 'codigo']); // unicidade por empresa

            // Dados do contrato
            $table->enum('tipo_contrato', 
            ['trabalho_indeterminado', 'trabalho_determinado', 'trabalho_estagio','trabalho_parcial',
            'trabalho_teletrabalho','trabalho_domicilio','trabalho_experiencia', 'trabalho_substituicao',
            'trabalho_sazonal', 'trabalho_formacao', 'servico_prestacao', 'servico_consultoria', 'servico_representacao',
            'servico_mandato', 'servico_empreitada']
            )->default('trabalho_indeterminado');
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
            $table->integer('periodo_experiencia')->nullable(); // dias ou meses
            $table->decimal('salario_base', 15, 2);

            // Conteúdo descritivo
            $table->text('funcoes')->nullable();
            $table->text('observacoes')->nullable();

            // Situação do contrato
            $table->enum('status', ['rascunho', 'ativo', 'terminado', 'rescindido', 'inativo'])->default('rascunho');
            
            // Assinatura do contratos
            $table->string('codigo_assinatura')->nullable();    
            $table->foreignId('assinado_por')->nullable()->constrained('users')->cascadeOnDelete();
            $table->date('data_assinatura')->nullable();
            
            // Rescisão do Contrato
            $table->date('data_rescisao')->nullable();
            $table->text('motivo_rescisao')->nullable();
            $table->foreignId('rescindido_por')->nullable()->constrained('users')->cascadeOnDelete();

            // Auditoria
            $table->foreignId('criado_por')->constrained('users')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
