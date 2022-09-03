<?php

namespace App\Console\Commands;

use App\Models\receita;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AtualizaDataPostagem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'atualiza:datapostagem';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualiza a data postagem de 5 receitas para o dia atual';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today()->format('Y-m-d');

        $receita_hoje = receita::has('foto')
            ->take(5)
            ->get();

        foreach($receita_hoje as $receita){
            $receita->data_postagem = $today;
            $receita->update();
        }
    }
}
