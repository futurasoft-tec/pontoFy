<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EscalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamId = 1;
        $criadoPor = 1;

        // Colaboradores existentes (exemplo)
        $colaboradores = [1, 2, 3, 4, 5];

        // Horários existentes
        $horarios = [1, 2, 3];

        // Data inicial para gerar escalas
        $dataInicial = Carbon::parse('2025-11-17');

        $registos = [];

        foreach ($colaboradores as $colaboradorId) {
            for ($i = 0; $i < 3; $i++) {

                $registos[] = [
                    'team_id'       => $teamId,
                    'colaborador_id'=> $colaboradorId,
                    'horario_id'    => $horarios[array_rand($horarios)],
                    'data'          => $dataInicial->copy()->addDays($i)->format('Y-m-d'),
                    'criado_por'    => $criadoPor,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ];
            }
        }

        DB::table('escalas')->insert($registos);
    }
}
