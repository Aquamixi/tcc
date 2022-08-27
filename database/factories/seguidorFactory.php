<?php

namespace Database\Factories;

use App\Models\seguidor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\seguidor>
 */
class seguidorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = seguidor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'usuario_id' => $this->faker->numberBetween(1, 50),
            'seguidor_id' => $this->faker->numberBetween(1, 50),
            'status' => 'Seguindo'
        ];
    }
}
