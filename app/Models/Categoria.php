<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //

    protected $fillable = [
        'team_id',
        'departamento_id',
        'cargo_id',
        'nome',
        'funcao',
        'estado',
        'criado_por',
    ];


     // RELACOES

    // Pegar o team a que pertence o departamento
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    // Pegar usuario que criou o departamento
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // Pegar todos colaboradores do departamento
    


     // Pegar usuario que criou o departamento
    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

     // Pegar usuario que criou o departamento
    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }




}
