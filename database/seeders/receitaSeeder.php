<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class receitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\receita::factory()->count(50)->create();
    }
}
