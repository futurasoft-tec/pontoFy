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
        Schema::create('rubrica_colaboradors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete();
            $table->foreignId('colaborador_id')->constrained('colaboradores')->cascadeOnDelete();
            $table->foreignId('rubrica_id')->constrained('rubricas')->cascadeOnDelete();

            $table->boolean('eh_automatica')->default(true);
            $table->decimal('valor_customizado', 15, 2)->nullable();
            $table->text('formula_customizada')->nullable();
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');

            $table->timestamps();

            $table->unique(['colaborador_id', 'rubrica_id']); // evita duplicidade
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rubrica_colaboradors');
    }
};
