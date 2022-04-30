<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\endereco;

class enderecoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = endereco::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rua' => $this->faker->streetName,
            'numero' => $this->faker->buildingNumber,
            'bairro' => $this->faker->citySuffix,
            'cidade' => $this->faker->city,
            'cep' => $this->faker->postcode,
            'uf_id' => $this->faker->numberBetween(1, 26),
            'pai_id' => 3
        ];
    }
}
