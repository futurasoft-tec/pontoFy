<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Contrato extends Model
{
    protected $fillable = [
        'team_id',
        'colaborador_id',
        'codigo',
        'tipo_contrato',
        'data_inicio',
        'data_fim',
        'periodo_experiencia',
        'salario_base',
        'funcoes',
        'observacoes',
        'status',
        'criado_por',
    ];

    protected $casts = [
        'data_inicio'    => 'date',
        'data_fim'       => 'date',
        'salario_base'   => 'decimal:2',
    ];


    // Ordenar as Clausuadlas por ordem na tabela pivô
    public function clausulasOrdenadas()
    {
        return $this->belongsToMany(Clausula::class, 'clausula_contratos')
            ->withPivot(['ordem', 'conteudo_personalizado'])
            ->orderBy('ordem');
    }


 /**
     * Mapa dos tipos de contrato e suas siglas/categorias
     */
    public const TIPOS_CONTRATO = [
        // Contratos de Trabalho
        'trabalho_indeterminado' => 'Contrato de Trabalho por Tempo Indeterminado',
        'trabalho_determinado' => 'Contrato de Trabalho por Tempo Determinado',
        'trabalho_estagio' => 'Contrato de Trabalho de Estágio',
        'trabalho_parcial' => 'Contrato de Trabalho a Tempo Parcial',
        'trabalho_teletrabalho' => 'Contrato de Trabalho de Teletrabalho',
        'trabalho_domicilio' => 'Contrato de Trabalho a Domicílio',
        'trabalho_experiencia' => 'Contrato de Trabalho de Experiência',
        'trabalho_substituicao' => 'Contrato de Trabalho de Substituição',
        'trabalho_sazonal' => 'Contrato de Trabalho Sazonal',
        'trabalho_formacao' => 'Contrato de Trabalho de Formação Profissional',

        // Contratos de Prestação de Serviços
        'servico_prestacao' => 'Contrato de Prestação de Serviços',
        'servico_consultoria' => 'Contrato de Consultoria',
        'servico_representacao' => 'Contrato de Representação Comercial',
        'servico_mandato' => 'Contrato de Mandato',
        'servico_empreitada' => 'Contrato de Empreitada',
    ];

    public static function tipoParte($tipo)
    {
        if (str_starts_with($tipo, 'trabalho_')) {
            return ['empregador' => 'EMPREGADOR', 'trabalhador' => 'TRABALHADOR'];
        }

        return ['empregador' => 'CONTRATANTE', 'trabalhador' => 'CONTRATADO'];
    }




    /**
     * Retorna a categoria principal do contrato (trabalho ou serviço)
     */
    public function categoriaTipo()
    {
        if (str_starts_with($this->tipo_contrato, 'trabalho_')) {
            return 'trabalho';
        } elseif (str_starts_with($this->tipo_contrato, 'servico_')) {
            return 'servico';
        }

        return 'outro';
    }

    /**
     * Retorna a designação correta das partes consoante o tipo de contrato
     * Ex: “Empregador/Trabalhador” ou “Contratante/Contratado”
     */
    public function partes()
    {
        return $this->categoriaTipo() === 'trabalho'
            ? ['empregador' => 'Empregador', 'colaborador' => 'Trabalhador']
            : ['empregador' => 'Contratante', 'colaborador' => 'Contratado'];
    }





    /**
     * Booted: Geração automática do código sequencial (com padding de 10 dígitos)
     */
    protected static function booted()
    {
        static::creating(function ($contrato) {
            DB::transaction(function () use ($contrato) {
                $ano = date('Y');

                $teamName = $contrato->team->name ?? 'TEAM';
                $teamPrefix = strtoupper(Str::substr(Str::slug($teamName, ''), 0, 3));

                $ultimo = Contrato::where('team_id', $contrato->team_id)
                    ->whereYear('created_at', $ano)
                    ->lockForUpdate()
                    ->max(DB::raw("CAST(SUBSTRING_INDEX(codigo, '/', -1) AS UNSIGNED)"));

                $proximo = ($ultimo ?? 0) + 1;

                $contrato->codigo = sprintf('CTR /%s/%s/%03d', $teamPrefix, $ano, $proximo);
            });
        });
    }



    // ===================================
    // RELACIONAMENTOS
    // ===================================

    /**
     * Empresa (team)
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    /**
     * Colaborador
     */
    public function colaborador()
    {
        return $this->belongsTo(Colaboradore::class, 'colaborador_id');
    }

    /**
     * Usuário criador do contrato
     */
    public function criador()
    {
        return $this->belongsTo(User::class, 'criado_por');
    }

    /**
     * Relação com as cláusulas associadas a este contrato.
     *
     * Many-to-Many através da tabela pivô `clausula_contratos`
     * Inclui os campos personalizados da pivô (`conteudo_personalizado`, `ordem`)
     */
    public function clausulas()
    {
        return $this->belongsToMany(Clausula::class, 'clausula_contratos')
                    ->withPivot(['conteudo_personalizado', 'ordem'])
                    ->orderBy('pivot_ordem')
                    ->withTimestamps();
    }

    /**
     * Relação direta com a tabela pivô, caso precise acessar registros individuais
     */
    public function clausulaContratos()
    {
        return $this->hasMany(ClausulaContrato::class, 'contrato_id');
    }

    // ===================================
    // MÉTODOS ÚTEIS
    // ===================================

    /**
     * Retorna o texto final das cláusulas (personalizado ou padrão)
     */
    public function clausulasComTextoFinal()
    {
        return $this->clausulas->map(function ($clausula) {
            $texto = $clausula->pivot->conteudo_personalizado ?? $clausula->conteudo;
            return [
                'titulo' => $clausula->titulo,
                'texto'  => $texto,
                'ordem'  => $clausula->pivot->ordem,
            ];
        })->sortBy('ordem')->values();
    }
}
