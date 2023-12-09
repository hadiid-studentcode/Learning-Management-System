<?php

namespace App\Http\Controllers\TataUsaha;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;

class ManajemenGuruTataUsahaController extends TataUsahaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->img = $this->imageHeader();

        // get guru
        $result = new Guru();
        $getGuru = $result->viewGuru(['*']);

        return view('tataUsaha.manajemen-guru.index')
            ->with('title', 'Manajemen Guru')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('guru', $getGuru)
            ->with('folder', $this->folder)
            ->with('route', $this->route);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'mimes:jpeg,png,jpg|max:5000',
        ]);

        try {
            if ($request->hasfile('foto')) {

                $foto = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $request->file('foto')->getClientOriginalName());

                $dataUser = [
                    'nama_lengkap' => ucwords($request->nama),
                    'email' => null,
                    'userid' => $request->nbm,
                    'password' => bcrypt($request->nbm),
                    'foto' => $foto,
                    'hak_akses' => 'Guru',
                ];

                // simpan user
                $result = new User();
                $result->saveUsers($dataUser);

                // panggil ide user yang terakhir

                $id = $result->lastIdUser();

                $dataGuru = [
                    'nik' => $request->nik,
                    'nbm' => $request->nbm,
                    'nama' => ucwords($request->nama),
                    'jenis' => 'Non Wali Kelas',
                    'status' => $request->status,
                    'bidang_studi' => ucwords($request->bidang_studi),
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'nohp' => $request->nohp,
                    'tempat_lahir' => ucwords($request->tempat_lahir),
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'agama' => $request->agama,
                    'status_perkawinan' => $request->status_perkawinan,
                    'kelurahan' => ucwords($request->kelurahan),
                    'kecamatan' => ucwords($request->kecamatan),
                    'kabupatenKota' => ucwords($request->kabupatenKota),
                    'provinsi' => ucwords($request->provinsi),
                    'alamat' => ucwords($request->alamat),
                    'foto' => $foto,
                    'id_user' => $id,

                ];

                // simpan guru
                $result = new Guru();
                $result->saveGuru($dataGuru);

                $result->uploadFotoGuru($request->file('foto'), $foto, $id);

                return redirect('/tata-usaha/manajemen-guru')->with('success', 'Data berhasil disimpan');
            } elseif ($request->hasfile('foto') == false) {

                $dataUser = [
                    'nama_lengkap' => ucwords($request->nama),
                    'email' => null,
                    'userid' => $request->nbm,
                    'password' => bcrypt($request->nbm),
                    'foto' => null,
                    'hak_akses' => 'Guru',
                ];

                // simpan user
                $result = new User();
                $result->saveUsers($dataUser);

                // panggil ide user yang terakhir
                $id = $result->lastIdUser();

                $dataGuru = [
                    'nik' => $request->nik,
                    'nbm' => $request->nbm,
                    'nama' => ucwords($request->nama),
                    'jenis' => 'Non Wali Kelas',
                    'status' => $request->status,
                    'bidang_studi' => ucwords($request->bidang_studi),
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'nohp' => $request->nohp,
                    'tempat_lahir' => ucwords($request->tempat_lahir),
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'agama' => $request->agama,
                    'status_perkawinan' => $request->status_perkawinan,
                    'kelurahan' => ucwords($request->kelurahan),
                    'kecamatan' => ucwords($request->kecamatan),
                    'kabupatenKota' => ucwords($request->kabupatenKota),
                    'provinsi' => ucwords($request->provinsi),
                    'alamat' => ucwords($request->alamat),
                    'foto' => null,
                    'id_user' => $id,

                ];

                // simpan guru
                $result = new Guru();
                $result->saveGuru($dataGuru);

                return redirect('/tata-usaha/manajemen-guru')->with('success', 'Data berhasil disimpan');
            } else {
                return back()
                    ->with('warning', 'Data Guru Gagal Disimpan');
            }
        } catch (\Throwable $th) {

            return back()->with('warning', 'Terjadi Kesalahan foto tidak valid');
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'foto' => 'mimes:jpeg,png,jpg|max:5000',
        ]);

        try {
            if ($request->hasfile('foto')) {

                $foto = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $request->file('foto')->getClientOriginalName());

                $dataUser = [
                    'nama_lengkap' => ucwords($request->nama),

                    'userid' => $request->nbm,
                    'password' => bcrypt($request->nbm),
                    'foto' => $foto,
                    'hak_akses' => 'Guru',
                ];

                // panggil user_id guru
                $result = new Guru();
                $user_id = $result->getUserIdGuru($id);

                // update user
                $result = new User();
                $result->updateUser($user_id->id_user, $dataUser);

                $dataGuru = [
                    'nik' => $request->nik,
                    'nbm' => $request->nbm,
                    'nama' => ucwords($request->nama),
                    'status' => $request->status,
                    'bidang_studi' => ucwords($request->bidang_studi),
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'nohp' => $request->nohp,
                    'tempat_lahir' => ucwords($request->tempat_lahir),
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'agama' => $request->agama,
                    'status_perkawinan' => $request->status_perkawinan,
                    'kelurahan' => ucwords($request->kelurahan),
                    'kecamatan' => ucwords($request->kecamatan),
                    'kabupatenKota' => ucwords($request->kabupatenKota),
                    'provinsi' => ucwords($request->provinsi),
                    'alamat' => ucwords($request->alamat),
                    'foto' => $foto,

                ];

                $result = new Guru();
                $result->uploadFotoGuru($request->file('foto'), $foto, $id);

                // simpan guru

                $result->updateGuru($id, $dataGuru);

                return redirect('/tata-usaha/manajemen-guru')->with('success', 'Data berhasil disimpan');
            } elseif ($request->hasfile('foto') == false) {

                $dataUser = [
                    'nama_lengkap' => ucwords($request->nama),

                    'userid' => $request->nbm,
                    'password' => bcrypt($request->nbm),

                    'hak_akses' => 'Guru',
                ];

                // panggil user_id guru
                $result = new Guru();
                $user_id = $result->getUserIdGuru($id);

                // update user
                $result = new User();
                $result->updateUser($user_id->id_user, $dataUser);

                $dataGuru = [
                    'nik' => $request->nik,
                    'nbm' => $request->nbm,
                    'nama' => ucwords($request->nama),
                    'status' => $request->status,
                    'bidang_studi' => ucwords($request->bidang_studi),
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'nohp' => $request->nohp,
                    'tempat_lahir' => ucwords($request->tempat_lahir),
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'agama' => $request->agama,
                    'status_perkawinan' => $request->status_perkawinan,
                    'kelurahan' => ucwords($request->kelurahan),
                    'kecamatan' => ucwords($request->kecamatan),
                    'kabupatenKota' => ucwords($request->kabupatenKota),
                    'provinsi' => ucwords($request->provinsi),
                    'alamat' => ucwords($request->alamat),

                ];

                // simpan guru
                $result = new Guru();
                $result->updateGuru($id, $dataGuru);

                return redirect('/tata-usaha/manajemen-guru')->with('success', 'Data berhasil disimpan');
            } else {
                dd('sdsad');

                return back()
                    ->with('warning', 'Data Guru Gagal Disimpan');
            }
        } catch (\Throwable $th) {

            return back()->with('warning', 'Terjadi Kesalahan foto tidak valid');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {


        try {
            // get userId
            $result = new Guru();
            $user_id = $result->getUserIdGuru($id);

            // hapus user
            $result = new User();
            $result->deleteUser($user_id->id_user);

            $result = new Guru();
            $result->HapusFotoGuru($id);
            $result->deleteGuru($id);

            return redirect('/tata-usaha/manajemen-guru')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
           return back();
        }

      
    }
}
