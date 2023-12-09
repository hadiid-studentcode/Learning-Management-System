<?php

namespace App\Http\Controllers\TataUsaha;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManajemenPegawaiTataUsahaController extends TataUsahaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->img = $this->imageHeader();
        $userid = auth()->user()->userid;

        // get pegawai
        $result = new Pegawai();

        if ($userid == 'admintu') {

            $getPegawai = $result->getPegawai();
        } else {
            $getPegawai =
                $result = DB::table('pegawai')
                ->select('*')
                ->WhereNot('pegawai.nama', '=', 'admin')
                ->get();
        }

        return view('tataUsaha.manajemen-pegawai.index')
            ->with('title', 'Manajemen Pegawai')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('pegawai', $getPegawai)
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

        // simpan akun user pegawai
        if (ucwords($request->jenis) == 'Tata Usaha') {
            // ubah hak akses menjadi tata usaha
            $hak_akses = 'Tata Usaha';
            $jenis = $request->posisi_tataUsaha;
        } else {
            //    ubah hak akses menjadi pegawai
            $hak_akses = 'Pegawai';
            $jenis = $request->posisi_pegawai;
        }

        try {
            if ($request->hasfile('foto')) {

                $foto = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('foto')->getClientOriginalName());

                $dataUser = [
                    'nama_lengkap' => ucwords($request->nama),
                    'email' => null,
                    'userid' => ucwords($request->nama),
                    'password' => bcrypt(ucwords($request->nama)),
                    'foto' => $foto,
                    'hak_akses' => $hak_akses,
                ];

                // simpan user
                $result = new User();
                $result->saveUsers($dataUser);

                // panggil ide user yang terakhir

                $id_user = $result->lastIdUser();

                $dataPegawai = [
                    'nik' => $request->nik,
                    'nama' => ucwords($request->nama),
                    'jenis' => ucwords($jenis),
                    'no_hp' => $request->hp,
                    'tempat_lahir' => ucwords($request->tempat_lahir),
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'agama' => ucwords($request->agama),
                    'status_perkawinan' => $request->status_perkawinan,
                    'kelurahan' => ucwords($request->kelurahan),
                    'kecamatan' => ucwords($request->kecamatan),
                    'kabupatenKota' => ucwords($request->kabupaten_kota),
                    'provinsi' => ucwords($request->provinsi),
                    'alamat' => ucwords($request->alamat),
                    'foto' => $foto,
                    'id_user' => $id_user,

                ];

                // simpan pegawai
                $result = new Pegawai();
                $result->uploadFotoPegawai($request->file('foto'), $foto, $id = '');
                $result->savePegawai($dataPegawai);

                return redirect('/tata-usaha/manajemen-pegawai')->with('success', 'Data berhasil disimpan');
            } elseif ($request->hasfile('foto') == false) {

                $dataUser = [
                    'nama_lengkap' => ucwords($request->nama),
                    'email' => null,
                    'userid' => ucwords($request->nama),
                    'password' => bcrypt(ucwords($request->nama)),
                    'foto' => null,
                    'hak_akses' => $hak_akses,
                ];

                // simpan user
                $result = new User();
                $result->saveUsers($dataUser);

                // panggil ide user yang terakhir
                $id = $result->lastIdUser();

                $dataPegawai = [
                    'nik' => $request->nik,
                    'nama' => ucwords($request->nama),
                    'jenis' => ucwords($jenis),
                    'no_hp' => $request->hp,
                    'tempat_lahir' => ucwords($request->tempat_lahir),
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'agama' => ucwords($request->agama),
                    'status_perkawinan' => $request->status_perkawinan,
                    'kelurahan' => ucwords($request->kelurahan),
                    'kecamatan' => ucwords($request->kecamatan),
                    'kabupatenKota' => ucwords($request->kabupaten_kota),
                    'provinsi' => ucwords($request->provinsi),
                    'alamat' => ucwords($request->alamat),
                    'foto' => null,
                    'id_user' => $id,
                ];

                // simpan pegawai
                $result = new Pegawai();
                $result->savePegawai($dataPegawai);

                return redirect('/tata-usaha/manajemen-pegawai')->with('success', 'Data berhasil disimpan');
            } else {
                return back()
                    ->with('warning', 'Data Pegawai Gagal Disimpan');
            }
        } catch (\Throwable $th) {

            return back()->with('warning', 'Terjadi Kesalahan : ' . $th->getMessage());
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

                $foto = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('foto')->getClientOriginalName());

                $dataUser = [
                    'nama_lengkap' => ucwords($request->nama),
                    'foto' => $foto,

                ];

                // get id_user di pegawai
                $result = new Pegawai();
                $dataPegawai = $result->getUserIdPegawai($id);

                // save user[nama,foto,hak_akses]
                $resultUser = new User();
                $resultUser->updateData($dataPegawai->id_user, $dataUser);

                $dataPegawai = [
                    'nik' => $request->nik,
                    'nama' => ucwords($request->nama),
                    // 'jenis' => ucwords($request->jenis),
                    'no_hp' => $request->hp,
                    'tempat_lahir' => ucwords($request->tempat_lahir),
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'agama' => ucwords($request->agama),
                    'status_perkawinan' => $request->status_perkawinan,
                    'kelurahan' => ucwords($request->kelurahan),
                    'kecamatan' => ucwords($request->kecamatan),
                    'kabupatenKota' => ucwords($request->kabupaten_kota),
                    'provinsi' => ucwords($request->provinsi),
                    'alamat' => ucwords($request->alamat),
                    'foto' => $foto,

                ];

                // simpan pegawai
                $result = new Pegawai();
                $result->uploadFotoPegawai($request->file('foto'), $foto, $id);
                $result->updatePegawai($id, $dataPegawai);

                return redirect('/tata-usaha/manajemen-pegawai')->with('success', 'Data berhasil disimpan');
            } elseif ($request->hasfile('foto') == false) {
                // simpan akun user pegawai
                if (ucwords($request->jenis) == 'Tata Usaha') {
                    // ubah hak akses menjadi tata usaha
                    $hak_akses = 'Tata Usaha';
                } else {
                    //    ubah hak akses menjadi pegawai
                    $hak_akses = 'Pegawai';
                }

                $dataUser = [
                    'nama_lengkap' => ucwords($request->nama),
                    'hak_akses' => $hak_akses,
                ];

                // get id_user di pegawai
                $result = new Pegawai();
                $dataPegawai = $result->getUserIdPegawai($id);

                // save user[nama,foto,hak_akses]
                $resultUser = new User();
                $resultUser->updateData($dataPegawai->id_user, $dataUser);

                $dataPegawai = [
                    'nik' => $request->nik,
                    'nama' => ucwords($request->nama),
                    // 'jenis' => ucwords($request->jenis),
                    'no_hp' => $request->hp,
                    'tempat_lahir' => ucwords($request->tempat_lahir),
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'agama' => ucwords($request->agama),
                    'status_perkawinan' => $request->status_perkawinan,
                    'kelurahan' => ucwords($request->kelurahan),
                    'kecamatan' => ucwords($request->kecamatan),
                    'kabupatenKota' => ucwords($request->kabupaten_kota),
                    'provinsi' => ucwords($request->provinsi),
                    'alamat' => ucwords($request->alamat),
                ];

                // update pegawai
                $result = new Pegawai();
                $result->UpdatePegawai($id, $dataPegawai);

                return redirect('/tata-usaha/manajemen-pegawai')->with('success', 'Data berhasil disimpan');
            } else {
                return back()
                    ->with('warning', 'Data Pegawai Gagal Disimpan');
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
            // user id where pegawai
            $result = new Pegawai();
            $pegawai = $result->getUserIdPegawai($id);

            // deleted user dengan id
            $result = new User();
            $result->deleteUser($pegawai->id_user);

            $result = new Pegawai();
            $result->HapusFotoPegawai($id);
            $result->deletePegawai($id);

            return redirect('/tata-usaha/manajemen-pegawai')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return back();
        }
    }
}
