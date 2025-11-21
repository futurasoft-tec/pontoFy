<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB; // <-- Import necessário

class ListTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:list-tables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lista todas as tabelas do banco de dados';

    /**
     * Execute the console command.
     */
   public function handle()
    {
        $database = DB::getDatabaseName();
        $tables = DB::select("SHOW TABLES FROM `$database`");
        
        foreach ($tables as $table) {
            $this->info(array_values((array) $table)[0]);
        }
    }

}
