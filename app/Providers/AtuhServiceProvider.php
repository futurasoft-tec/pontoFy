<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Registre quaisquer serviços de autenticação ou autorização.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap serviços de autenticação/autorização.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // ================================
        // SYSTEM (BACKOFFICE DO SaaS)
        // ================================
        $systemPermissions = [
            'systemAccess'          => 'system_acesso',
            'systemCompanies'       => 'system_gerirEmpresas',
            'systemPlans'           => 'system_gerirPlanos',
            'systemSubscriptions'   => 'system_gerirAssinaturas',
            'systemCharges'         => 'system_gerirCobrancas',
            'systemLogs'            => 'system_verLogs',
            'systemIntegrations'    => 'system_gerirIntegracoes',
            'systemSettings'        => 'system_configuracoes',
        ];

        // ================================
        // COMPANY (CLIENTES)
        // ================================
        $companyPermissions = [
            // Acesso exclusivo admin (dashboard + config)
            'companyAdminAccess'   => 'company_admin_acesso',

            // Acesso geral
            'companyAccess'        => 'company_acessoSistema',

            // Gestão de pessoas
            'companyEmployees'     => 'company_gestaoColaboradores',
            'companyDepartments'   => 'company_gestaoDepartamentos',

            // Processamento salarial 
            'companyPayroll'       => 'company_processarFolha',
            'companyPayslips'      => 'company_recibos',
            'companyBenefits'      => 'company_beneficios',

            // Gestão de tempo
            'companyHolidays'      => 'company_gestaoFerias',
            'companyAbsences'      => 'company_gestaoAusencias',

            // Relatórios
            'companyReportsRH'     => 'company_relatoriosRH',
            'companyReportsFinance'=> 'company_relatoriosFinanceiros',
        ];

        // ================================
        // Registrar Gates dinamicamente
        // ================================
        foreach (array_merge($systemPermissions, $companyPermissions) as $gate => $permission) {
            Gate::define($gate, fn($user) => $user->can($permission));
        }

        // ================================
        // ADMIN DO SISTEMA: acesso global
        // ================================
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('system_admin')) {
                return true;
            }
        });
    }
}
