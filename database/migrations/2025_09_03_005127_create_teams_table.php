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
        Schema::create('teams', function (Blueprint $table) {
        $table->id();

        // Relacionamento com o dono (padrão do Jetstream)
        $table->foreignId('user_id')->index();

        // Nome da empresa
        $table->string('name'); // pode ser razão social ou nome fantasia
        $table->boolean('personal_team');

        // --- Identificação e Fiscal ---
        $table->string('logotipo')->nullable();
        $table->string('actividade_economica')->nullable();
        $table->string('nif')->unique()->nullable();
        $table->string('inss_antigo')->nullable();
        $table->string('inss_novo')->nullable();
        $table->string('regime_iva')->nullable(); // Geral, Isento, Simplificado
        $table->string('licenca_comercial')->nullable();

        // --- Localização ---
        $table->string('pais')->default('Angola');
        $table->string('provincia')->nullable();
        $table->string('municipio')->nullable();
        $table->string('cidade')->nullable();
        $table->string('bairro')->nullable();
        $table->string('endereco')->nullable();

        // --- Contactos ---
        $table->string('email')->nullable();
        $table->string('telefone')->nullable();
        $table->string('fax')->nullable();
        $table->string('website')->nullable();

        // --- Gestão ---
        $table->enum('status', ['activo', 'inactivo', 'suspenso'])->default('activo');

        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
