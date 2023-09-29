<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mapel>
 */
class MapelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode' => fake()->uuid(),
            'nama' => fake()->randomElement(['Bahasa Indonesia', 'Matematika', 'Ilmu Pengetahuan Alam', 'Ilmu Pengetahuan Sosial', 'Pendidikan Pancasila dan Kewarganegaraan', 'Bahasa Inggris']),
            'hari' => fake()->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']),
            'waktu_mulai' => fake()->time(),
            'waktu_selesai' => fake()->time(),
            'id_guru' => fake()->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31]),
            'id_kelas' => fake()->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
            'id_tahun_ajaran' => 1,
        ];
    }
}
