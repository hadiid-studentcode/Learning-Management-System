<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nisn' => $this->faker->numerify('##########'),
            'nama' => $this->faker->name(),
            'id_kelas' => $this->faker->numberBetween(1, 4),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha']),
            'kelurahan' => $this->faker->city(),
            'kecamatan' => $this->faker->city(),
            'kabupatenKota' => $this->faker->city(),
            'provinsi' => $this->faker->city(),
            'alamat' => $this->faker->address(),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'foto' => fake()->imageUrl('200', '200', 'people'),
            'id_user' => $this->faker->numberBetween(1, 10),

        ];
    }
}
