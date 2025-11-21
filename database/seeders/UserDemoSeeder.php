<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Rubrica;
use App\Models\Team;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // === 1. Cria ou atualiza o utilizador Demo ===
    $user = User::updateOrCreate(
        ['email' => 'demo@pontofy.com'],
        [
            'name' => 'Usuário Demo',
            'password' => Hash::make('demo1234'),
            'email_verified_at' => now(),
            // 'role' => 'company_admin', // Campo na tabela users
        ]
    );

    // === 2. Cria ou atualiza o Team Demo ===
    $team = Team::updateOrCreate(
        ['name' => 'Pontofy Demo'],
        [
            'user_id' => $user->id,
            'personal_team' => false,
            'logotipo' => null,
            'actividade_economica' => 'Tecnologia e Serviços Digitais',
            'nif' => '500000000',
            'inss_antigo' => null,
            'inss_novo' => null,
            'regime_iva' => 'Geral',
            'licenca_comercial' => 'LC-2025-0001',
            'pais' => 'Angola',
            'provincia' => 'Luanda',
            'municipio' => 'Talatona',
            'cidade' => 'Luanda',
            'bairro' => 'Benfica',
            'endereco' => 'Rua Principal, Edifício 10',
            'email' => 'demo@pontofy.com',
            'telefone' => '+244 923 000 000',
            'website' => 'https://pontofy.com',
            'status' => 'activo',
        ]
    );

    // === 3. Atualiza o current_team_id ===
    $user->forceFill([
        'current_team_id' => $team->id,
    ])->save();

    // === 4. Cria rubricas padrão do Team ===
    $this->createDefaultRubricas($team);

    // === 5. Cria o papel "company_admin" se não existir ===
    $role = Role::firstOrCreate(['name' => 'company_admin']);

    // === 6. Cria permissões básicas do admin da empresa ===
    $permissions = [
        'ver dashboard',
        'gerir utilizadores',
        'gerir clientes',
        'emitir facturas',
        'gerir planos',
    ];

    foreach ($permissions as $perm) {
        $permission = Permission::firstOrCreate(['name' => $perm]);
        $role->givePermissionTo($permission);
    }

    // === 7. Atribui o papel ao utilizador demo ===
    if (!$user->hasRole('company_admin')) {
        $user->assignRole('company_admin');
    }

    // Confirmação
    $this->command->info('Usuário Demo criado com role "company_admin" e permissões atribuídas, rubricas padrão criadas.');
}

/**
 * Cria rubricas padrão para o Team.
 */
protected function createDefaultRubricas(Team $team): void
{
    $rubricasPadrao = [
        [
            'codigo'        => 'SAL_BASE',
            'nome'          => 'Salário Base',
            'tipo'          => 'vencimento',
            'base_calculo'  => 'formula',
            'valor'         => null,
            'is_tributavel' => true,
            'slug_sistema'  => 'salario_base',
        ],
        [
            'codigo'        => 'SUB_TRAN',
            'nome'          => 'Subsídio Transporte',
            'tipo'          => 'vencimento',
            'base_calculo'  => 'fixo',
            'valor'         => 0,
            'is_tributavel' => true,
            'slug_sistema'  => 'subsidio_transporte',
        ],
        [
            'codigo'        => 'SUB_ALIM',
            'nome'          => 'Subsídio Alimentação',
            'tipo'          => 'vencimento',
            'base_calculo'  => 'fixo',
            'valor'         => 0,
            'is_tributavel' => false,
            'slug_sistema'  => 'subsidio_alimentacao',
        ],
        [
            'codigo'        => 'INSS_COL',
            'nome'          => 'INSS Colaborador',
            'tipo'          => 'desconto',
            'base_calculo'  => 'percentual',
            'valor'         => 3,
            'is_tributavel' => false,
            'slug_sistema'  => 'inss_colaborador',
        ],
        [
            'codigo'        => 'IRPS',
            'nome'          => 'IRPS',
            'tipo'          => 'desconto',
            'base_calculo'  => 'formula',
            'valor'         => null,
            'is_tributavel' => true,
            'slug_sistema'  => 'irps',
        ],
    ];

    foreach ($rubricasPadrao as $rubrica) {
        Rubrica::firstOrCreate(
            ['team_id' => $team->id, 'codigo' => $rubrica['codigo']],
            array_merge($rubrica, ['team_id' => $team->id])
        );
    }
}

}
