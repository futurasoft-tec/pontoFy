<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clausula extends Model
{
    protected $fillable = [
        'team_id',
        'titulo',
        'conteudo',
        'versao',
        'status',
        'criado_por',
    ];

    /**
     * Relações
     */

    // Empresa (caso seja cláusula personalizada)
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    // Usuário que criou a cláusula
    public function criador()
    {
        return $this->belongsTo(User::class, 'criado_por');
    }

    // Relação Many-to-Many com contratos (através da tabela pivô)
    public function contratos()
    {
        return $this->belongsToMany(Contrato::class, 'clausula_contratos')
                    ->withPivot(['conteudo_personalizado', 'ordem'])
                    ->orderBy('pivot_ordem')
                    ->withTimestamps();
    }

    // Relação direta com a tabela pivô (caso precise manipular individualmente)
    public function clausulaContratos()
    {
        return $this->hasMany(ClausulaContrato::class, 'clausula_id');
    }

    /**
     * Scopes úteis
     */

    // Cláusulas globais do sistema (team_id = null)
    public function scopeGlobais($query)
    {
        return $query->whereNull('team_id');
    }

    // Cláusulas específicas de uma empresa
    public function scopePorEmpresa($query, $teamId)
    {
        return $query->where('team_id', $teamId);
    }

    // Cláusulas ativas
    public function scopeAtivas($query)
    {
        return $query->where('status', 'ativo');
    }

    /**
     * Métodos auxiliares
     */

    // Retorna o nome da origem (Global ou nome da empresa)
    public function getOrigemAttribute()
    {
        return $this->team_id
            ? optional($this->team)->name
            : 'Global (Sistema)';
    }
}
