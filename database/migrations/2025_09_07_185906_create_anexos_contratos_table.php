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
        Schema::create('anexos_contratos', function (Blueprint $table) {
            $table->id();
            
            // Relacionamento
            $table->foreignId('contrato_id')->constrained('contratos')->cascadeOnDelete();

            // Dados do anexo
            $table->string('nome_arquivo', 255);
            $table->string('caminho_arquivo', 255); // ex: storage/app/contratos/...
            $table->string('tipo_documento', 100)->nullable(); // Ex: contrato_assinado, aditivo, rescisao
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anexos_contratos');
    }
};
