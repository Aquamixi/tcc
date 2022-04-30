<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class paiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paises = [
            'Argentina',
            'Bolívia',
            'Brasil',
            'Chile',
            'Colômbia',
            'Equador',
            'Guiana',
            'Guiana Francesa',
            'Paraguai',
            'Peru',
            'Suriname',
            'Uruguai',
            'Venezuela'
        ];

        foreach($paises as $pais){
            \App\Models\pai::create([
                'pais' => $pais
            ]);
        }
    }
}
