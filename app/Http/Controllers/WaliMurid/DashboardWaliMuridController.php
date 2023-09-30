<?php

namespace App\Http\Controllers\WaliMurid;

use App\Models\Gallery;
use App\Models\Pemasukan;
use App\Models\TahunAjaran;
use App\Models\WaliMurid;
use Illuminate\Http\Request;

class DashboardWaliMuridController extends WaliMuridController
{
    private $userName;

    private $nbm;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->title = 'Dashboard';
        $id = auth()->user()->id;

        // panggil nisn siswa
        $result = new WaliMurid();
        $siswa = $result->getSiswa($id);

        if ($siswa == null) {
            $siswa = $result->firstSiswa($id);
        }

        // panggil gallery
        $result = new Gallery();
        $gallery = $result->getGallery();

        $this->img = $this->imageHeader();

        // akses kunci

        date_default_timezone_set('Asia/Jakarta'); // Set zona waktu ke Waktu Indonesia Barat

        setlocale(LC_TIME, 'id_ID');

        $tanggalNow = date('Y-m-d');

        $bulanNow = date('m');

        // tahun ajaran sekarnag
        $resultTahunAjaran = new TahunAjaran();
        $tahunAjaran = $resultTahunAjaran->getTahunAjaran();
        $parts = explode('-', $tahunAjaran->tahun_ajaran);

        $tahunSekarang = $parts[0]; // "2023"

        // $tanggalAwal = '2023-09-11';
        $tanggalAwal = $tanggalNow;
        $tanggalAkhir = $tahunSekarang.'-'.$bulanNow.'-31';

        // Logika untuk menentukan status
        if ($tanggalAwal <= $tahunSekarang.'-'.$bulanNow.'-10' && $tanggalAkhir >= $tahunSekarang.'-'.$bulanNow.'-01') {
            $kunci = null;
        } elseif ($tanggalAwal <= $tahunSekarang.'-'.$bulanNow.'-31' && $tanggalAkhir >= $tahunSekarang.'-'.$bulanNow.'-11') {
            $resultPemasukan = new Pemasukan();
            $kunci = $resultPemasukan->getKunciAkunWaliMurid($id);
        } else {
            $kunci = null;
        }

        return view('waliMurid.dashboard.index')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('gallery', $gallery)
            ->with('kunci', $kunci)
            ->with('siswa', $siswa->nama);
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
