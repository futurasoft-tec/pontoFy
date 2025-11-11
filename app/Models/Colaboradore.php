<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Colaboradore extends Model
{
    protected $fillable = [
        'codigo', // Codigo unico de identificaco do Colaborador no sistema
        'team_id',
        'user_id',
        'departamento_id',
        'cargo_id',
        'nome_completo',
        'data_nascimento',
        'genero',
        'estado_civil',
        'nacionalidade',
        'tipo_documento',
        'numero_doc_id',
        'data_emissao_doc',
        'data_validade_doc',
        'nif',
        'numero_inss',
        'pais',
        'provincia',
        'cidade_estrangeira',
        'endereco',
        'telefone',
        'email',
        'foto_url',
        'data_admissao',
        'data_demissao',
        'status',
        'criado_por',
    ];

    protected $casts = [
        'data_emissao_doc'      => 'date',
        'data_validade_doc'     => 'date',
        'data_admissao'         => 'date',
        'data_demissao'         =>'date',
    ];


   
    /**
     * Booted: Geração automática do código sequencial (com padding de 10 dígitos)
     */
    protected static function booted()
    {
        static::creating(function ($colaborador) {
            DB::transaction(function () use ($colaborador) {
                $ano = date('y');

                // $teamName = $colaborador->team->name ?? 'TEAM';
                // $teamPrefix = strtoupper(Str::substr(Str::slug($teamName, ''), 0, 3));

                $ultimo = Contrato::where('team_id', $colaborador->team_id)
                    ->whereYear('created_at', $ano)
                    ->lockForUpdate()
                    ->max(DB::raw("CAST(SUBSTRING_INDEX(codigo, '/', -1) AS UNSIGNED)"));

                $proximo = ($ultimo ?? 0) + 1;

                $colaborador->codigo = sprintf('CIC-%s-%03d', $ano, $proximo);
            });
        });
    }


        // =======RELACIONAMENTOS DE TABELAS=======

        // Pegar usuario que criou o departamento
        public function departamento()
        {
            return $this->belongsTo(Departamento::class, 'departamento_id');
        }

        // Pegar usuario que criou o departamento
        public function cargo()
        {
           return $this->belongsTo(Cargo::class, 'cargo_id');
        }


        // Relacao com Team autenticado
        public function team(){
            return $this->belongsTo(Team::class, 'team_id');;
        }

        // Relacao com o user criador
        public function user(){
            return $his->belongsTo(User::class);
        }


        // Relacao com o user criador
        public function criador(){
            return $his->belongsTo(User::class);
        }

        public function documentos()
        {
            return $this->hasMany(Documento::class, 'colaborador_id');
        }

        public function contratos()
        {
            return $this->hasMany(Contrato::class, 'colaborador_id');
        }

        public function lancamentosSalarios()
        {
            return $this->hasMany(LancamentosSalario::class, 'colaborador_id');
        }

        public function recibos()
        {
            return $this->hasMany(Recibo::class, 'colaborador_id');
        }

        public function insses()
        {
            return $this->hasMany(Inss::class, 'colaborador_id');
        }

        public function irps()
        {
            return $this->hasMany(Irps::class, 'colaborador_id');
        }

        public function dependentes()
        {
            return $this->hasMany(Dependente::class, 'colaborador_id');
        }


        // Rubricas
       public function rubricas()
        {
            return $this->belongsToMany(
                \App\Models\Rubrica::class,
                'rubrica_colaboradors',   // tabela pivot
                'colaborador_id',         // chave na pivot referente a colaborador
                'rubrica_id'              // chave na pivot referente a rubrica
            )
            ->withPivot('id', 'team_id', 'eh_automatica', 'valor_customizado', 'formula_customizada')
            ->withTimestamps();
        }



}
