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
        Schema::create('recibos', function (Blueprint $table) {
            $table->id();
            // Relacionamentos
            $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete();
            $table->foreignId('folha_salarial_id')->constrained('folhas_salarios')->cascadeOnDelete();
            $table->foreignId('colaborador_id')->constrained('colaboradores')->cascadeOnDelete();
           
            
            // Identificação
            $table->string('codigo_recibo', 100)->unique();
            
            // Arquivos e validação
            $table->string('caminho_arquivo', 255);
            $table->string('hash_validacao', 255);
            $table->string('assinatura_digital', 255)->nullable();
            
            // Fluxo / auditoria
            $table->enum('status', ['rascunho','emitido','enviado'])->default('rascunho');
            $table->text('observacoes')->nullable();
            
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recibos');
    }
};
