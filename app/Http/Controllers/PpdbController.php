<?php

namespace App\Http\Controllers;

use App\Models\PesertaPPDB;
use Illuminate\Http\Request;

class PpdbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ppdb.index');
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
        if ($request->nisn == null && $request->kelas !== '1') {
            return redirect('/ppdb#daftar')->with('error', 'Kesalahan,NISN Harap Diinput Jika Kelas 2-9');
        } elseif ($request->nisn !== null && $request->kelas == '1') {
            return redirect('/ppdb#daftar')->with('error', 'Kesalahan,NISN Tidak Perlu Diinput Jika Kelas 1 atau Peserta Didik Baru');
        }





        $resultPPDB = new PesertaPPDB();
        try {

            if ($request->hasFile('photo')) {
                $foto = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('photo')->getClientOriginalName());
                // save foto peserta PPDB
                $resultPPDB->uploadFotoPesertaPPDB($request->photo, $foto);
            } else {
                $foto = null;
            }

            if ($request->kelas == '1' && $request->nisn == null) {
                $nisn = 'PPDB' . sprintf("%010d", mt_rand(0, 9999999999));
            } else {
                $nisn = $request->nisn;
            }
            // simpan ppdb
            $data = [
                "nisn_siswa" => $nisn,
                'nama_siswa' => $request->nama,
                'kelas_siswa' => $request->kelas,
                'jenis_kelamin_siswa' => $request->jenis_kelamin,
                'agama_siswa' => $request->agama,
                'kelurahan_siswa' => $request->kelurahan,
                'kecamatan_siswa' => $request->kecamatan,
                'kabupatenKota_siswa' => $request->kabupaten_kota,
                'provinsi_siswa' => $request->provinsi,
                'alamat_siswa' => $request->alamat,
                'tempat_lahir_siswa' => $request->tempat_lahir,
                'tanggal_lahir_siswa' => $request->tanggal_lahir,
                'foto_siswa' => $foto,
                'nik_wali_murid' => $request->nik,
                'nama_wali_murid' => $request->nama_ortu,
                'hubungan_wali_murid' => $request->hubungan,
                'jenis_kelamin_wali_murid' => $request->jenis_kelamin_ortu,
                'agama_wali_murid' => $request->agama_ortu,
                'no_hp_wali_murid' => $request->no_hp_ortu,
                'kelurahan_wali_murid' => $request->kelurahan_ortu,
                'kecamatan_wali_murid' => $request->kecamatan_ortu,
                'kabupatenKota_wali_murid' => $request->kabupaten_kota_ortu,
                'provinsi_wali_murid' => $request->provinsi_ortu,
                'email_wali_murid' => $request->email_ortu,
                'pekerjaan_wali_murid' => $request->pekerjaan_ortu,
                'alamat_wali_murid' => $request->alamat_ortu,
                'status_ppdb' => false,

            ];



            $resultPPDB->createPesertaPPDB($data);



            return redirect('/ppdb#daftar')->with('success', 'Sukses,Pengiriman Data ke Pihak Sekolah Berhasil');
        } catch (\Throwable $th) {
            return redirect('/ppdb#daftar')->with('error',' Kesalahan,Terjadi Kesalahan Silahkan Coba Lagi',);
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     //
    // }
}
