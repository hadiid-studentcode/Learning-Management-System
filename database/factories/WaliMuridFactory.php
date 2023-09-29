<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WaliMurid>
 */
class WaliMuridFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => $this->faker->numerify('##########'),
            'nama' => $this->faker->name(),
            'hubungan' => $this->faker->randomElement(['Orang Tua', 'Saudara', 'Keponakan']),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'agama' => $this->faker->randomElement(['Islam', 'Katolik', 'Protestan', 'Hindu', 'Budha', 'Konghucu']),
            'no_hp' => $this->faker->phoneNumber(),
            'kelurahan' => $this->faker->streetName(),
            'kecamatan' => $this->faker->streetName(),
            'kabupatenKota' => $this->faker->city(),
            'provinsi' => $this->faker->streetName(),
            'email' => $this->faker->email(),
            'pekerjaan' => $this->faker->jobTitle(),
            'alamat' => $this->faker->address(),
            'id_siswa' => $this->faker->numberBetween(1, 2),
            'id_user' => $this->faker->numberBetween(1, 10),

        ];
    }
}
