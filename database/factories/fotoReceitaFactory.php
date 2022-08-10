<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\fotoReceita;

class fotoReceitaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = fotoReceita::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'anexo' => 'baiacu_2.0.png',
            'receita_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}