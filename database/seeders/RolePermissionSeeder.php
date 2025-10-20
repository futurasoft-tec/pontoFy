<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        if (!Schema::hasColumn('roles', 'type')) {
            Log::warning("A coluna 'type' não existe na tabela 'roles'. Seeder abortado.");
            $this->command->warn("A coluna 'type' não existe na tabela 'roles'. Verifique as migrations.");
            return;
        }

        $this->command->info("Criando roles e permissões...");

        // -------------------------------
        // ROLES DO SISTEMA (BACKOFFICE)
        // -------------------------------
        $systemRoles = [
            'system_admin'     => 'system',
            'system_suporte'   => 'system',
            'system_financeiro'=> 'system',
            'system_tecnico'   => 'system',
        ];

        // -------------------------------
        // ROLES DAS COMPANIES (CLIENTES)
        // -------------------------------
        $companyRoles = [
            'company_admin'       => 'company',
            'company_rh_manager'  => 'company',
            'company_financeiro'  => 'company',
            'company_colaborador' => 'company',
        ];

        // Criação das roles
        $rolesMap = [];
        foreach (array_merge($systemRoles, $companyRoles) as $roleName => $type) {
            $role = Role::firstOrCreate(['name' => $roleName], ['type' => $type]);
            $rolesMap[$roleName] = $role;
            $this->command->info("Role criada: {$roleName} (tipo: {$type})");
        }

        // -------------------------------
        // PERMISSÕES DO SISTEMA
        // -------------------------------
        $systemPermissions = [
            'system_admin_acesso'       => ['system_admin'], // acesso exclusivo (dashboard, config, etc.
            'system_acesso'             => ['system_admin','system_suporte','system_financeiro','system_tecnico'],
            'system_gerirPlanos'        => ['system_admin','system_financeiro'],
            'system_gerirAssinaturas'   => ['system_admin','system_financeiro'],
            'system_gerirCobrancas'     => ['system_admin','system_financeiro'],
            'system_verLogs'            => ['system_admin','system_suporte'],
            'system_gerirIntegracoes'   => ['system_admin','system_tecnico'],
        ];

        // -------------------------------
        // PERMISSÕES DAS COMPANIES
        // -------------------------------
        $companyPermissions = [
            'company_admin_acesso'           => ['company_admin'], // acesso exclusivo (dashboard, config, etc.)
            'company_acessoSistema'          => ['company_admin','company_rh_manager','company_financeiro','company_colaborador'],
            'company_gestaoColaboradores'    => ['company_admin','company_rh_manager'],
            'company_gestaoDepartamentos'    => ['company_admin','company_rh_manager'],
            'company_processarFolha'         => ['company_admin','company_financeiro'],
            'company_recibos'                => ['company_admin','company_financeiro','company_colaborador'],
            'company_beneficios'             => ['company_admin','company_financeiro'],
            'company_gestaoFerias'           => ['company_admin','company_rh_manager'],
            'company_gestaoAusencias'        => ['company_admin','company_rh_manager'],
            'company_relatoriosRH'           => ['company_admin','company_rh_manager'],
            'company_relatoriosFinanceiros'  => ['company_admin','company_financeiro'],
        ];

        $this->command->info("Criando permissões e associando às roles...");

        // Criar permissões do sistema
        foreach ($systemPermissions as $permissionName => $assignedRoles) {
            $permission = Permission::firstOrCreate(['name' => $permissionName]);
            $this->command->info(" Permissão criada: {$permissionName}");

            foreach ($assignedRoles as $roleName) {
                if (isset($rolesMap[$roleName])) {
                    $rolesMap[$roleName]->givePermissionTo($permission);
                    $this->command->line("   → Permissão atribuída a: {$roleName}");
                }
            }
        }

        // Criar permissões das companies
        foreach ($companyPermissions as $permissionName => $assignedRoles) {
            $permission = Permission::firstOrCreate(['name' => $permissionName]);
            $this->command->info(" Permissão criada: {$permissionName}");

            foreach ($assignedRoles as $roleName) {
                if (isset($rolesMap[$roleName])) {
                    $rolesMap[$roleName]->givePermissionTo($permission);
                    $this->command->line("   → Permissão atribuída a: {$roleName}");
                }
            }
        }

        $this->command->info("Roles e permissões criadas com sucesso!");
    }
}
