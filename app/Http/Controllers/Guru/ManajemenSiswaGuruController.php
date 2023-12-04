<?php

namespace App\Http\Controllers\Guru;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use App\Models\WaliMurid;
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
                'wali_murid.nik as walimurid_nik',
                'wali_murid.nama as walimurid_nama',
                'wali_murid.hubungan as walimurid_hubungan',
                'wali_murid.agama as walimurid_agama',
                'wali_murid.jenis_kelamin as walimurid_jenis_kelamin',
                'wali_murid.no_hp as walimurid_no_hp',
                'wali_murid.kelurahan as walimurid_kelurahan',
                'wali_murid.kecamatan as walimurid_kecamatan',
                'wali_murid.kabupatenKota as walimurid_kabupatenKota',
                'wali_murid.provinsi as walimurid_provinsi',
                'wali_murid.email as walimurid_email',
                'wali_murid.pekerjaan as walimurid_pekerjaan',
                'wali_murid.alamat as walimurid_alamat',
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
            ->with('id_kelas', $kelasFirst->id)
            ->with('jenisGuru', $this->jenisGuru())

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
        $request->validate([
            'foto' => 'mimes:jpeg,png,jpg|max:5000',
        ]);

        try {
            if ($request->hasFile('foto')) {
                $foto = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $request->file('foto')->getClientOriginalName());

                // simpan akun user siswa
                $dataUser = [
                    'nama_lengkap' => ucwords($request->nama),
                    'email' => null,
                    'userid' => $request->nisn,
                    'password' => bcrypt($request->nisn),
                    'foto' => $foto,
                    'hak_akses' => 'Siswa',
                ];

                // simpan user dengan role siswa
                $result = new User();
                $result->saveUsers($dataUser);

                // panggil ide user yang terakhir

                $id = $result->lastIdUser();

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
                    'id_user' => $id,
                ];

                // simpan data siswa
                $result = new Siswa();
                $result->saveSiswa($dataSiswa);

                // simpan foto siswa
                $result->uploadFotoSiswa($request->file('foto'), $foto, $id);

                // data wali murid

                $dataUserWaliMurid = [
                    'nama_lengkap' => $request->nama_ortu,
                    'email' => null,
                    'userid' => $request->nama_ortu,
                    'password' => bcrypt($request->nama_ortu),
                    'foto' => null,
                    'hak_akses' => 'Wali Murid',
                ];

                // simpan user wali murid
                $result = new User();
                $result->saveUsers($dataUserWaliMurid);

                // panggil id user yang terakhir

                $id_waliMurid = $result->lastIdUser();

                // panggil id siswa yang terakhir
                $resultSiswa = new Siswa();
                $id_siswa = $resultSiswa->lastIdSiswa();

                $dataWaliMurid = [
                    'nik' => $request->nik,
                    'nama' => $request->nama_ortu,
                    'hubungan' => ucwords($request->hubungan),
                    'jenis_kelamin' => $request->jenis_kelamin_ortu,
                    'agama' => ucwords($request->agama_ortu),
                    'no_hp' => $request->no_hp_ortu,
                    'kelurahan' => ucwords($request->kelurahan_ortu),
                    'kecamatan' => ucwords($request->kecamatan_ortu),
                    'kabupatenKota' => ucwords($request->kabupaten_kota_ortu),
                    'provinsi' => ucwords($request->provinsi_ortu),
                    'email' => $request->email_ortu,
                    'pekerjaan' => ucwords($request->pekerjaan_ortu),
                    'alamat' => ucwords($request->alamat_ortu),
                    'id_siswa' => $id_siswa,
                    'id_user' => $id_waliMurid,
                ];

                // save data wali murid
                $result = new WaliMurid();
                $result->saveWaliMurid($dataWaliMurid);

                return redirect('/guru/manajemen-siswa')->with('success', 'Data berhasil disimpan');
            } elseif ($request->hasFile('foto') == false) {
                // sumpan akun user siswa

                // simpan akun user siswa
                $dataUser = [
                    'nama_lengkap' => ucwords($request->nama),
                    'email' => null,
                    'userid' => $request->nisn,
                    'password' => bcrypt($request->nisn),
                    'foto' => null,
                    'hak_akses' => 'Siswa',
                ];

                // simpan user dengan role siswa
                $result = new User();
                $result->saveUsers($dataUser);

                // panggil ide user yang terakhir

                $id = $result->lastIdUser();

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
                    'foto' => null,
                    'id_user' => $id,
                ];

                // simpan data siswa
                $result = new Siswa();
                $result->saveSiswa($dataSiswa);

                // data wali murid

                $dataUserWaliMurid = [
                    'nama_lengkap' => $request->nama_ortu,
                    'email' => $request->email_ortu,
                    'userid' => $request->nama_ortu,
                    'password' => bcrypt($request->nama_ortu),
                    'foto' => null,
                    'hak_akses' => 'Wali Murid',
                ];

                // simpan user wali murid
                $result = new User();
                $result->saveUsers($dataUserWaliMurid);

                // panggil id user yang terakhir

                $id_waliMurid = $result->lastIdUser();

                // panggil id siswa yang terakhir
                $resultSiswa = new Siswa();
                $id_siswa = $resultSiswa->lastIdSiswa();

                $dataWaliMurid = [
                    'nik' => $request->nik,
                    'nama' => $request->nama_ortu,
                    'hubungan' => ucwords($request->hubungan),
                    'jenis_kelamin' => $request->jenis_kelamin_ortu,
                    'agama' => ucwords($request->agama),
                    'no_hp' => $request->no_hp_ortu,
                    'kelurahan' => ucwords($request->kelurahan_ortu),
                    'kecamatan' => ucwords($request->kecamatan_ortu),
                    'kabupatenKota' => ucwords($request->kabupaten_kota_ortu),
                    'provinsi' => ucwords($request->provinsi_ortu),
                    'email' => $request->email_ortu,
                    'pekerjaan' => ucwords($request->pekerjaan_ortu),
                    'alamat' => ucwords($request->alamat_ortu),
                    'id_siswa' => $id_siswa,
                    'id_user' => $id_waliMurid,
                ];

                // save data wali murid
                $result = new WaliMurid();
                $result->saveWaliMurid($dataWaliMurid);

                return redirect('/guru/manajemen-siswa')->with('success', 'Data berhasil disimpan');
            } else {
                return back()
                    ->with('warning', 'Data Siswa Gagal Disimpan');
            }
        } catch (\Exception $e) {

            return back()->with('warning', 'Terjadi Kesalahan');
        }
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

        $request->validate([

            'foto' => 'mimes:jpg,jpeg,png|max:5000',
        ]);

        if ($request->hasfile('foto')) {

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

            // panggil foto di database
            $result = new Siswa();
            $result->uploadFotoSiswa($request->file('foto'), $foto, $id);

            //    save user siswa
            $dataUserSiswa = [
                'nama_lengkap' => ucwords($request->nama),
                'userid' => $request->nisn,
                'foto' => $foto,
            ];

            // panggil user_id siswa
            $result = new Siswa();
            $user_id = $result->getUserIdSiswa($id);

            // update user
            $result = new User();
            $result->updateUser($user_id->id_user, $dataUserSiswa);

            // simpan siswa ke database
            $resultSiswa = new Siswa();
            $resultSiswa->updateSiswa($id, $dataSiswa);

            // get id user wali murid
            $resultWaliMurid = new WaliMurid();
            $waliMurid = $resultWaliMurid->getIdUserWhereIdSiswa($id);

            // data wali murid

            $dataUserWaliMurid = [
                'nama_lengkap' => $request->nama_ortu,
                'email' => $request->email_ortu,
            ];

            // simpan user wali murid
            $result = new User();
            $result->updateUser($waliMurid->id_user, $dataUserWaliMurid);

            $dataWaliMurid = [
                'nik' => $request->nik,
                'nama' => ucwords($request->nama_ortu),
                'hubungan' => ucwords($request->hubungan_ortu),
                'jenis_kelamin' => $request->jenis_kelamin_ortu,
                'agama' => ucwords($request->agama_ortu),
                'no_hp' => $request->no_hp_ortu,
                'kelurahan' => ucwords($request->kelurahan_ortu),
                'kecamatan' => ucwords($request->kecamatan_ortu),
                'kabupatenKota' => ucwords($request->kabupaten_kota_ortu),
                'provinsi' => ucwords($request->provinsi_ortu),
                'email' => $request->email_ortu,
                'pekerjaan' => ucwords($request->pekerjaan_ortu),
                'alamat' => ucwords($request->alamat_ortu),
            ];

            // save data wali murid
            $result = new WaliMurid();
            $result->updateWaliMurid($dataWaliMurid, $waliMurid->id_user);

            return redirect('/guru/manajemen-siswa');
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
            $result = new Siswa();
            $result->updateSiswa($id, $data);

            //    save user siswa

            $dataUserSiswa = [
                'nama_lengkap' => ucwords($request->nama),
                'email' => null,
                'userid' => $request->nisn,
                'password' => null,
                'foto' => null,
                'hak_akses' => 'Siswa',
            ];

            // panggil user_id siswa
            $result = new Siswa();
            $user_id = $result->getUserIdSiswa($id);

            // update user
            $result = new User();
            $result->updateUser($user_id->id_user, $dataUserSiswa);

            // get id user wali murid
            $resultWaliMurid = new WaliMurid();
            $waliMurid = $resultWaliMurid->getIdUserWhereIdSiswa($id);

            // data wali murid

            $dataUserWaliMurid = [
                'nama_lengkap' => $request->nama_ortu,
                'email' => $request->email_ortu,
            ];

            // simpan user wali murid
            $result = new User();
            $result->updateUser($waliMurid->id_user, $dataUserWaliMurid);

            $dataWaliMurid = [
                'nik' => $request->nik,
                'nama' => ucwords($request->nama_ortu),
                'hubungan' => ucwords($request->hubungan_ortu),
                'jenis_kelamin' => $request->jenis_kelamin_ortu,
                'agama' => ucwords($request->agama_ortu),
                'no_hp' => $request->no_hp_ortu,
                'kelurahan' => ucwords($request->kelurahan_ortu),
                'kecamatan' => ucwords($request->kecamatan_ortu),
                'kabupatenKota' => ucwords($request->kabupaten_kota_ortu),
                'provinsi' => ucwords($request->provinsi_ortu),
                'email' => $request->email_ortu,
                'pekerjaan' => ucwords($request->pekerjaan_ortu),
                'alamat' => ucwords($request->alamat_ortu),
            ];

            // save data wali murid
            $result = new WaliMurid();
            $result->updateWaliMurid($dataWaliMurid, $waliMurid->id_user);

            return redirect('/guru/manajemen-siswa');
        } else {
            return back()
                ->with('warning', 'Data Siswa Gagal Disimpan');
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
