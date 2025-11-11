<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Team;
use App\Models\User;

class NivelHierarquicoSeeder extends Seeder
{
    public function run(): void
    {
        // Níveis hierárquicos padrão
        $niveisBase = [
            [
                'nome' => 'Direção Executiva',
                'codigo' => 'N1',
                'descricao' => 'Responsável pela liderança estratégica da empresa e tomada de decisões de alto nível.',
                'prioridade' => 1,
            ],
            [
                'nome' => 'Gestão / Coordenação',
                'codigo' => 'N2',
                'descricao' => 'Coordena equipas e assegura o cumprimento dos objetivos definidos pela direção.',
                'prioridade' => 2,
            ],
            [
                'nome' => 'Supervisão',
                'codigo' => 'N3',
                'descricao' => 'Supervisiona as operações diárias e o desempenho das equipas.',
                'prioridade' => 3,
            ],
            [
                'nome' => 'Técnico Especialista',
                'codigo' => 'N4',
                'descricao' => 'Profissionais com funções técnicas e operacionais especializadas em TI e desenvolvimento.',
                'prioridade' => 4,
            ],
            [
                'nome' => 'Operacional / Estagiário',
                'codigo' => 'N5',
                'descricao' => 'Funções de base, apoio técnico e estágio, com acompanhamento de supervisores.',
                'prioridade' => 5,
            ],
        ];

        $teams = Team::all();
        $user = User::first();

        if ($teams->isEmpty() || !$user) {
            $this->command->warn('Nenhum team ou user encontrado. Seeder não foi executado.');
            return;
        }

        foreach ($teams as $team) {
            foreach ($niveisBase as $nivel) {
                DB::table('niveis_hierarquicos')->insert([
                    'team_id' => $team->id,
                    'nome' => $nivel['nome'],
                    'codigo' => $nivel['codigo'],
                    'descricao' => $nivel['descricao'],
                    'prioridade' => $nivel['prioridade'],
                    'criado_por' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Níveis hierárquicos criados com sucesso para todos os teams.');
    }
}
