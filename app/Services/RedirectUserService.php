<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class RedirectUserService
{
    public function handle()
    {
        $user = Auth::user();
        $team = $user->currentTeam;

        if (!$team) {
            return redirect('/')->withErrors('Nenhum time ativo.');
        }

        // --- SYSTEM ---
        if ($user->hasRole('system_admin') || $user->can('systemAccess')) {
            return redirect()->route('system.dashboard', ['team' => $team->slug]);
        }

        // --- COMPANY ---
        if (
            $user->hasRole('company_admin') ||
            $user->hasRole('company_rh_manager') ||
            $user->hasRole('company_financeiro') ||
            $user->hasRole('company_colaborador') ||
            $user->can('companyAccess')
        ) {
            return redirect()->route('company.dashboard', ['team' => $team->slug]);
        }

        // Se não tiver role válida
        abort(403, 'Acesso negado.');
    }
}
