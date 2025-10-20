<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
     //
    protected $fillable = [
        'team_id',
        'departamento_id',
        'nivel_id',
        'nome',
        'descricao',
        'criado_por',
    ];




    // Relacionamentos
    // Cargo pertence a um team

    // Pegar o team a que pertence o departamento
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    // Pegar usuario que criou o departamento
    public function user()
    {
        return $this->belongsTo(User::class, 'criado_por');
    }


    // Pegar nivel hierarquico do cargo
    public function nivel()
    {
        return $this->belongsTo(NiveisHierarquico::class, 'nivel_id');
    }


    // Pegar usuario que criou o departamento
    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }


    // Pegar todos colaboradores do departamento
    public function colaboradores(){
        return $this->hasMany(Colaboradore:: class);
    }



}
