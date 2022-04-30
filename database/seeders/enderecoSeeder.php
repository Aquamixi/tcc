<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class enderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\endereco::factory()->count(50)->create();
    }
}
