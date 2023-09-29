<?php

namespace App\Http\Controllers\SuperUser;

use App\Models\Kelas;
use App\Models\RekapNilaiSiswa;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class NilaiSiswaSuperUserController extends SuperUserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resultTahunAjaran = new TahunAjaran();
        $resultKelas = new Kelas();

        // get tahun ajaran
        $tahunAjaran = $resultTahunAjaran->getTahunAjaranAll();
        // get kelas
        $kelas = $resultKelas->getKelasAll(['id', 'nama', 'rombel']);
        // get rombel

        return view('superuser.nilai-siswa.index')
            ->with('title', $this->title = 'Nilai Siswa')
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('tahunAjaran', $tahunAjaran)
            ->with('kelas', $kelas)

            ->with('folder', $this->folder);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $r)
    {
        $resultTahunAjaran = new TahunAjaran();
        $resultKelas = new Kelas();
        $resultRekapNilaiSiswa = new RekapNilaiSiswa();

        // get tahun ajaran
        $tahunAjaran = $resultTahunAjaran->getTahunAjaranAll();
        // get kelas
        $kelas = $resultKelas->getKelasAll(['id', 'nama', 'rombel']);
        // get rombel

        $idTahunAjaran = $r->tahunAjaran;
        $idKelas = $r->kelas;

        // get siswa where id tahun ajaran and id kelas
        $resultSiswa = new Siswa();
        $siswa = $resultSiswa->getSiswaWhereIdTahunAjaranAndIdkelas(['siswa.id', 'siswa.nama', 'siswa.nisn'], $idTahunAjaran, $idKelas);

        $tahunAjaranSearch = $resultTahunAjaran->getTahunAjaranWhereId($idTahunAjaran);
        $kelasSearch = $resultKelas->firstKelasWhereIdKelas($idKelas);
        $raport = $resultRekapNilaiSiswa->getRekapNilaiSiswaAll();

        return view('superuser.nilai-siswa.index')
            ->with('title', $this->title = 'Nilai Siswa')
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('tahunAjaran', $tahunAjaran)
            ->with('kelas', $kelas)
            ->with('siswa', $siswa)
            ->with('tahunAjaranSearch', $tahunAjaranSearch)
            ->with('kelasSearch', $kelasSearch)
            ->with('raport', $raport)
            ->with('folder', $this->folder);
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
