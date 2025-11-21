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
       Schema::create('assiduidades', function (Blueprint $table) {
            $table->id();

            // Relacionamentos
            $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete();
            $table->foreignId('colaborador_id')->constrained('colaboradores')->cascadeOnDelete();
            $table->foreignId('criado_por')->constrained('users')->cascadeOnDelete();
            $table->foreignId('periodo_id')->nullable()->constrained('periodos_processamentos')->cascadeOnDelete();
            $table->foreignId('escala_id')->nullable()->constrained('escalas')->cascadeOnDelete();

            // Dados do ponto (REAL vs PREVISTO)
            $table->date('data'); 
            
            // REGISTROS REAIS
            $table->time('hora_entrada_real')->nullable();
            $table->time('hora_saida_real')->nullable();
            $table->time('hora_inicio_almoco_real')->nullable();
            $table->time('hora_fim_almoco_real')->nullable();
            
            // CÁLCULOS AUTOMÁTICOS
            $table->decimal('horas_trabalhadas', 5, 2)->nullable();
            $table->decimal('horas_extras', 5, 2)->default(0);
            $table->decimal('horas_faltantes', 5, 2)->default(0);
            $table->integer('atraso_minutos')->default(0);
            $table->integer('horas_noturnas')->default(0);
            $table->decimal('percentual_he', 5, 2)->default(0); // 50%, 100% etc

            // =========================================================================
            // SEÇÃO UNIFICADA DE FALTAS E AUSÊNCIAS
            // =========================================================================
            
            // STATUS DETALHADO DO DIA
            $table->enum('status', [
                'presente',              // Trabalhou normalmente
                'falta_nao_justificada', // Falta sem justificativa
                'falta_justificada',     // Falta com justificativa aprovada
                'feriado',               // Dia de feriado
                'licenca',               // Licença médica/ maternidade etc
                'home_office',           // Trabalho remoto
                'atestado',              // Atestado médico
                'viagem',                // Viagem a serviço
                'suspensao',             // Suspensão disciplinar
                'folga',                 // Folga programada
                'compensacao',           // Compensação de horas
                'afastamento'            // Afastamento temporário
            ])->default('presente');

            // TIPO ESPECÍFICO DE FALTA/AUSÊNCIA
            $table->enum('tipo_ausencia', [
                'nenhuma',
                'doenca',
                'acidente_trabalho',
                'maternidade',
                'paternidade',
                'luto',
                'casamento',
                'doenca_familiar',
                'estudos',
                'exames_medicos',
                'outros'
            ])->default('nenhuma');

            // CONTROLE DE JUSTIFICATIVA DE FALTA
            $table->boolean('falta_justificada')->default(false);
            $table->text('motivo_falta')->nullable();
            $table->string('anexo_falta')->nullable(); // declaração médica, atestado, etc
            $table->foreignId('falta_justificada_por')->nullable()->constrained('users')->cascadeOnDelete();
            $table->timestamp('falta_justificada_em')->nullable();
            
            // DIAS DE DESCONTO/ABONO
            $table->integer('dias_desconto')->default(1);
            $table->decimal('valor_desconto', 10, 2)->nullable();
            $table->boolean('desconto_aplicado')->default(false);
            
            // PERÍODO DE AUSÊNCIA (para faltas prolongadas)
            $table->date('data_inicio_ausencia')->nullable();
            $table->date('data_fim_ausencia')->nullable();
            $table->integer('dias_ausencia')->default(1);

            // =========================================================================
            // FIM DA SEÇÃO DE FALTAS
            // =========================================================================

            // TIPO DE REGISTRO
            $table->enum('fonte_registro', [
                'ponto_eletronico',
                'ajuste_manual', 
                'importacao',
                'sistema_externo',
                'justificativa_falta' // Nova fonte
            ])->default('ponto_eletronico');

            // FLAGS IMPORTANTES
            $table->boolean('calculado_folha')->default(false);
            $table->timestamp('processado_em')->nullable();
            $table->foreignId('processado_por')->nullable()->constrained('users')->cascadeOnDelete();

            // CONTROLE DE APROVAÇÃO
            $table->enum('status_aprovacao', [
                'pendente',
                'aprovado',
                'rejeitado',
                'ajuste_solicitado'
            ])->default('pendente');
            
            $table->foreignId('aprovado_por')->nullable()->constrained('users')->cascadeOnDelete();
            $table->timestamp('aprovado_em')->nullable();
            $table->text('observacao_aprovacao')->nullable();

            // AUDITORIA E RASTREABILIDADE
            $table->string('hash_calculo')->nullable(); // Para auditoria de cálculos
            $table->json('detalhes_calculo')->nullable(); // Backup dos cálculos realizados
            $table->boolean('ajustado_manual')->default(false);
            $table->foreignId('ajustado_por')->nullable()->constrained('users')->cascadeOnDelete();

            // Observações gerais
            $table->text('observacoes')->nullable();

            $table->timestamps();

            // =========================================================================
            // ÍNDICES OTIMIZADOS
            // =========================================================================
            
            // Índice único - um registro por colaborador por dia
            $table->unique(['colaborador_id', 'data']);
            
            // Índices para consultas de relatórios
            $table->index(['colaborador_id', 'status', 'data']);
            $table->index(['team_id', 'data', 'calculado_folha']);
            $table->index(['escala_id', 'status']);
            $table->index(['periodo_id', 'calculado_folha']);
            
            // Novos índices para faltas e ausências
            $table->index(['status', 'falta_justificada']);
            $table->index(['colaborador_id', 'data_inicio_ausencia', 'data_fim_ausencia']);
            $table->index(['status_aprovacao', 'data']);
            $table->index(['tipo_ausencia', 'data']);
            
            // Índices para performance em cálculos de folha
            $table->index(['calculado_folha', 'team_id']);
            $table->index(['desconto_aplicado', 'data']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assiduidades');
    }
};
