<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Team;
use App\Models\User;
use App\Models\Departamento;
use App\Models\Cargo;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categoriasBase = [
            [
                'nome' => 'Desenvolvimento Web',
                'funcao' => 'Programação e manutenção de aplicações web',
                'descricao' => 'Equipa responsável por criar e manter soluções web em Laravel, React, Vue ou similares.'
            ],
            [
                'nome' => 'Infraestrutura e Cloud',
                'funcao' => 'Administração de servidores e serviços cloud',
                'descricao' => 'Foco em AWS, Azure, Google Cloud, segurança e escalabilidade.'
            ],
            [
                'nome' => 'Design e UX',
                'funcao' => 'Criação de interfaces e experiências do utilizador',
                'descricao' => 'Conceção de protótipos, identidade visual e experiência digital do utilizador.'
            ],
            [
                'nome' => 'Gestão de Projetos',
                'funcao' => 'Planeamento e acompanhamento de projetos',
                'descricao' => 'Gestão de sprints, prazos e tarefas através de metodologias ágeis (Scrum/Kanban).'
            ],
            [
                'nome' => 'Qualidade e Testes',
                'funcao' => 'Garantia de qualidade e testes automatizados',
                'descricao' => 'Execução de testes manuais e automáticos para assegurar a estabilidade do sistema.'
            ],
            [
                'nome' => 'Suporte Técnico',
                'funcao' => 'Atendimento e resolução de problemas de clientes',
                'descricao' => 'Responsável por suporte remoto, manutenção e atendimento ao utilizador final.'
            ],
            [
                'nome' => 'Comercial e Vendas',
                'funcao' => 'Gestão de leads e processos de venda',
                'descricao' => 'Identificação de oportunidades de negócio e contacto com potenciais clientes.'
            ],
            [
                'nome' => 'Marketing Digital',
                'funcao' => 'Gestão de campanhas online e redes sociais',
                'descricao' => 'Gestão de tráfego pago, SEO, branding e redes sociais da empresa.'
            ],
            [
                'nome' => 'Financeiro e Contabilidade',
                'funcao' => 'Gestão financeira e contabilística',
                'descricao' => 'Processamento de pagamentos, emissão de facturas e controlo de custos.'
            ],
            [
                'nome' => 'Recursos Humanos',
                'funcao' => 'Gestão de colaboradores e recrutamento',
                'descricao' => 'Seleção, integração e acompanhamento de talentos da empresa.'
            ],
        ];

        $teams = Team::all();
        $user = User::first();

        if ($teams->isEmpty() || !$user) {
            $this->command->warn('Nenhum team ou user encontrado. Seeder não foi executado.');
            return;
        }

        foreach ($teams as $team) {
            $departamentos = Departamento::where('team_id', $team->id)->get();
            $cargos = Cargo::where('team_id', $team->id)->get();

            if ($departamentos->isEmpty() || $cargos->isEmpty()) {
                $this->command->warn("Team {$team->id}: faltam departamentos ou cargos.");
                continue;
            }

            foreach ($categoriasBase as $categoria) {
                DB::table('categorias')->insert([
                    'team_id' => $team->id,
                    'departamento_id' => $departamentos->random()->id,
                    'cargo_id' => $cargos->random()->id,
                    'nome' => $categoria['nome'],
                    'funcao' => $categoria['funcao'],
                    'descricao' => $categoria['descricao'],
                    'estado' => 'ativo',
                    'criado_por' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Categorias criadas com sucesso para todos os teams.');
    }
}
