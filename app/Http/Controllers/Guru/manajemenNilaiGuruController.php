<?php

namespace App\Http\Controllers\Guru;

use App\Models\Mapel;
use App\Models\tugasSiswa;
use Illuminate\Http\Request;

class manajemenNilaiGuruController extends GuruController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->img = $this->imageHeader();
        $name = auth()->user()->nama_lengkap;

        // get kelas yang guru ajar
        $resultMapel = new Mapel();
        $KelasGuru = $resultMapel->getKelasGuruWhereNameGuru($name);

        // get mapel yang guru ajar
        $mapelGuru = $resultMapel->getMapelGuruWhereNameGuru($name);

        return view('guru.manajemen-nilai.index')
            ->with('title', $this->title = 'Manajemen Nilai')
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('kelas', $KelasGuru)
            ->with('mapel', $mapelGuru)
            ->with('jenisGuru', $this->jenisGuru())

            ->with('folder', $this->folder);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    public function show(Request $r, string $id)
    {

        if ($r->kelas && $r->mapel) {

            $resultKelas = explode('-', $r->kelas);
            $kelas = $resultKelas[0]; // Bagian pertama
            $rombel = $resultKelas[1]; // Bagian kedua

            $resultMapel = explode('-', $r->mapel);
            $mapel = $resultMapel[0]; // Bagian pertama
            $hari = $resultMapel[1]; // Bagian kedua

        } else {

            return redirect()->back();
        }

        // get search mapel yang guru ajar

        $resultMapel = new Mapel();
        $searchMapel = $resultMapel->getMapelWhereKelasRombelMapelHari($kelas, $rombel, $mapel, $hari);

        $this->img = $this->imageHeader();
        $name = auth()->user()->nama_lengkap;

        // get kelas yang guru ajar
        $resultMapel = new Mapel();
        $KelasGuru = $resultMapel->getKelasGuruWhereNameGuru($name);

        // get mapel yang guru ajar
        $mapelGuru = $resultMapel->getMapelGuruWhereNameGuru($name);

        $nilai = [];

        foreach ($searchMapel as $m) {
            $id_siswa = $m->id_siswa;
            // get tugas siswa where pencarian berdasarkan id_siswa , mapel.nama dan mapel.hari

            $resultTugasSiswa = new tugasSiswa();
            $nilai[] = $resultTugasSiswa->getNilaiWhereIdSiswaMapelHari($id_siswa, $mapel, $hari);
        }

        return view('guru.manajemen-nilai.index')
            ->with('title', $this->title = 'Manajemen Nilai')
            ->with(
                'role',
                $this->role
            )
            ->with('route', $this->route)
            ->with('selectKelas', $r->kelas)
            ->with('selectMapel', $r->mapel)
            ->with('img', $this->img)
            ->with('kelas', $KelasGuru)
            ->with('mapel', $mapelGuru)
            ->with('nilai', $nilai)
            ->with('jenisGuru', $this->jenisGuru())
            ->with('searchMapel', $searchMapel)
            ->with('folder', $this->folder);
    }

    /**
     * Show the form for editing the specified resource.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     //
    // }
}
