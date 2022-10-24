<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class subCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sub_categorias = ['Saladas', 'Churrasco', 'Sopas', 'Gelatinas', 'Bolos', 'Arroz', 'Massas', 'Bebidas'];
        $index = 1;
        foreach($sub_categorias as $sub_categoria){
            $linha = new \App\Models\subCategoria();
            $linha->sub_categoria = $sub_categoria;
            $linha->categoria_id = $index;
            $linha->save();
            $index += 1;
        }
    }
}
