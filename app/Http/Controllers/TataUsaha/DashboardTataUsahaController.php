<?php

namespace App\Http\Controllers\TataUsaha;

use App\Models\AbsenPegawai;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelolaAbsensi;
use App\Models\Pegawai;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $resultAbsenPegawai = new AbsenPegawai();
        $isAbsenPegawai = $resultAbsenPegawai->isAbsenPegawai(Auth()->user()->id, $absen['waktu_mulai']);

        return view('tataUsaha.dashboard.index')
            ->with('title', 'Dashboard')
            ->with('jenis', $tataUsaha->jenis)
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
            ->with('isAbsen', $isAbsenPegawai)
            ->with('route', $this->route);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
        
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
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

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }

    public function absen()
    {
        date_default_timezone_set('Asia/Jakarta'); // Set zona waktu ke Waktu Indonesia Barat

        setlocale(LC_TIME, 'id_ID');

        // get kelola absensi
        $resultKelolaAbsen = new KelolaAbsensi();
        $absen = $resultKelolaAbsen->getAbsenWhereDateNow(date('Y-m-d'));
        // $absen = $resultKelolaAbsen->getAbsenWhereDateNow(date('2023-12-05'));

        $waktu = date('Y-m-d H:i:s');
        //    $waktu = date('2023-12-05 07:00:00');
        // $waktu_absen_hijau = date('Y-m-d') . ' 06:00:00';
        // $waktu_absen_kuning = date('Y-m-d') . ' 07:00:00';
        // $waktu_absen_merah = date('Y-m-d') . ' 07:15:00';
        $waktu_absen_hijau = $absen->tanggal.' '.$absen->waktu_mulai;
        $waktu_absen_kuning = $absen->tanggal.' '.date('H:i:s', strtotime($absen->waktu_mulai.'+1 hour'));
        $waktu_absen_merah = $absen->tanggal.' '.$absen->waktu_selesai;

        $id_user = Auth()->user()->id;

        $pegawai = DB::table('pegawai')->select('id')->where('id_user', $id_user)->first();

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
