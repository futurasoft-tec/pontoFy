<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Escala extends Model
{
    use HasFactory;

    protected $table = 'escalas';

    protected $fillable = [
        'team_id',
        'colaborador_id',
        'horario_id',
        'data_escala',
        'data_fim',
        'hora_entrada_prevista',
        'hora_saida_prevista',
        'tem_intervalo',
        'intervalo_inicio_previsto',
        'intervalo_fim_previsto',
        'tolerancia_minutos_prevista',
        'tipo_horario',
        'tipo_escala',
        'estado',
        'criado_por',
        'aprovado_por',
        'aprovado_em',
        'observacoes',
        'tags'
    ];

    protected $casts = [
        'data_escala' => 'date',
        'data_fim' => 'date',
        'hora_entrada_prevista' => 'datetime:H:i',
        'hora_saida_prevista' => 'datetime:H:i',
        'tem_intervalo' => 'boolean',
        'intervalo_inicio_previsto' => 'datetime:H:i',
        'intervalo_fim_previsto' => 'datetime:H:i',
        'tolerancia_minutos_prevista' => 'integer',
        'tipo_horario' => 'string',
        'tipo_escala' => 'string',
        'estado' => 'string',
        'tags' => 'array',
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

    public function colaborador()
    {
        return $this->belongsTo(Colaboradore::class, 'colaborador_id');
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class, 'horario_id');
    }

    public function assiduidades()
    {
        return $this->hasMany(Assiduidade::class, 'escala_id');
    }

    /*
    |--------------------------------------------------------------------------
    | MÉTODOS AUXILIARES
    |--------------------------------------------------------------------------
    */

    // Calcula a jornada total prevista em horas
    public function jornadaPrevista(): float
    {
        if (!$this->hora_entrada_prevista || !$this->hora_saida_prevista) return 0;

        $entrada = Carbon::parse($this->hora_entrada_prevista);
        $saida = Carbon::parse($this->hora_saida_prevista);

        $total = $entrada->diffInMinutes($saida);

        if ($this->tem_intervalo && $this->intervalo_inicio_previsto && $this->intervalo_fim_previsto) {
            $inicio = Carbon::parse($this->intervalo_inicio_previsto);
            $fim = Carbon::parse($this->intervalo_fim_previsto);
            $total -= $inicio->diffInMinutes($fim);
        }

        return round($total / 60, 2);
    }

    // Calcula atraso em minutos baseado no horário previsto + tolerância
    public function calcularAtrasoMinutos($horaEntradaReal): int
    {
        if (!$horaEntradaReal || !$this->hora_entrada_prevista) return 0;

        $previsto = Carbon::parse($this->hora_entrada_prevista)->addMinutes($this->tolerancia_minutos_prevista);
        $real = Carbon::parse($horaEntradaReal);

        return $real->greaterThan($previsto)
            ? $previsto->diffInMinutes($real)
            : 0;
    }

    // Calcula minutos de intervalo previsto
    public function duracaoIntervaloPrevisto(): int
    {
        if (!$this->tem_intervalo || !$this->intervalo_inicio_previsto || !$this->intervalo_fim_previsto) return 0;

        $inicio = Carbon::parse($this->intervalo_inicio_previsto);
        $fim = Carbon::parse($this->intervalo_fim_previsto);

        return $inicio->diffInMinutes($fim);
    }
}
