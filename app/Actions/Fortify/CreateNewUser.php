<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use App\Models\Rubrica;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Validation\Rule;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'role'     => 'company_admin',
            ]), function (User $user) {
                // Criar Role e atribuir ao usuário
                $role = Role::firstOrCreate(['name' => 'company_admin']);
                $user->assignRole($role);

                // Criar Team pessoal do usuário
                $team = $this->createTeam($user);

                // Criar rubricas padrão para este Team
                $this->createDefaultRubricas($team);
            });
        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): Team
    {
        return $user->ownedTeams()->save(
            Team::forceCreate([
                'user_id' => $user->id,
                'name' => explode(' ', $user->name, 2)[0] . "'s Team",
                'personal_team' => true,
            ])
        );
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
            Rubrica::create(array_merge($rubrica, [
                'team_id' => $team->id,
            ]));
        }
    }

}
