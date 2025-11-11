<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodosProcessamento extends Model
{
    protected $fillable =[
        'team_id',
        'mes',
        'ano',
        'data_inicio',
        'data_fim',
        'status',
        'observacoes',
        'criado_por',
    ];



    // Relacionamentos
    # Pegar todas folhas_de_salarios do periodo
    public function folhas(){
        return $this->hasMany(FolhasSalario:: class, 'periodo_id');
    }








}
