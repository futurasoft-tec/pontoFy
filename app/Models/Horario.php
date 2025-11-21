<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';

    protected $fillable = [
        'team_id',
        'criado_por',
        'nome',
        'hora_entrada',
        'hora_saida',
        'tolerancia_minutos',
        'intervalo',
        'intervalo_inicio',
        'intervalo_fim',
        'tipo',
        'horario_noturno',
        'data_inicio',
        'data_fim',
        'ativo',
        'observacoes',
    ];

    protected $casts = [
        'hora_entrada' => 'datetime:H:i',
        'hora_saida' => 'datetime:H:i',
        'intervalo' => 'boolean',
        'intervalo_inicio' => 'datetime:H:i',
        'intervalo_fim' => 'datetime:H:i',
        'tolerancia_minutos' => 'integer',
        'horario_noturno' => 'boolean',
        'data_inicio' => 'date',
        'data_fim' => 'date',
        'ativo' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTOS
    |--------------------------------------------------------------------------
    */

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function escalas()
    {
        return $this->hasMany(Escala::class, 'horario_id');
    }

    public function assiduidades()
    {
        // Relacionamento através das escalas
        return $this->hasManyThrough(
            Assiduidade::class,
            Escala::class,
            'horario_id',    // FK na tabela Escala
            'escala_id',     // FK na tabela Assiduidade
            'id',            // PK do Horario
            'id'             // PK da Escala
        );
    }

    /*
    |--------------------------------------------------------------------------
    | MÉTODOS AUXILIARES DE HORÁRIO
    |--------------------------------------------------------------------------
    */

    // Calcula a jornada total do horário (em horas)
    public function jornadaTotal(): float
    {
        $entrada = Carbon::parse($this->hora_entrada);
        $saida = Carbon::parse($this->hora_saida);

        $total = $entrada->diffInMinutes($saida);

        if ($this->intervalo && $this->intervalo_inicio && $this->intervalo_fim) {
            $inicio = Carbon::parse($this->intervalo_inicio);
            $fim = Carbon::parse($this->intervalo_fim);
            $total -= $inicio->diffInMinutes($fim);
        }

        return round($total / 60, 2);
    }

    // Verifica se um horário é noturno
    public function isNoturno(): bool
    {
        return $this->horario_noturno;
    }

    // Calcula atraso de uma hora de entrada real comparando com a prevista + tolerância
    public function calcularAtrasoMinutos($horaEntradaReal): int
    {
        if (!$horaEntradaReal) return 0;

        $previsto = Carbon::parse($this->hora_entrada)->addMinutes($this->tolerancia_minutos);
        $real = Carbon::parse($horaEntradaReal);

        return $real->greaterThan($previsto)
            ? $previsto->diffInMinutes($real)
            : 0;
    }

    // Calcula minutos de intervalo, útil para folha
    public function duracaoIntervalo(): int
    {
        if (!$this->intervalo || !$this->intervalo_inicio || !$this->intervalo_fim) return 0;

        $inicio = Carbon::parse($this->intervalo_inicio);
        $fim = Carbon::parse($this->intervalo_fim);

        return $inicio->diffInMinutes($fim);
    }
}
