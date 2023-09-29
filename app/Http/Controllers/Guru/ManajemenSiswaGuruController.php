<?php

namespace App\Http\Controllers\Guru;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class ManajemenSiswaGuruController extends GuruController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->img = $this->imageHeader();

        $resultSiswa = new Siswa();
        $siswa = $resultSiswa->getSiswaWhereIdUserGuru(
            [
                'siswa.id',
                'siswa.nama',
                'siswa.nisn',
                'siswa.id_kelas',
                'kelas.nama as kelas',
                'kelas.rombel',
                'siswa.jenis_kelamin',
                'siswa.agama',
                'siswa.tanggal_lahir',
                'siswa.kabupatenKota',
                'siswa.tempat_lahir',
                'siswa.kelurahan',
                'siswa.kecamatan',
                'siswa.provinsi',
                'siswa.alamat',
                'siswa.foto',
            ],

            Auth()->user()->id
        );

        $resultKelas = new Kelas();
        $kelasFirst = $resultKelas->firstKelasAndRombelWhereIdUserGuru(Auth()->user()->id);

        $getkelas = $resultKelas->getKelasAll(['kelas.id', 'kelas.nama', 'kelas.rombel']);

        return view('guru.manajemen-siswa.index')
            ->with('title', $this->title = 'Manajemen Siswa')
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('getKelas', $getkelas)
            ->with('siswa', $siswa)
            ->with('kelas', $kelasFirst->kelas)
            ->with('rombel', $kelasFirst->rombel)
            ->with('jenis', $this->jenisGuru())

            ->with('folder', $this->folder);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $resultSiswa = new Siswa();
        $resultUser = new User();

        $request->validate([
            'foto' => 'mimes:jpg,jpeg,png|max:5000',
        ]);

        if ($request->hasFile('foto')) {
            $foto = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $request->file('foto')->getClientOriginalName());

            $dataSiswa = [
                'nisn' => $request->nisn,
                'nama' => ucwords($request->nama),
                'id_kelas' => $request->id_kelas,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => ucwords($request->agama),
                'kelurahan' => ucwords($request->kelurahan),
                'kecamatan' => ucwords($request->kecamatan),
                'kabupatenKota' => ucwords($request->kabupaten_kota),
                'provinsi' => ucwords($request->provinsi),
                'alamat' => ucwords($request->alamat),
                'tempat_lahir' => ucwords($request->tempat_lahir),
                'tanggal_lahir' => $request->tanggal_lahir,
                'foto' => $foto,

            ];

            // save foto
            $resultSiswa->uploadFotoSiswa($request->file('foto'), $foto, $id);

            // save user siswa

            $dataUserSiswa = [
                'nama_lengkap' => ucwords($request->nama),
                'userid' => $request->nisn,
                'foto' => $foto,
            ];

            // panggil user_id siswa
            $user_id = $resultSiswa->getUserIdSiswa($id);
            // update user
            $resultUser->updateUser($user_id->id_user, $dataUserSiswa);

            // simpan siswa ke database
            $resultSiswa->updateSiswa($id, $dataSiswa);

            return back()->with('success', 'Data siswa berhasil diubah');
        } elseif ($request->hasfile('foto') == false) {
            $data = [
                'nisn' => $request->nisn,
                'nama' => ucwords($request->nama),
                'id_kelas' => $request->id_kelas,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => ucwords($request->agama),
                'kelurahan' => ucwords($request->kelurahan),
                'kecamatan' => ucwords($request->kecamatan),
                'kabupatenKota' => ucwords($request->kabupaten_kota),
                'provinsi' => ucwords($request->provinsi),
                'alamat' => ucwords($request->alamat),
                'tempat_lahir' => ucwords($request->tempat_lahir),
                'tanggal_lahir' => $request->tanggal_lahir,

            ];

            // simpan siswa ke database
            $resultSiswa->updateSiswa($id, $data);

            // save user siswa
            $dataUserSiswa = [
                'nama_lengkap' => ucwords($request->nama),
                'email' => null,
                'userid' => $request->nisn,
                'password' => null,
                'foto' => null,
                'hak_akses' => 'Siswa',
            ];

            // panggil user_id siswa
            $user_id = $resultSiswa->getUserIdSiswa($id);
            // update user
            $resultUser->updateUser($user_id->id_user, $dataUserSiswa);

            return back()->with('success', 'Data siswa berhasil diubah');

        } else {
            return back()->with('error', 'Data siswa gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
