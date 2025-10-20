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
        Schema::create('departamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete(); // empresa
            $table->string('nome', 150);
            $table->text('descricao')->nullable();
            $table->enum('status', ['ativo','inativo'])->default('ativo');
            $table->foreignId('criado_por')->constrained('users')->cascadeOnDelete(); // usuário que criou
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departamentos');
    }
};
