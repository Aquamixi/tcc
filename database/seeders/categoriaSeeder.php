<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class categoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = ['Sobremesa', 'Almoço', 'Janta', 'Café da Manhã', 'Lanche da Tarde', 'Brunch', 'Microondas', 'Bebidas', 'Petiscos'];

        foreach($categorias as $categoria){
            $linha = new \App\Models\categoria();
            $linha->categoria = $categoria;
            $linha->save();
        }
    }
}
