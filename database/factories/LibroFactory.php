<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Libro;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Libro>
 */
class LibroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique(),
            'nombre_libro' => $this->faker->sentence(3),
            'año' => $this->faker->year(),
            'autor' => $this->faker->name(),
            'editorial' => $this->faker->company(),
            'genero' => $this->faker->word(),
            'disponible' => $this->faker->boolean(),
        ];
    }
}
