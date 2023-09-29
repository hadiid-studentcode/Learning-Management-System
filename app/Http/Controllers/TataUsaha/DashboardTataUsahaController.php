<?php

namespace App\Http\Controllers\TataUsaha;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelolaAbsensi;
use App\Models\Pegawai;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class DashboardTataUsahaController extends TataUsahaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $resultTahunAjaran = new TahunAjaran();
        $resultTahunAjaran->updateAutoTahunAjaran();

        $this->img = $this->imageHeader();

        //   ambil data nama,jenis,nbm,nohp pegawai
        $resultPegawai = new Pegawai();
        $tataUsaha = $resultPegawai->getPegawaiFirst(['nama', 'jenis', 'no_hp'], Auth()->user()->id);

        $resultKelolaAbsensi = new KelolaAbsensi();
        $absen = $resultKelolaAbsensi->absensi();

        // jumlah siswa
        $resultSiswa = new Siswa();
        $siswa = $resultSiswa->getSiswaCount();
        // get jumlah guru
        $resultGuru = new Guru();
        $guru = $resultGuru->getGuruCount();
        // jumlah jumlah pegawai
        $pegawai = $resultPegawai->getPegawaiCount();

        // get jumlah kelas
        $resultKelas = new Kelas();
        $kelas = $resultKelas->getKelasCount();

        return view('tataUsaha.dashboard.index')
            ->with('title', 'Dashboard')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('tatauUsaha', $tataUsaha)
            ->with('jumlahSiswa', $siswa)
            ->with('jumlahGuru', $guru)
            ->with('jumlahPegawai', $pegawai)
            ->with('jumlahKelas', $kelas)
            ->with('datenow', $absen['date_now'])
            ->with('waktu_absenDari', $absen['waktu_mulai'])
            ->with('waktu_absenSampai', $absen['waktu_selesai'])
            ->with('route', $this->route);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
