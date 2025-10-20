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
        Schema::create('categorias', function (Blueprint $table) {
           $table->id();

            // Relacionamentos principais
            $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete(); // Empresa
            $table->foreignId('departamento_id')->constrained('departamentos')->cascadeOnDelete(); // Departamento
            $table->foreignId('cargo_id')->constrained('cargos')->cascadeOnDelete(); // Cargo
           

            // Dados da categoria
            $table->string('nome', 150); 
            $table->string('funcao', 150);
            $table->text('descricao')->nullable();

            // Estado
            $table->enum('estado', ['ativo','inativo'])->default('ativo');

            // Auditoria
             $table->foreignId('criado_por') ->constrained('users')->cascadeOnDelete(); // Usuário criador
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
