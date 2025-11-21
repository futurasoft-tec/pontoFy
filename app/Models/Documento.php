<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable =[
        'colaborador_id',
        'tipo_documento',
        'nome_arquivo',
        'caminho_arquivo',
        'observacoes',
    ];

    // Relacionamento
    //Relacao com colaborador
    public function colaborador(){
        return $this->belongsTo(Colaboradore::Class, 'colaborador_id');
    }
}
