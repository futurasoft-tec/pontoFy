<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Team;
use App\Models\User;
use App\Models\Departamento;
use App\Models\NiveisHierarquico;

class CargoSeeder extends Seeder
{
    public function run(): void
    {
        $cargosBase = [
            'Diretor de Tecnologia (CTO)' => 'Responsável pela liderança técnica e definição da arquitetura tecnológica da empresa.',
            'Gestor de Projetos' => 'Coordena projetos de desenvolvimento e garante a entrega dentro dos prazos e padrões de qualidade.',
            'Programador Full Stack' => 'Desenvolve aplicações web em frontend e backend, garantindo integração e desempenho.',
            'Programador Backend' => 'Focado na lógica de servidor, APIs, banco de dados e integração de sistemas.',
            'Programador Frontend' => 'Desenvolve interfaces de utilizador modernas e responsivas usando tecnologias web.',
            'Designer UX/UI' => 'Cria experiências e interfaces intuitivas e centradas no utilizador.',
            'Analista de Qualidade (QA)' => 'Realiza testes funcionais e automatizados para garantir a qualidade do software.',
            'Técnico de Suporte' => 'Atende utilizadores, resolve problemas técnicos e presta suporte remoto e presencial.',
            'Analista de Sistemas' => 'Analisa requisitos, modela processos e propõe soluções técnicas.',
            'Assistente Administrativo' => 'Responsável por tarefas administrativas e apoio às equipas operacionais.',
        ];

        $teams = Team::all();
        $user = User::first();

        if ($teams->isEmpty() || !$user) {
            $this->command->warn('Nenhum team ou user encontrado. Seeder não foi executado.');
            return;
        }

        foreach ($teams as $team) {
            $departamentos = Departamento::where('team_id', $team->id)->get();
            $niveis = NiveisHierarquico::where('team_id', $team->id)->get();

            if ($departamentos->isEmpty() || $niveis->isEmpty()) {
                $this->command->warn("Team {$team->id}: faltam departamentos ou níveis hierárquicos.");
                continue;
            }

            $departamentosAleatorios = $departamentos->shuffle();
            $niveisAleatorios = $niveis->shuffle();

            foreach ($cargosBase as $nome => $descricao) {
                DB::table('cargos')->insert([
                    'team_id' => $team->id,
                    'departamento_id' => $departamentosAleatorios->random()->id,
                    'nivel_id' => $niveisAleatorios->random()->id,
                    'nome' => $nome,
                    'descricao' => $descricao,
                    'criado_por' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Cargos criados com sucesso para todos os teams.');
    }
}
