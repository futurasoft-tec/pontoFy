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
        Schema::create('insses', function (Blueprint $table) {
            $table->id();

            // Relacionamentos
            $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete();
            $table->foreignId('colaborador_id')->constrained('colaboradores')->cascadeOnDelete();
            $table->foreignId('periodo_id')->constrained('periodos_processamentos')->cascadeOnDelete(); // referência ao período

            // Valores
            $table->decimal('valor_empresa', 15, 2);
            $table->decimal('valor_colaborador', 15, 2);
            $table->decimal('valor_total', 15, 2);

            // Status e pagamento
            $table->enum('status', ['pendente', 'pago'])->default('pendente');
            $table->timestamp('data_pagamento')->nullable();

            // Auditoria
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insses');
    }
};
