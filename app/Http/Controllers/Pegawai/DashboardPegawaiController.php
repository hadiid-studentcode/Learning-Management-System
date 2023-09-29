<?php

namespace App\Http\Controllers\Pegawai;

use App\Models\KelolaAbsensi;
use App\Models\Pegawai;
use Illuminate\Http\Request;

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
}
