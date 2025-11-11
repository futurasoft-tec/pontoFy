<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

class Team extends JetstreamTeam
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'personal_team',
    ];



    // RELACOES
    # Pegar todos departamentos do team
    public function departamentos(){
        return $this->hasMany(Departamento:: class, 'team_id');
    }



     # Pegar todos departamentos do team
    public function cargos(){
        return $this->hasMany(Cargo:: class, 'team_id');
    }


     # Pegar todos departamentos do team
    public function niveis(){
        return $this->hasMany(NiveisHierarquico:: class, 'team_id');
    }


     # Pegar todos colaboradores do team
    public function colaboradores(){
        return $this->hasMany(Colaborador:: class, 'team_id');
    }


    # Pegar todos periodos de processamentos
    public function periodos(){
        return $this->hasMany(Colaborador:: class, 'team_id');
    }

    # Pegar todas folhas de salarios
    public function folhasSalarios(){
        return $this->hasMany(FolhasSalario:: class, 'team_id');
    }

    // Usuario dono do team 
    public function user(){
        return $this->belongsTO(User:: class, 'user_id');
    }







    /**
     * The event map for the model.
     *
     * @var array<string, class-string>
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'personal_team' => 'boolean',
        ];
    }


















}
