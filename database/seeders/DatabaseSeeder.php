<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();

        // User::factory()->withPersonalTeam()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Registros Para empresas em massa
        



       
        $this->call([
            // Registros do system
            UserDemoSeeder::class,
            RolePermissionSeeder::class,
            ClausulaTableSeeder::class,
            // Outros seeders globais
            DepartamentoSeeder::class,
            NivelHierarquicoSeeder::class,
            CargoSeeder::class,
            CategoriaSeeder::class,
            ColaboradorSeeder::class,
        ]);

       
    }
}
