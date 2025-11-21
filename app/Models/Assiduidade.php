<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assiduidade extends Model
{
    use HasFactory;

    protected $table = 'assiduidades';

    protected $fillable = [
        'team_id',
        'colaborador_id',
        'criado_por',
        'periodo_id',
        'escala_id',
        'data',
        'hora_entrada_real',
        'hora_saida_real',
        'hora_inicio_almoco_real',
        'hora_fim_almoco_real',
        'horas_trabalhadas',
        'horas_extras',
        'horas_faltantes',
        'atraso_minutos',
        'horas_noturnas',
        'percentual_he',
        'status',
        'tipo_ausencia',
        'falta_justificada',
        'motivo_falta',
        'anexo_falta',
        'falta_justificada_por',
        'falta_justificada_em',
        'dias_desconto',
        'valor_desconto',
        'desconto_aplicado',
        'data_inicio_ausencia',
        'data_fim_ausencia',
        'dias_ausencia',
        'fonte_registro',
        'calculado_folha',
        'processado_em',
        'processado_por',
        'status_aprovacao',
        'aprovado_por',
        'aprovado_em',
        'observacao_aprovacao',
        'hash_calculo',
        'detalhes_calculo',
        'ajustado_manual',
        'ajustado_por',
        'observacoes',
    ];

    protected $casts = [
        'data' => 'date',
        'hora_entrada_real' => 'datetime:H:i',
        'hora_saida_real' => 'datetime:H:i',
        'hora_inicio_almoco_real' => 'datetime:H:i',
        'hora_fim_almoco_real' => 'datetime:H:i',
        'horas_trabalhadas' => 'decimal:2',
        'horas_extras' => 'decimal:2',
        'horas_faltantes' => 'decimal:2',
        'atraso_minutos' => 'integer',
        'horas_noturnas' => 'integer',
        'percentual_he' => 'decimal:2',
        'dias_desconto' => 'integer',
        'valor_desconto' => 'decimal:2',
        'dias_ausencia' => 'integer',
        'calculado_folha' => 'boolean',
        'desconto_aplicado' => 'boolean',
        'ajustado_manual' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTOS
    |--------------------------------------------------------------------------
    */

    public function colaborador()
    {
        return $this->belongsTo(Colaboradore::class, 'colaborador_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function criadoPor()
    {
        return $this->belongsTo(User::class, 'criado_por');
    }

    public function periodo()
    {
        return $this->belongsTo(PeriodosProcessamento::class, 'periodo_id');
    }

    public function escala()
    {
        return $this->belongsTo(Escala::class, 'escala_id');
    }

    public function processadoPor()
    {
        return $this->belongsTo(User::class, 'processado_por');
    }

    public function aprovadoPor()
    {
        return $this->belongsTo(User::class, 'aprovado_por');
    }

    public function ajustadoPor()
    {
        return $this->belongsTo(User::class, 'ajustado_por');
    }

    public function faltaJustificadaPor()
    {
        return $this->belongsTo(User::class, 'falta_justificada_por');
    }

    /*
    |--------------------------------------------------------------------------
    | MÉTODOS DE CÁLCULO
    |--------------------------------------------------------------------------
    */
    // Calcula as horas trabalhadas descontando o intervalo de almoço
    public function calcularHorasTrabalhadas(): float
    {
        if (!$this->hora_entrada_real || !$this->hora_saida_real) return 0;

        $entrada = Carbon::parse($this->hora_entrada_real);
        $saida = Carbon::parse($this->hora_saida_real);

        $total = $entrada->diffInMinutes($saida);

        if ($this->hora_inicio_almoco_real && $this->hora_fim_almoco_real) {
            $inicioAlmoco = Carbon::parse($this->hora_inicio_almoco_real);
            $fimAlmoco = Carbon::parse($this->hora_fim_almoco_real);
            $total -= $inicioAlmoco->diffInMinutes($fimAlmoco);
        }

        return round($total / 60, 2);
    }

    // Calcula o atraso em minutos com base na hora de entrada prevista na escala
    public function calcularAtrasoMinutos(): int
    {
        if (!$this->hora_entrada_real || !$this->escala) return 0;

        $entradaPrevista = Carbon::parse($this->escala->hora_entrada_prevista ?? '08:00');
        $entradaReal = Carbon::parse($this->hora_entrada_real);

        return $entradaReal->greaterThan($entradaPrevista)
            ? $entradaPrevista->diffInMinutes($entradaReal)
            : 0;
    }

    // Calcula as horas extras com base na jornada padrão (8 horas por dia)
    public function calcularHorasExtras(float $jornadaPadrao = 8.0): float
    {
        if (!$this->horas_trabalhadas) return 0;

        return $this->horas_trabalhadas > $jornadaPadrao
            ? round($this->horas_trabalhadas - $jornadaPadrao, 2)
            : 0;
    }

    // Calcula as horas faltantes com base na jornada padrão (8 horas por dia)
    public function calcularHorasFaltantes(float $jornadaPadrao = 8.0): float
    {
        if (!$this->horas_trabalhadas) return $jornadaPadrao;

        return $this->horas_trabalhadas < $jornadaPadrao
            ? round($jornadaPadrao - $this->horas_trabalhadas, 2)
            : 0;
    }

    /*
    |--------------------------------------------------------------------------
    | EVENTOS AUTOMÁTICOS
    |--------------------------------------------------------------------------
    */

    // Antes de salvar o registro, calcular os campos derivados
    protected static function boot()
    {
        parent::boot();

        static::saving(function (Assiduidade $ass) {
            $ass->horas_trabalhadas = $ass->calcularHorasTrabalhadas();
            $ass->atraso_minutos = $ass->calcularAtrasoMinutos();
            $ass->horas_extras = $ass->calcularHorasExtras();
            $ass->horas_faltantes = $ass->calcularHorasFaltantes();
        });
    }
}
