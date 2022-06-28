<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ingredienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ingrediente::factory()->count(50)->create();
    }
}
