<?php
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'cpf' => $this->faker->cpf(false),
            'dataNascimento' => $this->faker->date,
            'email' => $this->faker->unique()->safeEmail,
            'telefone' => $this->faker->landlineNumber(false),
            'logradouro' => $this->faker->streetAddress,
            'cidade' => 'Vitória',
            'estado' => 'ES'
        ];
    }
}
