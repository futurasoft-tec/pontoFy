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
        Schema::create('clausula_contratos', function (Blueprint $table) {
            $table->id();
            // Relações
            $table->foreignId('contrato_id')->constrained('contratos')->cascadeOnDelete();
            $table->foreignId('clausula_id')->constrained('clausulas')->cascadeOnDelete();

            // Conteúdo personalizado (se o gestor editar o texto)
            $table->longText('conteudo_personalizado')->nullable();

            // Ordem de exibição no contrato
            $table->integer('ordem')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clausula_contratos');
    }
};
