<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\Team;
use App\Models\Departamento;
use App\Models\Cargo;
use App\Models\User;

class ColaboradorSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('pt_PT');

        // Garantir que há um team e um utilizador criador
        $team = Team::inRandomOrder()->first() ?? Team::factory()->create();
        $userCriador = User::inRandomOrder()->first() ?? User::factory()->create();

        // Garante que existam pelo menos 1 departamento e 1 cargo
        if (Departamento::count() === 0) {
            Departamento::create(['nome' => 'Administração']);
        }

        if (Cargo::count() === 0) {
            Cargo::create(['nome' => 'Assistente Administrativo']);
        }

        $departamentos = Departamento::pluck('id')->toArray();
        $cargos = Cargo::pluck('id')->toArray();

        $provincias = [
            'Luanda', 'Benguela', 'Huambo', 'Huíla', 'Cabinda', 'Namibe', 'Malanje',
            'Cuanza Norte', 'Cuanza Sul', 'Uíge', 'Zaire', 'Bié', 'Moxico', 
            'Cuando Cubango', 'Lunda Norte', 'Lunda Sul'
        ];

        $estadosCivis = ['Solteiro(a)', 'Casado(a)', 'Divorciado(a)', 'Viúvo(a)'];
        $tiposDocumento = ['Bilhete de Identidade', 'Passaporte', 'Cartão de Estrangeiro'];

        for ($i = 1; $i <= 100; $i++) {
            $genero = $faker->randomElement(['M', 'F']);
            $nome = $genero === 'M' ? $faker->name('male') : $faker->name('female');
            $provincia = $faker->randomElement($provincias);
            $codigo = 'COL' . str_pad($i, 4, '0', STR_PAD_LEFT);

            DB::table('colaboradores')->insert([
                'codigo' => $codigo,
                'team_id' => $team->id,
                'user_id' => null,
                'departamento_id' => $faker->randomElement($departamentos),
                'cargo_id' => $faker->randomElement($cargos),
                'nome_completo' => $nome,
                'data_nascimento' => $faker->date('Y-m-d', '2000-01-01'),
                'genero' => $genero,
                'estado_civil' => $faker->randomElement($estadosCivis),
                'nacionalidade' => 'Angolana',

                // Documentos
                'tipo_documento' => $faker->randomElement($tiposDocumento),
                'numero_doc_id' => strtoupper(Str::random(9)),
                'data_emissao_doc' => $faker->date('Y-m-d', '-5 years'),
                'data_validade_doc' => $faker->date('Y-m-d', '+5 years'),
                'nif' => '00' . $faker->unique()->numerify('#######'),
                'numero_inss' => 'INSS' . $faker->unique()->numerify('######'),

                // Contactos
                'pais' => 'Angola',
                'provincia' => $provincia,
                'cidade_estrangeira' => null,
                'endereco' => 'Bairro ' . ucfirst($faker->word()) . ', Rua ' . $faker->streetName(),
                'telefone' => '+2449' . $faker->numerify('########'),
                'email' => Str::slug($nome, '.') . '@exemplo.co.ao',
                'foto_url' => $faker->imageUrl(300, 300, 'people', true),

                // Situação laboral
                'data_admissao' => $faker->date('Y-m-d', '-2 years'),
                'data_demissao' => $faker->boolean(10) ? $faker->date('Y-m-d', '-3 months') : null,
                'status' => 'ativo',

                // Auditoria
                'criado_por' => $userCriador->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('100 colaboradores angolanos criados com sucesso!');
    }
}
