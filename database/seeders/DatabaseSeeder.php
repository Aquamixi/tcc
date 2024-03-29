<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ufSeeder::class);
        $this->call(paiSeeder::class);
        // $this->call(enderecoSeeder::class);
        // $this->call(userSeeder::class);
        $this->call(saborSeeder::class);
        $this->call(categoriaSeeder::class);
        $this->call(velocidadeSeeder::class);
        $this->call(subCategoriaSeeder::class);
        $this->call(nacionalidadeSeeder::class);
        // $this->call(receitaSeeder::class);
        // $this->call(fotoReceitaSeeder::class);
        // $this->call(seguidorSeeder::class);
        // $this->call(fotoUserSeeder::class);
    }
}
