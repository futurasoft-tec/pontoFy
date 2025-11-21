<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('horarios')->insert([
            // Horário Normal
            [
                'team_id' => 1,
                'nome' => 'Horário Normal',
                'hora_entrada' => '08:00:00',
                'hora_saida' => '17:00:00',
                'tolerancia_minutos' => 10,
                'intervalo' => true,
                'intervalo_inicio' => '12:30:00',
                'intervalo_fim' => '13:30:00',
                'criado_por' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Meio Período (Manhã)
            [
                'team_id' => 1,
                'nome' => 'Meio Período - Manhã',
                'hora_entrada' => '08:00:00',
                'hora_saida' => '12:00:00',
                'tolerancia_minutos' => 5,
                'intervalo' => false,
                'intervalo_inicio' => null,
                'intervalo_fim' => null,
                'criado_por' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Turno Nocturno
            [
                'team_id' => 1,
                'nome' => 'Turno Nocturno',
                'hora_entrada' => '18:00:00',
                'hora_saida' => '02:00:00',
                'tolerancia_minutos' => 15,
                'intervalo' => false,
                'intervalo_inicio' => null,
                'intervalo_fim' => null,
                'criado_por' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
