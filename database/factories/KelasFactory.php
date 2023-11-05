<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kelas>
 */
class KelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->numberBetween(1, 6),
            'rombel' => $this->faker->city(),
            'id_guru' => $this->faker->numberBetween(1, 50),
            'kouta_siswa' => $this->faker->numberBetween(20, 30),
            'id_tahun_ajaran' => 1,

        ];
    }
}
