<?php

namespace App\Http\Controllers\Guru;

use App\Models\AbsenGuru;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelolaAbsensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardGuruController extends GuruController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $id = Auth()->user()->id;

        // tampilkan user guru
        $result = new Guru();
        $user_guru = $result->getGuruFirst(['id', 'nama', 'nohp', 'foto', 'jenis', 'bidang_studi'], $id);

        $this->img = $user_guru->foto;

        // panggil id_guru dari tabel mapel (mapel.id_guru = guru .id ) = mapel
        // panggil id_guru dari table kelas (kelas.id_guru =  guru.id) = Kelas
        $result = new Kelas();
        $wali_kelas = $result->getWaliKelas($user_guru->id);

        if (empty($wali_kelas)) {

            $wali_kelas = '';
        } else {
            $wali_kelas = $wali_kelas;
        }

        $this->img = $this->imageHeader();

        $result = new KelolaAbsensi();
        $absen = $result->absensi();

        // jumlah kehadiran guru
        $resultAbsenGuru = new AbsenGuru();
        $hadir = $resultAbsenGuru->JumlahAbsen($user_guru->id, 'Hadir');

        // jumlah izin guru
        $izin = $resultAbsenGuru->JumlahAbsen($user_guru->id, 'Izin');
        // jumlah terlambat
        $terlambat = $resultAbsenGuru->JumlahAbsen($user_guru->id, 'Terlambat');
        // jumlah mangkir
        $mangkir = $resultAbsenGuru->JumlahAbsen($user_guru->id, 'Mangkir');

        $jumlahAbsen = [
            'hadir' => $hadir->jumlah,
            'izin' => $izin->jumlah,
            'terlambat' => $terlambat->jumlah,
            'mangkir' => $mangkir->jumlah,
        ];

        $isAbsenGuru = $resultAbsenGuru->isAbsenGuru(Auth()->user()->id, $absen['waktu_mulai']);

        return view('guru.dashboard.index')
            ->with('title', $this->title = 'Dashboard')
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('jenisGuru', $this->jenisGuru())
            ->with('jumlahAbsen', $jumlahAbsen)

            ->with('guru', $user_guru)
            ->with('datenow', $absen['date_now'])
            ->with('waktu_absenDari', $absen['waktu_mulai'])
            ->with('waktu_absenSampai', $absen['waktu_selesai'])

            ->with('isAbsen', $isAbsenGuru)

            ->with('wali_kelas', $wali_kelas);
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

    public function Absen(Request $request)
    {

        date_default_timezone_set('Asia/Jakarta'); // Set zona waktu ke Waktu Indonesia Barat

        setlocale(LC_TIME, 'id_ID');

        // get kelola absensi
        $resultKelolaAbsen = new KelolaAbsensi();
        $absen = $resultKelolaAbsen->getAbsenWhereDateNow(date('Y-m-d'));
        // $absen = $resultKelolaAbsen->getAbsenWhereDateNow(date('2023-12-05'));

        $waktu = date('Y-m-d H:i:s');
        //    $waktu = '2023-10-01 06:00:00';
        // $waktu_absen_hijau = date('Y-m-d').' 06:00:00';
        // $waktu_absen_kuning = date('Y-m-d').' 07:00:00';
        // $waktu_absen_merah = date('Y-m-d').' 07:15:00';

        $waktu_absen_hijau = $absen->tanggal.' '.$absen->waktu_mulai;
        $waktu_absen_kuning = $absen->tanggal.' '.date('H:i:s', strtotime($absen->waktu_mulai.'+1 hour'));
        $waktu_absen_merah = $absen->tanggal.' '.$absen->waktu_selesai;

        $id_user = Auth()->user()->id;
        // $result = new Guru();
        // $id_guru = $result->getGuruFirst(['id'], $id_user);

        $id_guru = DB::table('guru')->select('id')->where('id_user', $id_user)->first();

        // if ($waktu >= $waktu_absen_hijau && $waktu <= $waktu_absen_kuning) {
        //     $status = 'Hadir';
        //     $poin_absensi = 0.5;
        // } elseif ($waktu >= $waktu_absen_kuning && $waktu <= $waktu_absen_merah) {
        //     $status = 'Terlambat';
        //     $poin_absensi = 0.1;
        // } else {
        //     $status = 'mangkir';
        //     $poin_absensi = 0;
        // }

        if ($waktu >= $waktu_absen_hijau && $waktu <= $waktu_absen_kuning) {
            $status = 'Hadir';
            $poin_absensi = 0.5;
        } elseif ($waktu >= $waktu_absen_kuning && $waktu <= $waktu_absen_merah) {
            $status = 'Terlambat';
            $poin_absensi = 0.1;
        } else {
            $status = 'mangkir';
            $poin_absensi = 0;
        }

        $data = [
            'id_guru' => $id_guru->id,
            'waktu' => $waktu,
            'status' => $status,
            'poin_absensi' => $poin_absensi,
        ];

        $result = new AbsenGuru();
        $result->saveAbsen($data);

        return redirect('/guru/dashboard')->with('success', 'Absen Berhasil');
    }
}
