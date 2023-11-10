<?php

namespace App\Http\Controllers\Guru;

use App\Models\RekapNilaiSiswa;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\tugasSiswa;
use Illuminate\Http\Request;

class RekapNilaiGuruController extends GuruController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->img = $this->imageHeader();

        $id = Auth()->user()->id;

        $resultSiswa = new Siswa();
        $siswa = $resultSiswa->getSiswaWhereIdUserGuru([
            'siswa.id',
            'siswa.nama',
        ], $id);

        return view('guru.rekap-nilai.index')
            ->with('title', $this->title = 'Rekap Nilai')
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('siswa', $siswa)
            ->with('jenisGuru', $this->jenisGuru())

            ->with('folder', $this->folder);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $r)
    {

        $name_siswaSearch = $r->siswa;
        $this->img = $this->imageHeader();

        $id = Auth()->user()->id;

        $resultSiswa = new Siswa();
        $siswa = $resultSiswa->getSiswaWhereIdUserGuru([
            'siswa.id',
            'siswa.nama',
        ], $id);

        $resultSiswa = new Siswa();
        $siswaSearch = $resultSiswa->firstSiswaWhereIdUserGuruAndNameSiswa($id, $name_siswaSearch);

        $resultTugasSiswa = new tugasSiswa();
        $rekapNilai = $resultTugasSiswa->getRekapNilaiSiswaWhereNameSiswa($name_siswaSearch);

        $rekapNilaiAkhir = []; // Inisialisasi variabel

        if ($rekapNilai == '[]') {
        } else {

            foreach ($rekapNilai as $rn) {
                $id_siswa = $rn->id_siswa;
                $id_mapel = $rn->id_mapel;

                $resultRekapNilai = new RekapNilaiSiswa();
                $rekapNilaiAkhir[] = $resultRekapNilai->getRekapNilaiSiswaWhereIdSiswaAndIdMapel($id_siswa, $id_mapel);

            }

        }

        return view('guru.rekap-nilai.index')
            ->with('title', $this->title = 'Rekap Nilai')
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('siswa', $siswa)
            ->with('name_siswaSearch', $name_siswaSearch)
            ->with('siswaSearch', $siswaSearch)
            ->with('rekapNilaiAkhir', $rekapNilaiAkhir)
            ->with('rekapNilai', $rekapNilai)
            ->with('jenisGuru', $this->jenisGuru())

            ->with('folder', $this->folder);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $id_mapel = $request->id_mapel;
        $id_siswa = $request->id_siswa;
        $catatan = $request->catatan;
        $total_nilai = $request->total_nilai;
        $rata_rata = $request->rata_rata;

        // get tahun ajaran terbaru
        $resultTahunAjaran = new TahunAjaran();
        $tahunAjaran = $resultTahunAjaran->getTahunAjaran();

        if ($request->update == true) {

            $data = [

                'catatan' => $catatan,
            ];

            $resulRekapNilaiSiswa = new RekapNilaiSiswa();
            $resulRekapNilaiSiswa->UpdateRekapNilaiSiswa($data, $id_siswa, $id_mapel);

        } else {

            $data = [
                'id_siswa' => $id_siswa,
                'id_mapel' => $id_mapel,
                'total_nilai' => $total_nilai,
                'rata_rata' => $rata_rata,
                'catatan' => $catatan,
                'id_tahun_ajaran' => $tahunAjaran->id,
            ];

            $resulRekapNilaiSiswa = new RekapNilaiSiswa();
            $resulRekapNilaiSiswa->saveRekapNilaiSiswa($data);

        }

        return back()->with('success', 'Data berhasil disimpan');
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
