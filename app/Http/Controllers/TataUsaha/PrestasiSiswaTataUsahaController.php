<?php

namespace App\Http\Controllers\TataUsaha;

use App\Models\Kelas;
use App\Models\PrestasiSiswa;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class PrestasiSiswaTataUsahaController extends TataUsahaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->img = $this->imageHeader();

        // get kelas
        $result = new Kelas();
        $kelas = $result->getKelasAll(['id', 'nama', 'rombel']);

        // get tahun ajaran
        $result = new TahunAjaran();
        $tahunAjaran = $result->getTahunAjaranAll();

        // get siswa
        $result = new Siswa();
        $siswa = $result->getSiswaAll([
            'siswa.id',
            'siswa.nama',
            'siswa.nisn',
            'kelas.nama as kelas',
            'kelas.rombel as rombel',
        ]);

        // prestasi siswa
        $result = new PrestasiSiswa();
        $prestasi = $result->getPrestasiSiswa([
            'siswa.*',
            'prestasi_siswa.id as id_prestasi',
            'prestasi_siswa.id_siswa',
            'prestasi_siswa.nama as prestasi',
            'prestasi_siswa.status',
            'prestasi_siswa.prediket',
            'prestasi_siswa.foto as prestasi_foto',
            'prestasi_siswa.id_tahun_ajaran',
            'prestasi_siswa.tanggal',
            'tahun_ajaran.tahun_ajaran as tahun_ajaran',
        ]);

        return view('tataUsaha.prestasi-siswa.index')
            ->with('title', 'Prestasi Siswa')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('kelas', $kelas)
            ->with('tahunAjaran', $tahunAjaran)
            ->with('siswa', $siswa)
            ->with('prestasi', $prestasi)
            ->with('route', $this->route);
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
    public function store(Request $request)
    {

        // get tahun ajaran
        $result = new TahunAjaran();
        $gettahunAjaran = $result->getTahunAjaran();

        $request->validate([

            'foto' => 'mimes:jpg,jpeg,png|max:10000|required',
        ]);

        try {

            $foto = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $request->file('foto')->getClientOriginalName());

            $data = [
                'id_siswa' => $request->id_siswa,
                'nama' => $request->nama_prestasi,
                'status' => $request->status,
                'tanggal' => $request->tanggal,
                'prediket' => $request->prediket,
                'foto' => $foto,
                'id_tahun_ajaran' => $gettahunAjaran->id,

            ];

            // insert data prestasi siswa
            $result = new PrestasiSiswa();
            $result->savePrestasiSiswa($data);

            // upload foto
            $result->uploadFotoPrestasiSiswa($request->file('foto'), $foto);

            return redirect('/tata-usaha/prestasi-siswa');
        } catch (\Throwable $th) {

            dd($th->getMessage());

            return back()
                ->with('warning', 'Data Prestasi Siswa Gagal Disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {

        if ($request->tahunAjaran == null && $request->kelas == null) {
            return back();
        }

        try {
            $search_tahunAjaran = $request->tahunAjaran;

            $pecah = explode('-', $request->kelas);
            $search_kelas = $pecah[0]; // "200402076"
            $search_rombel = $pecah[1]; // "6"
        } catch (\Throwable $th) {
            return back();
        }

        $this->img = $this->imageHeader();

        // get kelas
        $resultKelas = new Kelas();
        $kelas = $resultKelas->getKelasAll(['id', 'nama', 'rombel']);

        // get tahun ajaran
        $resultTahunAjaran = new TahunAjaran();
        $tahunAjaran = $resultTahunAjaran->getTahunAjaranAll();

        $resultSiswa = new Siswa();
        $getsiswa = $resultSiswa->getSiswaWhereKelasAndRombel([
            'siswa.id',
            'siswa.nama',
            'siswa.nisn',
            'kelas.nama as kelas',
            'kelas.rombel as rombel',
        ], $search_tahunAjaran, $search_kelas, $search_rombel);

        $siswa = $resultSiswa->getSiswaAll([
            'siswa.id',
            'siswa.nama',
            'siswa.nisn',
            'kelas.nama as kelas',
            'kelas.rombel as rombel',
        ]);

        // prestasi siswa
        $resultPrestasiSiswa = new PrestasiSiswa();
        $prestasi = $resultPrestasiSiswa->getPrestasiSiswa([
            'siswa.*',
            'prestasi_siswa.id as id_prestasi',
            'prestasi_siswa.id_siswa',
            'prestasi_siswa.nama as prestasi',
            'prestasi_siswa.status',
            'prestasi_siswa.prediket',
            'prestasi_siswa.foto as prestasi_foto',
            'prestasi_siswa.id_tahun_ajaran',
            'prestasi_siswa.tanggal',
            'tahun_ajaran.tahun_ajaran as tahun_ajaran',
        ]);

        return view('tataUsaha.prestasi-siswa.index')
            ->with('title', 'Prestasi Siswa')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('kelas', $kelas)
            ->with('tahunAjaran', $tahunAjaran)
            ->with('siswaSearch', $getsiswa)
            ->with('siswa', $siswa)
            ->with('prestasi', $prestasi)
            ->with('search_kelas', $request->kelas)
            ->with('search_tahunAjaran', $request->tahunAjaran)
            ->with('route', $this->route);
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
    // public function update(Request $request, string $id_siswa)
    // {
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $result = new PrestasiSiswa();
            $result->deletePrestasiSiswa($id);

            return redirect('/tata-usaha/prestasi-siswa')->with('warning', 'Data Prestasi Siswa Berhasil Dihapus');
        } catch (\Throwable $th) {
           return back();
        }
      
    }
}
