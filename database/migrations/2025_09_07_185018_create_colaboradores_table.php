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
            $table->string('codigo', 10)->unique()->notNullable();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('departamento_id')->nullable()->constrained('departamentos')->nullOnDelete();
            $table->foreignId('cargo_id')->nullable()->constrained('cargos')->nullOnDelete();

            // Dados pessoais
            $table->string('nome_completo', 255);
            $table->date('data_nascimento');
            $table->enum('genero', ['M','F','Outro']);
            $table->string('estado_civil', 50);
            $table->string('nacionalidade', 100);

            // Documentos
            $table->string('tipo_documento', 50)->required();
            $table->string('numero_doc_id', 50)->required();
            $table->date('data_emissao_doc')->nullable();
            $table->date('data_validade_doc')->nullable();
            $table->string('nif', 50)->nullable();
            $table->string('numero_inss', 50)->nullable();

            // Contactos
            $table->text('pais', 100);
            $table->text('provincia')->nullable();
            $table->text('cidade_estrangeira', 255)->nullable();
            $table->text('endereco', 255)->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('foto_url', 255)->nullable();

            // Situação laboral
            $table->date('data_admissao');
            $table->date('data_demissao')->nullable();
            $table->enum('status', ['ativo','inativo'])->default('ativo');

            // Auditoria
            $table->foreignId('criado_por')->constrained('users')->cascadeOnDelete();

            // Campos do tipo unique por team
            $table->unique(['team_id', 'numero_doc_id']);
            $table->unique(['team_id', 'nif']);
            $table->unique(['team_id', 'numero_inss']);
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
