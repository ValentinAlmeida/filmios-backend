<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserModel;

class CreateUsersCommand extends Command
{
    protected $signature = 'factory:users {quantidade : Número de usuários a serem criados}';
    protected $description = 'Cria usuários fictícios utilizando a factory';

    public function handle()
    {
        $quantidade = (int) $this->argument('quantidade');

        if ($quantidade <= 0) {
            $this->error('A quantidade deve ser um número inteiro positivo.');
            return;
        }

        UserModel::factory()->count($quantidade)->create();

        $this->info("{$quantidade} usuário(s) criado(s) com sucesso!");
    }
}
