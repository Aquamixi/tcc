<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\receita;

class receitaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = receita::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo_receita' => $this->faker->text($maxNbChars = 15),
            'modo_preparo' => $this->faker->text($maxNbChars = 100),
            'descricao' => $this->faker->text($maxNbChars = 100),
            'tempo_preparo' => $this->faker->time($format = 'H:i:s', $max = 'now'),
            'qtde_porcoes' => $this->faker->randomDigit,
            'avaliacao' => $this->faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 5),
            'data_postagem' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'user_id' => $this->faker->numberBetween(1, 50),
            'sabor_id' => $this->faker->numberBetween(1, 6),
            'categoria_id' => $this->faker->numberBetween(1, 7),
            'velocidade_id' => $this->faker->numberBetween(1, 3),
            'mais_dezoito' => $this->faker->boolean(),
            'escondida' => $this->faker->boolean(),
            'nacionalidade_id' => $this->faker->numberBetween(1, 30)
        ];
    }
}
