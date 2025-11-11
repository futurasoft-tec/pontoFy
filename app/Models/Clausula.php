<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clausula extends Model
{
    protected $fillable = [
        'team_id',
        'titulo',
        'tipo',
        'conteudo',
        'versao',
        'status',
        'criado_por',
    ];

    /**
     * Relações
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function criador()
    {
        return $this->belongsTo(User::class, 'criado_por');
    }

    public function contratos()
    {
        return $this->belongsToMany(Contrato::class, 'clausula_contratos')
                    ->withPivot(['conteudo_personalizado', 'ordem'])
                    ->orderBy('pivot_ordem')
                    ->withTimestamps();
    }

    public function clausulaContratos()
    {
        return $this->hasMany(ClausulaContrato::class, 'clausula_id');
    }

    /**
     * Scopes úteis
     */
    public function scopeGlobais($query)
    {
        return $query->whereNull('team_id');
    }

    public function scopePorEmpresa($query, $teamId)
    {
        return $query->where('team_id', $teamId);
    }

    public function scopeAtivas($query)
    {
        return $query->where('status', 'ativo');
    }

    /**
     * Métodos auxiliares
     */
    public function getOrigemAttribute()
    {
        return $this->team_id
            ? optional($this->team)->name
            : 'Global (Sistema)';
    }

    /**
     * Accessor: Retorna o título sem o prefixo "Cláusula X"
     */
    public function getTituloBaseAttribute()
    {
        // Remove padrões como "Cláusula 1.ª - " ou "Cláusula 10.ª - "
        return preg_replace('/^Cláusula\s*\d+\.ª\s*-\s*/iu', '', $this->titulo);
    }

    /**
     * Accessor: Retorna o número da cláusula (caso exista)
     */
    public function getNumeroClausulaAttribute()
    {
        if (preg_match('/Cláusula\s*(\d+)\.ª/i', $this->titulo, $matches)) {
            return (int) $matches[1];
        }
        return null;
    }
}
