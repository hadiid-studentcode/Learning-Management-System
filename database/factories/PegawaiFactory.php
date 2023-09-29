<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
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
            'jenis' => $this->faker->randomElement(['Satpam', 'Tata Usaha', 'Tukang Listrik', 'Teknisi IT']),
            'no_hp' => $this->faker->phoneNumber(),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Hindu', 'Budha']),
            'status_perkawinan' => $this->faker->randomElement(['Menikah', 'Belum Menikah', 'cerai']),
            'kelurahan' => $this->faker->city(),
            'kecamatan' => $this->faker->city(),
            'kabupatenKota' => $this->faker->city(),
            'provinsi' => $this->faker->city(),
            'alamat' => $this->faker->address(),
            'foto' => $this->faker->imageUrl('200', '200', 'people'),
            'id_user' => $this->faker->numberBetween(1, 10),

        ];
    }
}
