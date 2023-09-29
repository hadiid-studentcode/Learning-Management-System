<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pertemuan>
 */
class PertemuanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [

            'pertemuan_ke' => fake()->randomElement([1, 2, 3, 4, 5]),
            'id_mapel' => fake()->randomElement([1, 2, 3, 4, 5]),
            'nama_materi' => null,
            'deskripsi_materi' => null,
            'file_materi' => null,
            'tanggal_materi' => null,
            'link_materi' => null,
            'nama_tugas' => null,
            'deskripsi_tugas' => null,
            'file_tugas' => null,
            'tanggal_tugas' => null,
        ];
    }
}
