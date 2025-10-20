<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    //
    protected $fillable = [
        'team_id',
        'nome',
        'descricao',
        'status',
        'criado_por'
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
    public function colaboradores(){
        return $this->hasMany(Colaboradore:: class);
    }











}
