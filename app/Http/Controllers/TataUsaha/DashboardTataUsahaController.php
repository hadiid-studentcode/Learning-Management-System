<?php

namespace App\Http\Controllers\TataUsaha;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pegawai;
use App\Models\AbsenGuru;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\KelolaAbsensi;
use App\Http\Controllers\TataUsaha\TataUsahaController;
use App\Models\AbsenPegawai;

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

    public function absen(){

        date_default_timezone_set('Asia/Jakarta'); // Set zona waktu ke Waktu Indonesia Barat

        setlocale(LC_TIME, 'id_ID');

        $waktu = date('Y-m-d H:i:s');
        // $waktu = '2023-07-17 07:15:00';
        $waktu_absen_hijau = '2023-07-17 06:00:00';
        $waktu_absen_kuning = '2023-07-17 07:00:00';
        $waktu_absen_merah = '2023-07-17 07:15:00';

        $id_user = Auth()->user()->id;
        $result = new Pegawai();
        $pegawai = $result->getPegawaiFirst(['id'], $id_user);

        if ($waktu >= $waktu_absen_hijau && $waktu <= $waktu_absen_kuning) {
            $status = 'Hadir';
        } elseif ($waktu >= $waktu_absen_kuning && $waktu <= $waktu_absen_merah) {
            $status = 'Terlambat';
        } else {
            $status = 'mangkir';
        }

        $data = [
            'id_pegawai' => $pegawai->id,
            'waktu' => $waktu,
            'status' => $status,
        ];

        $result = new AbsenPegawai();
        $result->saveAbsen($data);

        return redirect('/tata-usaha/dashboard')->with('success', 'Absen Berhasil');

    }
}
