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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete();
            $table->foreignId('criado_por')->nullable()->constrained('users')->cascadeOnDelete();

            // Informações básicas
            $table->string('nome');
            $table->time('hora_entrada');
            $table->time('hora_saida');
            $table->integer('tolerancia_minutos')->default(0);

            // Intervalo
            $table->boolean('intervalo')->default(false);
            $table->time('intervalo_inicio')->nullable();
            $table->time('intervalo_fim')->nullable();

            // Tipo de Horário
            $table->enum('tipo', ['normal', 'flexivel', 'reduzido', 'noturno', 'feriado'])->default('normal');

            // Controle temporal / validade
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();
            $table->boolean('ativo')->default(true);

            // Flags úteis
            $table->boolean('horario_noturno')->default(false);

            // Metadados
            $table->text('observacoes')->nullable();

            $table->timestamps();

            $table->index(['team_id', 'ativo']);
            $table->index(['data_inicio', 'data_fim']);
            $table->index('tipo');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
