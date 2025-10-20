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
        Schema::create('irps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete();
            $table->foreignId('colaborador_id')->constrained('colaboradores')->cascadeOnDelete();
            $table->foreignId('periodo_id')->constrained('periodos_processamentos')->cascadeOnDelete(); // referência ao período
            
            $table->enum('categoria', ['A','B','C','D','E']); // tipo de rendimento
            $table->decimal('valor_bruto', 15, 2);
            $table->decimal('deducoes', 15, 2)->default(0);
            $table->decimal('valor_retencao', 15, 2);
            $table->enum('status', ['pendente','pago'])->default('pendente');
            $table->timestamp('data_pagamento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irps');
    }
};
