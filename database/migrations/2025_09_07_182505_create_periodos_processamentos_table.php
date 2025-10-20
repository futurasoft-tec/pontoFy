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
        Schema::create('periodos_processamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete();
            
            // mês e ano do período (gerados automaticamente)
            $table->unsignedTinyInteger('mes'); // 1 a 12
            $table->year('ano');
            
            // datas de início e fim do período
            $table->date('data_inicio');
            $table->date('data_fim');
            
            $table->enum('status', ['aberto','fechado','processado'])->default('aberto');
            $table->text('observacoes')->nullable();
            
            $table->foreignId('criado_por')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            
            // índice único para evitar duplicidade
            $table->unique(['team_id','mes','ano']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodos_processamentos');
    }
};
