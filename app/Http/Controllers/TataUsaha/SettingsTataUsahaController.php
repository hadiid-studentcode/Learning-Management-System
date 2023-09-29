<?php

namespace App\Http\Controllers\TataUsaha;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;

class SettingsTataUsahaController extends TataUsahaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $id = auth()->user()->id;
        // panggil pegawai
        $result = new Pegawai();
        $getPegawai = $result->getPegawaiFirst([
            'pegawai.*',
            'users.id as user_id',
            'users.email as user_email',
            'users.userid as user_username',

        ], $id);



        $string = $getPegawai->foto;
        $parts = explode('-', $string);
        $filename = end($parts);

        $this->img = $this->imageHeader();

        return view('tataUsaha.settings.index')
            ->with('title', 'Settings')
            ->with('userName', $this->userName)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('tataUsaha', $getPegawai)
            ->with('filename', $filename)
            ->with('photo', '');
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

        $request->validate([

            'foto' => 'mimes:jpg,jpeg,png|max:5000',
        ]);

        if ($request->hasFile('foto')) {
            $foto =
                round(microtime(true) * 1000).'-'.str_replace(' ', '-', $request->file('foto')->getClientOriginalName());

            if ($request->nik == null) {
                $data = [
                    'nama' => $request->input('nama'),
                    'no_hp' => $request->input('nohp'),
                    'tempat_lahir' => $request->input('tempat_lahir'),
                    'tanggal_lahir' => $request->input('tanggal_lahir'),
                    'jenis_kelamin' => $request->input('jenis_kelamin'),
                    'agama' => $request->input('agama'),
                    'status_perkawinan' => $request->input('status_perkawinan'),
                    'kelurahan' => $request->input('kelurahan'),
                    'kecamatan' => $request->input('kecamatan'),
                    'kabupatenKota' => $request->input('kabupatenKota'),
                    'provinsi' => $request->input('provinsi'),
                    'alamat' => $request->input('alamat'),
                    'foto' => $foto,
                ];
            } else {
                $data = [
                    'nik' => $request->nik,
                    'nama' => $request->input('nama'),
                    'no_hp' => $request->input('nohp'),
                    'tempat_lahir' => $request->input('tempat_lahir'),
                    'tanggal_lahir' => $request->input('tanggal_lahir'),
                    'jenis_kelamin' => $request->input('jenis_kelamin'),
                    'agama' => $request->input('agama'),
                    'status_perkawinan' => $request->input('status_perkawinan'),
                    'kelurahan' => $request->input('kelurahan'),
                    'kecamatan' => $request->input('kecamatan'),
                    'kabupatenKota' => $request->input('kabupatenKota'),
                    'provinsi' => $request->input('provinsi'),
                    'alamat' => $request->input('alamat'),
                    'foto' => $foto,
                ];

            }

            $result = new Pegawai();

            //   upload foto yang baru
            $result->uploadFotoPegawai(
                $request->file('foto'),
                $foto,
                $id
            );
            // simpan data pegawai

            $result->updatePegawaiWhereIdUsers($id, $data);
            // update nama lengkap
            $result = new User();
            $result->updateUserName(Auth()->user()->id, [
                'nama_lengkap' => $request->input('nama'),
                'foto' => $foto,
            ]);

            return redirect('/tata-usaha/setting');
        } elseif ($request->hasFile('foto') == false) {

            if ($request->nik == null) {
                $data = [
                    'nama' => $request->input('nama'),
                    'no_hp' => $request->input('nohp'),
                    'tempat_lahir' => $request->input('tempat_lahir'),
                    'tanggal_lahir' => $request->input('tanggal_lahir'),
                    'jenis_kelamin' => $request->input('jenis_kelamin'),
                    'agama' => $request->input('agama'),
                    'status_perkawinan' => $request->input('status_perkawinan'),
                    'kelurahan' => $request->input('kelurahan'),
                    'kecamatan' => $request->input('kecamatan'),
                    'kabupatenKota' => $request->input('kabupatenKota'),
                    'provinsi' => $request->input('provinsi'),
                    'alamat' => $request->input('alamat'),

                ];
            } else {
                $data = [
                    'nik' => $request->nik,
                    'nama' => $request->input('nama'),
                    'no_hp' => $request->input('nohp'),
                    'tempat_lahir' => $request->input('tempat_lahir'),
                    'tanggal_lahir' => $request->input('tanggal_lahir'),
                    'jenis_kelamin' => $request->input('jenis_kelamin'),
                    'agama' => $request->input('agama'),
                    'status_perkawinan' => $request->input('status_perkawinan'),
                    'kelurahan' => $request->input('kelurahan'),
                    'kecamatan' => $request->input('kecamatan'),
                    'kabupatenKota' => $request->input('kabupatenKota'),
                    'provinsi' => $request->input('provinsi'),
                    'alamat' => $request->input('alamat'),

                ];
            }

            // simpan data pegawai
            $result = new Pegawai();
            $result->updatePegawaiWhereIdUsers($id, $data);
            // update nama lengkap
            $result = new User();
            $result->updateUserName(Auth()->user()->id, ['nama_lengkap' => $request->input('nama')]);

            return redirect('/tata-usaha/setting');
        } else {
            return back()
                ->with('error', 'Data Pegawai Gagal Disimpan');
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
