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
        Schema::create('niveis_hierarquicos', function (Blueprint $table) {
            $table->id();
            // Ligação à empresa (multi-tenant)
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            // Nome do nível (ex: Direção, Gerência, Operacional)
            $table->string('nome', 150);
            // Código ou sigla opcional (ex: N1, N2, etc.)
            $table->string('codigo', 50)->nullable();
            // Descrição opcional do nível
            $table->text('descricao')->nullable();
            // Prioridade / ordem hierárquica (1 = topo, 10 = base)
            $table->integer('prioridade')->default(1);
            // Usuário que criou o registro
            $table->foreignId('criado_por')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niveis_hierarquicos');
    }
};
