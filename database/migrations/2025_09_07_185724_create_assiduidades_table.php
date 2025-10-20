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
        Schema::create('assiduidades', function (Blueprint $table) {
            $table->id();
            // Relacionamentos
            $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete(); // identifica a empresa/equipe
            $table->foreignId('colaborador_id')->constrained('colaboradores')->cascadeOnDelete();
            $table->foreignId('criado_por')->constrained('users')->cascadeOnDelete();

            // Dados de ponto
            $table->date('data'); 
            $table->time('hora_entrada')->nullable();
            $table->time('hora_saida')->nullable();
            $table->decimal('horas_trabalhadas', 5, 2)->nullable();
            $table->integer('atraso_minutos')->default(0);

            // Observações
            $table->text('observacoes')->nullable();

            $table->timestamps();

            // Índices para consultas rápidas
            $table->index(['colaborador_id', 'data']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assiduidades');
    }
};
