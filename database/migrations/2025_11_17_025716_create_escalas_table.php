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
        Schema::create('escalas', function (Blueprint $table) {
            $table->id();

            // Multiempresa
            $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete();

            // Colaborador
            $table->foreignId('colaborador_id')->constrained('colaboradores')->cascadeOnDelete();

            // Horário base
            $table->foreignId('horario_id')->constrained('horarios')->cascadeOnDelete();

            // Datas da escala
            $table->date('data_escala');            // Data específica do turno
            $table->date('data_fim')->nullable();   // Para turnos longos (ex: 24h+)

            // Snapshot do horário (preserva histórico)
            $table->time('hora_entrada_prevista');
            $table->time('hora_saida_prevista');
            $table->boolean('tem_intervalo')->default(false);
            $table->time('intervalo_inicio_previsto')->nullable();
            $table->time('intervalo_fim_previsto')->nullable();
            $table->integer('tolerancia_minutos_prevista')->default(0);
            $table->enum('tipo_horario', ['normal', 'flexivel', 'reduzido', 'noturno', 'feriado'])->default('normal');

            // Tipo de escala
            $table->enum('tipo_escala', [
                'normal', 
                'extra', 
                'troca', 
                'reforco', 
                'feriado', 
                'folga',
                'especial'
            ])->default('normal');

            // Estado da escala
            $table->enum('estado', [
                'pendente', 
                'aprovada', 
                'cancelada',
                'substituicao'
            ])->default('aprovada');

            // Auditoria
            $table->foreignId('criado_por')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('aprovado_por')->nullable()->constrained('users')->cascadeOnDelete();
            $table->timestamp('aprovado_em')->nullable();

            // Observações e tags
            $table->text('observacoes')->nullable();
            $table->json('tags')->nullable(); // ex: ["urgente", "especial", "projeto_x"]

            // Datas do sistema
            $table->timestamps();

            // Índices e unicidade
            $table->unique(['colaborador_id', 'data_escala']); // Um colaborador por dia
            $table->index(['team_id', 'data_escala']);
            $table->index(['colaborador_id', 'estado']);
            $table->index(['horario_id', 'data_escala']);
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escalas');
    }
};
