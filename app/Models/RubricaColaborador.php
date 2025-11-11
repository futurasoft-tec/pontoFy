<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RubricaColaborador extends Model
{
    protected $table = 'rubrica_colaboradors';
    
    protected $fillable = [
        'team_id',
        'colaborador_id',
        'rubrica_id',
        'eh_automatica',
        'valor_customizado', 
        'formula_customizada'
    ];



    // Relação com o modelo Colaboradore
    public function colaborador()
    {
        return $this->belongsTo(Colaboradore::class, 'colaborador_id');
    } 

    // Relação com o modelo Rubrica
    public function rubrica()
    {
        return $this->belongsTo(Rubrica::class, 'rubrica_id'); 
    }


    
    

    
}
