<?php

namespace App\Http\Controllers\WaliMurid;

use App\Models\Kelas;
use App\Models\RekapNilaiSiswa;
use App\Models\Siswa;
use App\Models\WaliMurid;
use Illuminate\Http\Request;

class RekapNilaiWaliMuridController extends WaliMuridController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->img = $this->imageHeader();
        $id_user = Auth()->user()->id;

        // get id siswa where id user wali murid
        $resultWaliMurid = new WaliMurid();
        $siswa = $resultWaliMurid->getIdSiswa($id_user);

        // get kelas siswa where id siswa
        $resultKelas = new Kelas();
        $kelas = $resultKelas->getKelasWhereIdSiswa($siswa->id_siswa);

        return view('waliMurid.rekap-nilai.index')
            ->with('title', $this->title = 'Rekap Nilai')
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('kelas', $kelas)
            ->with('id_siswa', $siswa->id_siswa)
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

        if ($r->kelas == null) {
            return back()->with('error', 'Silakan Pilih Kelas');
        }

        $id_siswa = $id;
        $id_kelas = $r->kelas;

        $resultRekapNilaiSiswa = new RekapNilaiSiswa();
        $rekapNilaiSiswa = $resultRekapNilaiSiswa->getRekapNilaiSiswaWhereIdSiswaAndIdKelas(
            [
                'mapel.nama',
                'mapel.KKM',
                'rekap_nilai_siswa.total_nilai as nilai',
                'rekap_nilai_siswa.rata_rata',
                'rekap_nilai_siswa.catatan',
            ],

            $id_siswa,
            $id_kelas

        );

        $this->img = $this->imageHeader();
        $id_user = Auth()->user()->id;

        // get id siswa where id user wali murid
        $resultWaliMurid = new WaliMurid();
        $siswa = $resultWaliMurid->getIdSiswa($id_user);

        // get kelas siswa where id siswa
        $resultKelas = new Kelas();
        $kelas = $resultKelas->getKelasWhereIdSiswa($siswa->id_siswa);

        // kelas search
        $kelasSearch = $resultKelas->firstKelasWhereIdKelas($id_kelas);

        // get siswa where id kelas yang dipilih

        $resultSiswa = new Siswa();
        $firstSiswa = $resultSiswa->firstSiswaWhereIdKelas($id_kelas);

        if ($firstSiswa == null) {
            $firstSiswa = $resultSiswa->firstSiswaWhereIdKelasNotGuru($id_kelas);
            $firstSiswa->guru = 'Belum Ada Wali Kelas';
        }

        return view('waliMurid.rekap-nilai.index')
            ->with('title', $this->title = 'Rekap Nilai')
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('kelas', $kelas)
            ->with('id_siswa', $siswa->id_siswa)
            ->with('rekapNilaiSiswa', $rekapNilaiSiswa)
            ->with('kelasSearch', $kelasSearch)
            ->with('siswa', $firstSiswa)
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
