<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClausulaContrato extends Model
{
    protected $table = 'clausula_contratos';

    protected $fillable = [
        'contrato_id',
        'clausula_id',
        'conteudo_personalizado',
        'ordem',
    ];

    /**
     * Relações
     */

    // Contrato a que pertence
    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id');
    }

    // Cláusula base (modelo) associada
    public function clausula()
    {
        return $this->belongsTo(Clausula::class, 'clausula_id');
    }

    /**
     * Atributo auxiliar – retorna o texto final da cláusula.
     * Se houver conteúdo personalizado, usa-o; caso contrário, usa o conteúdo original da cláusula.
     */
    public function getTextoFinalAttribute()
    {
        return $this->conteudo_personalizado ?? optional($this->clausula)->conteudo;
    }

    /**
     * Scopes úteis
     */

    // Ordena pela sequência configurada
    public function scopeOrdenado($query)
    {
        return $query->orderBy('ordem');
    }

    /**
     * Métodos utilitários
     */

    // Verifica se a cláusula foi personalizada neste contrato
    public function isPersonalizada()
    {
        return !empty($this->conteudo_personalizado);
    }
}
