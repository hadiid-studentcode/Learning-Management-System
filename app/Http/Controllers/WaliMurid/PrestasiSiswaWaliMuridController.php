<?php

namespace App\Http\Controllers\WaliMurid;

use App\Models\Calender;
use App\Models\PrestasiSiswa;
use App\Models\WaliMurid;
use Illuminate\Http\Request;

class PrestasiSiswaWaliMuridController extends WaliMuridController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->title = 'Prestasi Siswa';
        $id = auth()->user()->id;

        $this->img = $this->imageHeader();

        // data siswa
        $result = new WaliMurid();
        $siswa = $result->getSiswa($id);

        if ($siswa == null) {
            $siswa = $result->firstSiswa($id);
            $siswa->guru = 'Belum Ada Wali Kelas';
        }

        // get prestasi siswa where id_siswa
        $resultPrestasiSiswa = new PrestasiSiswa();
        $prestasi = $resultPrestasiSiswa->getPrestasiSiswaWhereIdSiswa($siswa->id);

        if (! empty($prestasi)) {
            $tanggal['tanggal'] = '';
        }

        foreach ($prestasi as $p) {
            $resultCalender = new Calender();
            $tanggal = $resultCalender->TanggalBahasaIndonesia($p->tanggal);

        }

        return view('waliMurid.prestasi-siswa.index')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('siswa', $siswa)
            ->with('prestasi', $prestasi)
            ->with('tanggal', $tanggal['tanggal'])
            ->with('folder', $this->folder);
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
