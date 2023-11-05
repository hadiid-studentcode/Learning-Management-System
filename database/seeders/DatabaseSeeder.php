<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\TahunAjaran::factory()->create([
        //     'tahun_ajaran' => '2023-2024',

        // ]);

        \App\Models\User::factory()->create([           // 16
            'nama_lengkap' => 'admin',
            'email' => null,
            'userid' => 'admin',
            'password' => bcrypt('admin'),
            'foto' => null,
            'hak_akses' => 'Super User',
            'remember_token' => Str::random(10),
        ]);

        \App\Models\User::factory()->create([       // 15
            'nama_lengkap' => 'admin tatausaha',
            'email' => fake()->unique()->safeEmail(),
            'userid' => 'admintu',
            'password' => bcrypt('admintu'),
            'foto' => null,
            'hak_akses' => 'Tata Usaha',
            'remember_token' => Str::random(10),
        ]);

        \App\Models\Pegawai::factory()->create([
            'nik' => fake()->numerify('##########'),
            'nama' => 'admin',
            'jenis' => 'admin',
            'no_hp' => fake()->phoneNumber(),
            'tempat_lahir' => fake()->city(),
            'tanggal_lahir' => fake()->date(),
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'status_perkawinan' => 'Belum Menikah',
            'kelurahan' => fake()->city(),
            'kecamatan' => fake()->city(),
            'kabupatenKota' => fake()->city(),
            'provinsi' => fake()->city(),
            'alamat' => fake()->address(),
            'foto' => null,
            'id_user' => 2, //15
        ]);

        // \App\Models\User::factory()->create([       // 13
        //     'nama_lengkap' => 'Hadiid Andri Yulison',
        //     'email' => fake()->unique()->safeEmail(),
        //     'userid' => '12345',
        //     'password' => bcrypt('12345'),
        //     'foto' => fake()->imageUrl('200', '200', 'people'),
        //     'hak_akses' => 'Guru',
        //     'remember_token' => Str::random(10),
        // ]);

        // \App\Models\Guru::factory()->create([
        //     'nik' => fake()->numerify('##########'),
        //     'nama' => 'Hadiid Andri Yulison',
        //     'nbm' => '12345',
        //     'status' => 'Tetap',
        //     'jenis' => 'Wali Kelas',
        //     'bidang_studi' => 'fisika',
        //     'jenis_kelamin' => 'laki-laki',
        //     'nohp' => fake()->phoneNumber(),
        //     'tempat_lahir' => fake()->city(),
        //     'tanggal_lahir' => fake()->date(),
        //     'agama' => 'islam',
        //     'kelurahan' => fake()->city(),
        //     'kecamatan' => fake()->city(),
        //     'kabupatenKota' => fake()->city(),
        //     'provinsi' => fake()->city(),
        //     'alamat' => fake()->address(),
        //     'foto' => '1686726289999-arief.jpg',
        //     'id_user' => 3,

        // ]);

        // \App\Models\Kelas::factory()->create([
        //     'nama' => '4',
        //     'rombel' => 'ibrahim',
        //     'id_guru' => 1,
        //     'kouta_siswa' => 30,
        //     'id_tahun_ajaran' => 1,

        // ]);

        // \App\Models\User::factory()->create([           // 14
        //     'nama_lengkap' => 'Andriy Hadiid',
        //     'email' => fake()->unique()->safeEmail(),
        //     'userid' => '121212',
        //     'password' => bcrypt('121212'),
        //     'foto' => fake()->imageUrl('200', '200', 'people'),
        //     'hak_akses' => 'Siswa',
        //     'remember_token' => Str::random(10),
        // ]);

        // \App\Models\Siswa::factory()->create([  // 11
        //     'nisn' => '121212',
        //     'nama' => 'Andriy Hadiid',
        //     'id_kelas' => 1,
        //     'jenis_kelamin' => 'laki-laki',
        //     'agama' => 'Islam',
        //     'kelurahan' => fake()->city(),
        //     'kecamatan' => fake()->city(),
        //     'kabupatenKota' => fake()->city(),
        //     'provinsi' => fake()->city(),
        //     'alamat' => fake()->address(),
        //     'tempat_lahir' => fake()->city(),
        //     'tanggal_lahir' => fake()->date(),
        //     'foto' => '1686726289999-arief.jpg',
        //     'id_user' => 4,

        // ]);

        // \App\Models\User::factory()->create([       // 12
        //     'nama_lengkap' => 'Wahyu Ardian',
        //     'email' => fake()->unique()->safeEmail(),
        //     'userid' => 'wahyu ardian',
        //     'password' => bcrypt('wahyu ardian'),
        //     'foto' => fake()->imageUrl('200', '200', 'people'),
        //     'hak_akses' => 'Wali Murid',
        //     'remember_token' => Str::random(10),
        // ]);

        // \App\Models\WaliMurid::factory()->create([
        //     'nik' => fake()->numerify('##########'),
        //     'nama' => 'Wahyu Ardian',
        //     'hubungan' => 'Saudara',
        //     'jenis_kelamin' => 'Laki-laki',
        //     'agama' => 'Islam',
        //     'no_hp' => fake()->phoneNumber(),
        //     'kelurahan' => fake()->streetName(),
        //     'kecamatan' => fake()->streetName(),
        //     'kabupatenKota' => fake()->city(),
        //     'provinsi' => fake()->city(),
        //     'email' => null,
        //     'pekerjaan' => fake()->jobTitle(),
        //     'alamat' => fake()->address(),
        //     'id_siswa' => 1,
        //     'id_user' => 5,
        // ]);

        // \App\Models\User::factory()->create([           // 11
        //     'nama_lengkap' => 'Arief Widi Pratama',
        //     'email' => fake()->unique()->safeEmail(),
        //     'userid' => 'arief widi pratama',
        //     'password' => bcrypt('arief widi pratama'),
        //     'foto' => fake()->imageUrl(),
        //     'hak_akses' => 'Pegawai',
        //     'remember_token' => Str::random(10),
        // ]);

        // \App\Models\Pegawai::factory()->create([
        //     'nik' => fake()->numerify('##########'),
        //     'nama' => 'Arief Widi Pratama',
        //     'jenis' => 'Satpam',
        //     'no_hp' => fake()->phoneNumber(),
        //     'tempat_lahir' => fake()->city(),
        //     'tanggal_lahir' => fake()->date(),
        //     'jenis_kelamin' => 'Laki-laki',
        //     'agama' => 'Islam',
        //     'status_perkawinan' => 'Belum Menikah',
        //     'kelurahan' => fake()->city(),
        //     'kecamatan' => fake()->city(),
        //     'kabupatenKota' => fake()->city(),
        //     'provinsi' => fake()->city(),
        //     'alamat' => fake()->address(),
        //     'foto' => '1686726289999-arief.jpg',
        //     'id_user' => 11,
        // ]);

        // \App\Models\Mapel::factory(5)->create();
        // \App\Models\Pertemuan::factory(500)->create();
        // \App\Models\TahunAjaran::factory()->create([

        //     'tahun_ajaran' => '2024/2025',

        // ]);

        \App\Models\JenisPembayaran::factory()->create([
            'jenis' => 'UANG MAKAN',
            'nominal' => 10000,

        ]);
        \App\Models\JenisPembayaran::factory()->create([
            'jenis' => 'SNACK',
            'nominal' => 7000,

        ]);
        \App\Models\JenisPembayaran::factory()->create([
            'jenis' => 'EKSKUL',
            'nominal' => 15000,

        ]);
        \App\Models\JenisPembayaran::factory()->create([
            'jenis' => 'SPP KELAS 1',
            'nominal' => 200000,

        ]);
        \App\Models\JenisPembayaran::factory()->create([
            'jenis' => 'SPP KELAS 2',
            'nominal' => 150000,

        ]);
        \App\Models\JenisPembayaran::factory()->create([
            'jenis' => 'SPP KELAS 3',
            'nominal' => 150000,

        ]);
        \App\Models\JenisPembayaran::factory()->create([
            'jenis' => 'SPP KELAS 4',
            'nominal' => 150000,

        ]);
        \App\Models\JenisPembayaran::factory()->create([
            'jenis' => 'SPP KELAS 5',
            'nominal' => 150000,

        ]);
        \App\Models\JenisPembayaran::factory()->create([
            'jenis' => 'SPP KELAS 6',
            'nominal' => 150000,

        ]);
        \App\Models\JenisPembayaran::factory()->create([
            'jenis' => 'UJIAN',
            'nominal' => 60000,

        ]);

        // \App\Models\User::factory(54)->create();
        // \App\Models\Pegawai::factory(5)->create();
        // \App\Models\Guru::factory(50)->create();
        // \App\Models\Kelas::factory(50)->create();
        // \App\Models\Siswa::factory(2)->create();
        // \App\Models\WaliMurid::factory(2)->create();
        // \App\Models\Gallery::factory(50)->create();
        // \App\Models\Mapel::factory(50)->create();
    }
}
