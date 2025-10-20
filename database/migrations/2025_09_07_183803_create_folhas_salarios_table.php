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
        Schema::create('folhas_salarios', function (Blueprint $table) {
            $table->id();

            // Relacionamentos
            $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete();
            $table->foreignId('periodo_id')->constrained('periodos_processamentos')->cascadeOnDelete(); // referência ao período
            $table->foreignId('criado_por')->constrained('users')->cascadeOnDelete();

            // Status da folha
            $table->enum('status', ['rascunho','processado','pago'])->default('rascunho');

            // Totais
            $table->decimal('total_vencimentos', 15, 2)->default(0);
            $table->decimal('total_descontos', 15, 2)->default(0);
            $table->decimal('total_liquido', 15, 2)->default(0);

            // Datas de processamento/pagamento
            $table->timestamp('data_processamento')->nullable();
            $table->timestamp('data_pagamento')->nullable();

            // Observações
            $table->text('observacoes')->nullable();

            // Auditoria
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folhas_salarios');
    }
};
