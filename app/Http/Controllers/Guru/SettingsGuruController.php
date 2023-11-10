<?php

namespace App\Http\Controllers\Guru;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;

class SettingsGuruController extends GuruController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->img = $this->imageHeader();

        // panggil fungsi hai di gurucontrooler

        $this->title = 'Settings';
        $id = auth()->user()->id;

        $nama = auth()->user()->nama_lengkap;
        $email = auth()->user()->email;

        $result = new Guru();
        $getGuruFirst = $result->getGuruFirst(['*'], $id);

        $string = $getGuruFirst->foto;
        $parts = explode('-', $string);
        $filename = end($parts);

        $result = new User();
        $getGuruUser = $result->viewDataFirst(['id', 'email', 'userid'], $id);

        return view('guru.setting.index')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('namaUser', $nama)
            ->with('emailUser', $email)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('filename', $filename)
            ->with('guru', $getGuruFirst)
            ->with('jenisGuru', $this->jenisGuru())
            ->with('guruUser', $getGuruUser);

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $result = new Guru();
        $resultUsers = new User();
        $idUser = auth()->user()->id;

        $request->validate([

            'foto' => 'mimes:jpg,jpeg,png|max:5000',
        ]);

        if ($request->hasfile('foto')) {

            $foto = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $request->file('foto')->getClientOriginalName());
            $data = [
                'nama' => ucwords($request->input('nama')),
                'agama' => $request->input('agama'),
                'nohp' => $request->input('nohp'),
                'tempat_lahir' => ucwords($request->input('tempatlahir')),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'status_perkawinan' => $request->input('status_perkawinan'),
                'kelurahan' => ucwords($request->input('kelurahan')),
                'kecamatan' => ucwords($request->input('kecamatan')),
                'provinsi' => ucwords($request->input('provinsi')),
                'alamat' => ucwords($request->input('alamat')),
                'foto' => $foto,
            ];

            $result->uploadFotoGuru($request->file('foto'), $foto, $id);
            // simpan guru ke database
            $result->updateGuru($id, $data);

            // upload foto guru

            // ubah nama lengkap di tabel user
            $resultUsers = new User();
            $resultUsers->updateUserName($idUser, [
                'nama_lengkap' => $request->input('nama'),
                'foto' => $foto,
            ]);

            return redirect('/guru/setting');
        } elseif ($request->hasfile('foto') == false) {

            $data = [
                'nama' => ucwords($request->input('nama')),
                'agama' => $request->input('agama'),
                'nohp' => $request->input('nohp'),
                'tempat_lahir' => ucwords($request->input('tempatlahir')),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'status_perkawinan' => $request->input('status_perkawinan'),
                'kelurahan' => ucwords($request->input('kelurahan')),
                'kecamatan' => ucwords($request->input('kecamatan')),
                'provinsi' => ucwords($request->input('provinsi')),
                'alamat' => ucwords($request->input('alamat')),

            ];

            // simpan guru ke database
            $result->updateGuru($id, $data);
            // ubah nama lengkap di tabel user
            $resultUsers->updateUserName($idUser, ['nama_lengkap' => ucwords($request->input('nama'))]);

            return redirect('/guru/setting');
        } else {
            return back()
                ->with('warning', 'Data guru Gagal Disimpan');
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
