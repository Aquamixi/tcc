<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class saborSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sabores = ['Salgado', 'Doce', 'Apimentado', 'Agridoce', 'Azedo', 'Amargo'];
        
        foreach($sabores as $sabor){
            $linha = new \App\Models\sabor();
            $linha->sabor = $sabor;
            $linha->save();
        }
    }
}
