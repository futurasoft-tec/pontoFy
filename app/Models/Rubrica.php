<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rubrica extends Model
{
    // Permite mass-assignment para estes campos
    protected $fillable = [
        'team_id',
        'codigo',
        'nome',
        'descricao',
        'tipo',
        'base_calculo',
        'valor',
        'formula',
        'is_tributavel',
        'slug_sistema'
    ];



   public function rubricas()
    {
        return $this->belongsToMany(
            \App\Models\Rubrica::class,
            'rubrica_colaboradors',
            'colaborador_id',
            'rubrica_id'
        )
        ->withPivot([
            'id',
            'team_id',
            'colaborador_id',
            'rubrica_id',
            'eh_automatica',
            'valor_customizado',
            'formula_customizada',
            'status'
        ])
        ->withTimestamps();
    }




    
}
