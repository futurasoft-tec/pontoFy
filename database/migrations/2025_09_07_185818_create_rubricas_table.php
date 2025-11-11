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
        Schema::create('rubricas', function (Blueprint $table) {
           $table->id();
            // Relacionamento com empresa
            $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete();

            $table->string('codigo', 50);
            $table->string('nome', 150);
            $table->text('descricao')->nullable();
            $table->enum('tipo', ['vencimento', 'desconto']);
            $table->enum('base_calculo', ['fixo', 'percentual', 'formula'])->default('fixo');
            $table->decimal('valor', 15, 2)->nullable();
            $table->text('formula')->nullable();
            $table->boolean('is_tributavel')->default(true);
            $table->string('slug_sistema', 50)->nullable()->index();
            $table->timestamps();

            // Chave única por team_id + codigo
            $table->unique(['team_id', 'codigo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rubricas');
    }
};
