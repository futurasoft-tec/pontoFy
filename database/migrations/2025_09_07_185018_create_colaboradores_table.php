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
        Schema::create('colaboradores', function (Blueprint $table) {
            $table->id();
            // Relacionamentos
            $table->foreignId('team_id')->constrained()->cascadeOnDelete(); // empresa
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('departamento_id')->nullable()->constrained('departamentos')->nullOnDelete();
            $table->foreignId('cargo_id')->nullable()->constrained('cargos')->nullOnDelete();

            // Dados pessoais
            $table->string('nome_completo', 255);
            $table->date('data_nascimento')->nullable();
            $table->enum('genero', ['M','F','Outro'])->nullable();
            $table->string('estado_civil', 50)->nullable();
            $table->string('nacionalidade', 100)->nullable();

            // Documentos
            $table->string('nif', 50)->nullable();
            $table->string('numero_bi', 50)->nullable();
            $table->date('data_emissao_bi')->nullable();
            $table->date('data_validade_bi')->nullable();

            // Contactos
            $table->text('endereco')->nullable();
            $table->string('telefone', 50)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('foto_url', 255)->nullable();

            // Situação laboral
            $table->date('data_admissao');
            $table->date('data_demissao')->nullable();
            $table->enum('status', ['ativo','inativo'])->default('ativo');

            // Auditoria
            $table->foreignId('criado_por')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colaboradores');
    }
};
