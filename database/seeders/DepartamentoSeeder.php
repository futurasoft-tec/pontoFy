<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Str;

class DepartamentoSeeder extends Seeder
{
    public function run(): void
    {
        $departamentosBase = [
            'Desenvolvimento de Software' => 'Criação, manutenção e melhoria de sistemas e aplicações.',
            'Infraestrutura e Redes' => 'Gestão de servidores, redes internas e infraestrutura de TI.',
            'Suporte Técnico' => 'Atendimento a clientes e resolução de problemas técnicos.',
            'Qualidade e Testes (QA)' => 'Garantia da qualidade de software por meio de testes automatizados e manuais.',
            'Gestão de Projetos' => 'Planeamento, coordenação e acompanhamento de projetos.',
            'UX/UI Design' => 'Design de interfaces e experiências do utilizador.',
            'Comercial e Vendas' => 'Gestão de leads, propostas e contratos de serviços.',
            'Marketing Digital' => 'Gestão de marca, redes sociais, SEO e campanhas online.',
            'Recursos Humanos' => 'Gestão de talentos, recrutamento e bem-estar dos colaboradores.',
            'Administração e Finanças' => 'Controlo financeiro, facturação e gestão administrativa.',
        ];

        $teams = Team::all();
        $user = User::first();

        if ($teams->isEmpty() || !$user) {
            $this->command->warn('Nenhum team ou user encontrado. Seeder não foi executado.');
            return;
        }

        foreach ($teams as $team) {
            foreach ($departamentosBase as $nome => $descricao) {
                DB::table('departamentos')->insert([
                    'team_id' => $team->id,
                    'nome' => $nome,
                    'descricao' => $descricao,
                    'status' => 'ativo',
                    'criado_por' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Departamentos criados com sucesso para todos os teams.');
    }
}
