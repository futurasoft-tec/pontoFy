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



    public function colaboradores()
    {
        return $this->belongsToMany(
            \App\Models\Colaboradore::class,
            'rubrica_colaboradors',
            'rubrica_id',
            'colaborador_id'
        )
        ->withPivot('id', 'team_id', 'eh_automatica', 'valor_customizado', 'formula_customizada')
        ->withTimestamps();
    }



    
}
