<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = user::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'endereco_id' => $this->faker->unique()->numberBetween(1, 50),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'telefone' => $this->faker->tollFreePhoneNumber,
            'data_nascimento' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'first_login' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'genero' => 'Indefinido'
        ];
    }
}
