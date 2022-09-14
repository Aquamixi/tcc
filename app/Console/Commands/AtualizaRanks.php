<?php

namespace App\Console\Commands;

use App\Models\curtida;
use App\Models\receita;
use App\Models\User;
use Illuminate\Console\Command;

class AtualizaRanks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'atualiza:ranks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualiza os ranks dos usuários com base nas estatísticas do mesmo';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $usuarios = User::where('rank', '<>', 'incompleto')->get();

        foreach($usuarios as $usuario){
            $qtde_receitas = \App\Models\receita::withoutGlobalScope(\App\Scopes\ReceitaScope::class)
            ->where('user_id', $usuario->id)
            ->count();

            if($qtde_receitas > 0 and $qtde_receitas <= 10){
                $usuario->rank = 'Cozinheiro';
                $usuario->update();
            }
            elseif($qtde_receitas > 10 and $qtde_receitas <= 20){
                $usuario->rank = 'Profissional';
                $usuario->update();
            }
            elseif($qtde_receitas > 20 and $qtde_receitas <= 40){
                $usuario->rank = 'Cheff';
                $usuario->update();
            }
            elseif($qtde_receitas > 40 and $qtde_receitas <= 70){
                $usuario->rank = 'Mestre Cuca';
                $usuario->update();
            }
        }
    }
}
