<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dependente extends Model
{
    protected $fillable =[
        'colaborador_id',
        'nome',
        'sexo',
        'data_nascimento',
        'parentesco',
        'criado_por',
    ];


    // Relacionamento
    // Relacao com tabela colaboradores
    public function colaborador(){
        return $this->belongsTo(Colaboradore::class, 'team_id');
    }
    
}
