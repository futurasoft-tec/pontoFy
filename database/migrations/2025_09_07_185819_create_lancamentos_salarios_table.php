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
        Schema::create('lancamentos_salarios', function (Blueprint $table) {
             $table->id();

            // Relacionamentos
            $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete();
            $table->foreignId('folha_salario_id')->constrained('folhas_salarios')->cascadeOnDelete();
            $table->foreignId('colaborador_id')->constrained('colaboradores')->cascadeOnDelete();
            $table->foreignId('rubrica_id')->constrained('rubricas')->cascadeOnDelete();

            // Valor do lançamento
            $table->decimal('valor', 15, 2);

            // Auditoria
            $table->foreignId('criado_por')->constrained('users')->cascadeOnDelete()->nullable();

            $table->timestamps();

            // Índices para performance (opcional)
            $table->index(['folha_salario_id', 'colaborador_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lancamentos_salarios');
    }
};
