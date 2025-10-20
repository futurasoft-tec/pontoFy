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
        Schema::create('eventos_rhs', function (Blueprint $table) {
            $table->id();

            // Relacionamentos
            $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete();
            $table->foreignId('colaborador_id')->constrained('colaboradores')->cascadeOnDelete();
            $table->foreignId('aprovado_por')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('criado_por')->constrained('users')->cascadeOnDelete();

            // Dados do evento
            $table->enum('tipo', ['ferias','ausencia','licenca','outro']);
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->enum('status', ['pendente','aprovado','rejeitado'])->default('pendente');
            $table->text('justificativa')->nullable();
            $table->string('documento_url', 255)->nullable();
            $table->timestamp('data_aprovacao')->nullable();

            $table->timestamps();

            // Índices para performance
            $table->index(['colaborador_id', 'data_inicio', 'data_fim']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos_rhs');
    }
};
