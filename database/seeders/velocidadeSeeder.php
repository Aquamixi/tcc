<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class velocidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $velocidades = ['Receita Rápida', 'Receita Média', 'Receita Longa'];

        foreach($velocidades as $velocidade){
            $linha = new \App\Models\velocidade();
            $linha->velocidade = $velocidade;
            $linha->save();
        }
    }
}
