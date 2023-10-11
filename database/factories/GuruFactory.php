<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guru>
 */
class GuruFactory extends Factory
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
            'nbm' => $this->faker->numerify('##########'),
            'nama' => $this->faker->name(),
            'jenis' => 'Non Wali Kelas',
            'status' => $this->faker->randomElement(['Tetap', 'Kontrak']),
            'bidang_studi' => $this->faker->randomElement(['pendidikan mtk', 'fisika', 'ilmu komputer', 'bahasa indonesia', 'bahasa inggris']),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'nohp' => $this->faker->phoneNumber(),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha']),
            'status_perkawinan' => $this->faker->randomElement(['Belum Menikah', 'Menikah', 'Cerai']),
            'kelurahan' => $this->faker->city(),
            'kecamatan' => $this->faker->city(),
            'kabupatenKota' => $this->faker->city(),
            'provinsi' => $this->faker->city(),
            'alamat' => $this->faker->address(),
            'foto' => '1686726289999-arief.jpg',
            'id_user' => $this->faker->numberBetween(1, 10),

        ];
    }
}
