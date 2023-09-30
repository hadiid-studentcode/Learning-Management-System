<?php

namespace App\Http\Controllers\Guru;

use App\Models\AbsenGuru;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelolaAbsensi;
use Illuminate\Http\Request;

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
        $user_guru = $result->getGuruFirst(['id', 'nama', 'nohp', 'foto', 'jenis'], $id);

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

        return view('guru.dashboard.index')
            ->with('title', $this->title = 'Dashboard')
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('jenis', $this->jenisGuru())

            ->with('guru', $user_guru)
            ->with('datenow', $absen['date_now'])
            ->with('waktu_absenDari', $absen['waktu_mulai'])
            ->with('waktu_absenSampai', $absen['waktu_selesai'])

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

        $waktu = date('Y-m-d H:i:s');
        // $waktu = '2023-07-17 07:15:00';
        $waktu_absen_hijau = '2023-07-17 06:00:00';
        $waktu_absen_kuning = '2023-07-17 07:00:00';
        $waktu_absen_merah = '2023-07-17 07:15:00';

        $id_user = Auth()->user()->id;
        $result = new Guru();
        $id_guru = $result->getGuruFirst(['id'], $id_user);

        if ($waktu >= $waktu_absen_hijau && $waktu <= $waktu_absen_kuning) {
            $status = 'Hadir';
        } elseif ($waktu >= $waktu_absen_kuning && $waktu <= $waktu_absen_merah) {
            $status = 'Terlambat';
        } else {
            $status = 'mangkir';
        }

        $data = [
            'id_guru' => $id_guru->id,
            'waktu' => $waktu,
            'status' => $status,
        ];

        $result = new AbsenGuru();
        $result->saveAbsen($data);

        return redirect('/guru/dashboard')->with('success', 'Absen Berhasil');
    }
}
