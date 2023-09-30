<?php

namespace App\Http\Controllers\WaliMurid;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Pertemuan;
use App\Models\WaliMurid;
use Illuminate\Http\Request;

class MataPelajaranWaliMuridController extends WaliMuridController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->title = 'Mata Pelajaran';
        $id = auth()->user()->id;
        $result = new WaliMurid();
        $getFoto = $result->getFotoSiswa($id);
        $this->img = $this->imageHeader();

        // get id siswa from wali murid
        $waliMurid = $result->getIdSiswa($id);

        // get kelas where id siswa
        $resultKelas = new Kelas();
        $kelas = $resultKelas->getKelasWhereIdSiswa($waliMurid->id_siswa);

        // get mapel where id_siswa
        $resultMapel = new Mapel();
        $mapel = $resultMapel->getMapelWhereIdSiswa($waliMurid->id_siswa);

        return view('waliMurid.mata-pelajaran.index')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('kelas', $kelas)
            ->with('mapel', $mapel)
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
    public function show(Request $r, string $id)
    {

        $this->title = 'Mata Pelajaran';
        $id = auth()->user()->id;
        $result = new WaliMurid();
        $getFoto = $result->getFotoSiswa($id);
        $this->img = $this->imageHeader();

        // get id siswa from wali murid
        $waliMurid = $result->getIdSiswa($id);

        // get kelas where id siswa
        $resultKelas = new Kelas();
        $kelas = $resultKelas->getKelasWhereIdSiswa($waliMurid->id_siswa);

        // get mapel where id_siswa
        $resultMapel = new Mapel();
        $mapel = $resultMapel->getMapelWhereIdSiswa($waliMurid->id_siswa);

        // get pertemuan where id_kelas
        $resultPertemuan = new Pertemuan();
        $getPertemuan = $resultPertemuan->getPertemuanWhereIdKelas($r->pelajaran, $r->kelas);


        $kelasSearch = $resultKelas->firstKelasWhereIdKelas($r->kelas);
        $mapelSearch = $resultMapel->firstMapelWhereKodeMapel($r->pelajaran);

        return view('waliMurid.mata-pelajaran.index')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('kelas', $kelas)
            ->with('mapel', $mapel)
            ->with('kelasSearch', $kelasSearch)
            ->with('mapelSearch', $mapelSearch)
            ->with('pertemuan', $getPertemuan)
            ->with('folder', $this->folder);
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
