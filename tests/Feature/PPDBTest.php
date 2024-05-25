<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PPDBTest extends TestCase
{
    // use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * A basic feature test example.
     */
    public function test_RoutePpdbPosisiBenar(): void
    {
        $response = $this->get('/ppdb');

        $response->assertStatus(200);
    }

    public function test_StorePesertaDidikBaru(): void
    {

        $response = $this->get('/ppdb');

        $response->assertStatus(200);

        $file = UploadedFile::fake()->image('photo1.jpg');

        $data = [
            'nisn' => null,
            'nama' => $this->faker->name(),
            'kelas' => '1',
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'kelurahan' => 'Cimanggis',
            'kecamatan' => 'Cimanggis',
            'kabupaten_kota' => 'Jakarta Barat',
            'provinsi' => 'DKI Jakarta',
            'alamat' => 'Jl. Cimanggis No. 1',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'photo' => $file,
            'nik' => '123456789',
            'nama_ortu' => 'doeee',
            'hubungan' => 'Orang Tua Kandung',
            'jenis_kelamin_ortu' => 'Laki-laki',
            'agama_ortu' => 'Islam',
            'no_hp_ortu' => '121312312',
            'kelurahan_ortu' => 'Cimanggis',
            'kecamatan_ortu' => 'Cimanggis',
            'kabupaten_kota_ortu' => 'Jakarta Barat',
            'provinsi_ortu' => 'DKI Jakarta',
            'email_ortu' => $this->faker->email(),
            'pekerjaan_ortu' => 'PNS',
            'alamat_ortu' => 'Jl. Cimanggis No. 1',
            'status_ppdb' => false,

        ];

        $response = $this->post('/ppdb', $data, ['Content-Type' => 'multipart/form-data', 'X-CSRF-TOKEN' => csrf_token()]);

        $response->assertStatus(302);
    }

    public function test_store_StorePesertaDidikPindahan(): void
    {

        $response = $this->get('/ppdb');

        $response->assertStatus(200);

        $file = UploadedFile::fake()->image('photo1.jpg');

        $data = [
            'nisn' => $this->faker->randomNumber(),
            'nama' => $this->faker->name(),
            'kelas' => $this->faker->numberBetween(2, 9),
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'kelurahan' => 'Cimanggis',
            'kecamatan' => 'Cimanggis',
            'kabupaten_kota' => 'Jakarta Barat',
            'provinsi' => 'DKI Jakarta',
            'alamat' => 'Jl. Cimanggis No. 1',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'photo' => $file,
            'nik' => '123456789',
            'nama_ortu' => 'doeee',
            'hubungan' => 'Orang Tua Kandung',
            'jenis_kelamin_ortu' => 'Laki-laki',
            'agama_ortu' => 'Islam',
            'no_hp_ortu' => '121312312',
            'kelurahan_ortu' => 'Cimanggis',
            'kecamatan_ortu' => 'Cimanggis',
            'kabupaten_kota_ortu' => 'Jakarta Barat',
            'provinsi_ortu' => 'DKI Jakarta',
            'email_ortu' => $this->faker->email(),
            'pekerjaan_ortu' => 'PNS',
            'alamat_ortu' => 'Jl. Cimanggis No. 1',
            'status_ppdb' => false,

        ];

        $response = $this->post('/ppdb', $data, ['Content-Type' => 'multipart/form-data', 'X-CSRF-TOKEN' => csrf_token()]);

        $response->assertStatus(302);
    }

    public function test_StorePesertaDidikBaruTanpaFoto(): void
    {

        $response = $this->get('/ppdb');

        $response->assertStatus(200);

        $file = null;

        $data = [
            'nisn' => null,
            'nama' => $this->faker->name(),
            'kelas' => '1',
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'kelurahan' => 'Cimanggis',
            'kecamatan' => 'Cimanggis',
            'kabupaten_kota' => 'Jakarta Barat',
            'provinsi' => 'DKI Jakarta',
            'alamat' => 'Jl. Cimanggis No. 1',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'photo' => $file,
            'nik' => '123456789',
            'nama_ortu' => 'doeee',
            'hubungan' => 'Orang Tua Kandung',
            'jenis_kelamin_ortu' => 'Laki-laki',
            'agama_ortu' => 'Islam',
            'no_hp_ortu' => '121312312',
            'kelurahan_ortu' => 'Cimanggis',
            'kecamatan_ortu' => 'Cimanggis',
            'kabupaten_kota_ortu' => 'Jakarta Barat',
            'provinsi_ortu' => 'DKI Jakarta',
            'email_ortu' => $this->faker->email(),
            'pekerjaan_ortu' => 'PNS',
            'alamat_ortu' => 'Jl. Cimanggis No. 1',
            'status_ppdb' => false,

        ];

        $response = $this->post('/ppdb', $data, ['Content-Type' => 'multipart/form-data', 'X-CSRF-TOKEN' => csrf_token()]);

        $response->assertStatus(302);
    }

    public function test_StorePesertaDidikPindahanTanpaFoto(): void
    {
        $response = $this->get('/ppdb');

        $response->assertStatus(200);

        $file = null;

        $data = [
            'nisn' => $this->faker->randomNumber(),
            'nama' => $this->faker->name(),
            'kelas' => $this->faker->numberBetween(2, 9),
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'kelurahan' => 'Cimanggis',
            'kecamatan' => 'Cimanggis',
            'kabupaten_kota' => 'Jakarta Barat',
            'provinsi' => 'DKI Jakarta',
            'alamat' => 'Jl. Cimanggis No. 1',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'photo' => $file,
            'nik' => '123456789',
            'nama_ortu' => 'doeee',
            'hubungan' => 'Orang Tua Kandung',
            'jenis_kelamin_ortu' => 'Laki-laki',
            'agama_ortu' => 'Islam',
            'no_hp_ortu' => '121312312',
            'kelurahan_ortu' => 'Cimanggis',
            'kecamatan_ortu' => 'Cimanggis',
            'kabupaten_kota_ortu' => 'Jakarta Barat',
            'provinsi_ortu' => 'DKI Jakarta',
            'email_ortu' => $this->faker->email(),
            'pekerjaan_ortu' => 'PNS',
            'alamat_ortu' => 'Jl. Cimanggis No. 1',
            'status_ppdb' => false,

        ];

        $response = $this->post('/ppdb', $data, ['Content-Type' => 'multipart/form-data', 'X-CSRF-TOKEN' => csrf_token()]);

        $response->assertStatus(302);
    }

    public function test_storeCekJikaNisnNullDanKelasAda(): void
    {
        $response = $this->get('/ppdb');

        $response->assertStatus(200);

        $file = UploadedFile::fake()->image('photo1.jpg');

        $data = [
            'nisn' => null,
            'nama' => $this->faker->name(),
            'kelas' => $this->faker->numberBetween(2, 9),
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'kelurahan' => 'Cimanggis',
            'kecamatan' => 'Cimanggis',
            'kabupaten_kota' => 'Jakarta Barat',
            'provinsi' => 'DKI Jakarta',
            'alamat' => 'Jl. Cimanggis No. 1',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'photo' => $file,
            'nik' => '123456789',
            'nama_ortu' => 'doeee',
            'hubungan' => 'Orang Tua Kandung',
            'jenis_kelamin_ortu' => 'Laki-laki',
            'agama_ortu' => 'Islam',
            'no_hp_ortu' => '121312312',
            'kelurahan_ortu' => 'Cimanggis',
            'kecamatan_ortu' => 'Cimanggis',
            'kabupaten_kota_ortu' => 'Jakarta Barat',
            'provinsi_ortu' => 'DKI Jakarta',
            'email_ortu' => $this->faker->email(),
            'pekerjaan_ortu' => 'PNS',
            'alamat_ortu' => 'Jl. Cimanggis No. 1',
            'status_ppdb' => false,

        ];

        $response = $this->post('/ppdb', $data, ['Content-Type' => 'multipart/form-data', 'X-CSRF-TOKEN' => csrf_token()]);

        $response->assertStatus(302);
    }

    public function test_storeCekJikaNisnAdaDanKelas1(): void
    {
        $response = $this->get('/ppdb');

        $response->assertStatus(200);

        $file = UploadedFile::fake()->image('photo1.jpg');

        $data = [
            'nisn' => null,
            'nama' => $this->faker->name(),
            'kelas' => $this->faker->numberBetween(2, 9),
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'kelurahan' => 'Cimanggis',
            'kecamatan' => 'Cimanggis',
            'kabupaten_kota' => 'Jakarta Barat',
            'provinsi' => 'DKI Jakarta',
            'alamat' => 'Jl. Cimanggis No. 1',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'photo' => $file,
            'nik' => '123456789',
            'nama_ortu' => 'doeee',
            'hubungan' => 'Orang Tua Kandung',
            'jenis_kelamin_ortu' => 'Laki-laki',
            'agama_ortu' => 'Islam',
            'no_hp_ortu' => '121312312',
            'kelurahan_ortu' => 'Cimanggis',
            'kecamatan_ortu' => 'Cimanggis',
            'kabupaten_kota_ortu' => 'Jakarta Barat',
            'provinsi_ortu' => 'DKI Jakarta',
            'email_ortu' => $this->faker->email(),
            'pekerjaan_ortu' => 'PNS',
            'alamat_ortu' => 'Jl. Cimanggis No. 1',
            'status_ppdb' => false,

        ];

        $response = $this->post('/ppdb', $data, ['Content-Type' => 'multipart/form-data', 'X-CSRF-TOKEN' => csrf_token()]);

        $response->assertStatus(302);
    }
}
