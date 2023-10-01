<?php

namespace App\Http\Controllers\Pegawai;

use App\Models\AbsenPegawai;
use App\Models\KelolaAbsensi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardPegawaiController extends PegawaiController
{
    /**
     * Display a listing of the resource.
     */
    private $photos;

    public function index()
    {
        $this->title = 'Dashboard';
        $this->userName = auth()->user()->nama_lengkap;
        $id = auth()->user()->id;

        $result = new Pegawai();
        $getNoHpAndJenis = $result->getNoHpAndJenisAttribute($id);

        $getphotos = $result->getPhotosUser($id);

        $this->img = htmlspecialchars($getphotos->foto);

        $result = new KelolaAbsensi();
        $absen = $result->absensi();

        $this->img = $this->imageHeader();

        return view('pegawai.dashboard.index')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('user', $this->userName)
            ->with('datenow', $absen['date_now'])
            ->with('waktu_absenDari', $absen['waktu_mulai'])
            ->with('waktu_absenSampai', $absen['waktu_selesai'])

            ->with('nohp', $getNoHpAndJenis->no_hp)
            ->with('jenis', $getNoHpAndJenis->jenis)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('folder', $this->folder)

            ->with('img', $this->img);
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

    public function absen()
    {

        date_default_timezone_set('Asia/Jakarta'); // Set zona waktu ke Waktu Indonesia Barat

        setlocale(LC_TIME, 'id_ID');

        $waktu = date('Y-m-d H:i:s');
        //    $waktu = '2023-10-01 06:00:00';
        $waktu_absen_hijau = date('Y-m-d').' 06:00:00';
        $waktu_absen_kuning = date('Y-m-d').' 07:00:00';
        $waktu_absen_merah = date('Y-m-d').' 07:15:00';

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

        return redirect('/pegawai/dashboard')->with('success', 'Absen Berhasil');
    }
}
