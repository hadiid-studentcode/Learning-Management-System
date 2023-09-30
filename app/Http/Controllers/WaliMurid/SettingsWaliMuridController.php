<?php

namespace App\Http\Controllers\WaliMurid;

use App\Models\Siswa;
use App\Models\User;
use App\Models\WaliMurid;
use Illuminate\Http\Request;

class SettingsWaliMuridController extends WaliMuridController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->title = 'Settings';
        $id = auth()->user()->id;
        // data siswa
        $result = new WaliMurid();
        $siswa = $result->getSiswa($id);
        if ($siswa == null) {
            $siswa = $result->firstSiswa($id);
        }
        // data wali murid
        $waliMurid = $result->getWaliMurid($id);

        $this->img = $this->imageHeader();

        return view('waliMurid.setting.index')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('siswa', $siswa)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('waliMurid', $waliMurid);
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

        $id_user = auth()->user()->id;

        $data = [
            'nama' => $request->input('nama'),
            'hubungan' => $request->input('hubungan'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'no_hp' => $request->input('nohp'),
            'kelurahan' => $request->input('kelurahan'),
            'kecamatan' => $request->input('kecamatan'),
            'kabupatenKota' => $request->input('kabupatenKota'),
            'provinsi' => $request->input('provinsi'),
            'alamat' => $request->input('alamat'),
            'email' => $request->input('email'),
            'pekerjaan' => $request->input('pekerjaan'),
            'alamat' => $request->input('alamat'),
        ];
        $result = new WaliMurid();
        $result->UpdateWaliMurid($data, $id_user);

        return redirect('/wali-murid/setting');

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateSiswa(Request $request, string $nisn)
    {

        $request->validate([

            'foto' => 'mimes:jpg,jpeg,png|max:5000',
        ]);

        if ($request->hasfile('foto')) {

            $foto = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $request->file('foto')->getClientOriginalName());

            $data = [
                'nama' => $request->input('nama'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'agama' => $request->input('agama'),
                'kelurahan' => $request->input('kelurahan'),
                'kecamatan' => $request->input('kecamatan'),
                'kabupatenKota' => $request->input('kabupatenKota'),
                'provinsi' => $request->input('provinsi'),
                'alamat' => $request->input('alamat'),
                'foto' => $foto,
            ];

            $result = new Siswa();

            $result->uploadFotoSiswa($request->file('foto'), $foto, $nisn);

            // simpan siswa ke database

            $result->updateSiswa($nisn, $data);

            // ubah nama lengkap di tabel user
            $dataUsers = [
                'nama_lengkap' => $request->input('nama'),
                'foto' => $foto,
            ];
            $resultUsers = new User();
            $resultUsers->updateUserNameandfotoSiswa($nisn, $dataUsers);

            return redirect('/wali-murid/setting');
        } elseif ($request->hasfile('foto') == false) {

            $data = [
                'nama' => $request->input('nama'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'agama' => $request->input('agama'),
                'kelurahan' => $request->input('kelurahan'),
                'kecamatan' => $request->input('kecamatan'),
                'kabupatenKota' => $request->input('kabupatenKota'),
                'provinsi' => $request->input('provinsi'),
                'alamat' => $request->input('alamat'),
            ];

            // simpan siswa ke database
            $result = new Siswa();
            $result->updateSiswa($nisn, $data);
            // ubah nama lengkap di tabel user
            $dataUsers = [
                'nama_lengkap' => $request->input('nama'),
            ];
            $resultUsers = new User();
            $resultUsers->updateUserNameandfotoSiswa($nisn, $dataUsers);

            return redirect('/wali-murid/setting');
        } else {
            return back()
                ->with('warning', 'Data Gagal Disimpan');
        }
    }
}
