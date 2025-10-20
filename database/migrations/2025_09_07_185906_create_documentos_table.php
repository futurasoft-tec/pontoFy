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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();

            // Relacionamento com colaborador
            $table->foreignId('colaborador_id')
                ->constrained('colaboradores')
                ->cascadeOnDelete();

            // Informações do documento
            $table->string('tipo_documento', 100);     // Ex: BI, Passaporte, Diploma
            $table->string('nome_arquivo', 255);       // Nome original ou amigável
            $table->string('caminho_arquivo', 255);    // Ex: storage/app/documentos/...
            $table->text('observacoes')->nullable();   // Observações opcionais

            // Auditoria
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
