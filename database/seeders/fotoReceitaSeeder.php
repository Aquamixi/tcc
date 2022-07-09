<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class fotoReceitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\fotoReceita::factory()->count(50)->create();
    }
}