<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jenis>
 */
class JenisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
        'nama_jenis' => fake()->randomElement(['Makan Berat', 'Makan Ringan', 'Non Coffe', 'Coffe','Tea','Milkshake']),
       ];
    }
}
