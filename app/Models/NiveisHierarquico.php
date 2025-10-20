<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NiveisHierarquico extends Model
{
    //

    protected $fillable = [
        'team_id',
        'nome',
        'codigo',
        'prioridade',
        'descricao',
        'criado_por',
    ];


    // Pegar os cargos do nivel hierarquico
    public function cargos()
    {
        return $this->hasMany(Cargo::class, 'nivel_id');
    }

}

