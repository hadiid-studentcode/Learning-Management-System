<?php

namespace App\Http\Controllers\TataUsaha;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class ManajemenKelasTataUsahaController extends TataUsahaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->img = $this->imageHeader();

        // get guru
        $result = new Guru();
        // $getGuru = $result->viewGuru(['id', 'nama']);

        // tampilakan guru yang sudah jadi wali kelas

        $guruNonWalas = $result->viewGuruNonWaliKelas();

        // get kelas
        $result = new Kelas();
        // get jumlah siswa yang diambil dari model siswa
        $getKelas = $result->getkelas();

        // kondisi jika siswa belum memilih kelas

        return view('tataUsaha.manajemen-kelas.index')
            ->with('title', 'Manajemen Kelas')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('guruNonWalas', $guruNonWalas)
            // ->with('guru', $getGuru)
            ->with('getKelas', $getKelas)
            ->with('route', $this->route);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $kelas = $request->input('kelas');
        $rombel = $request->input('rombel');
        $id_guru = $request->input('id_guru');
        $kouta = $request->input('kouta_siswa');
        $result = new TahunAjaran();
        $id_tahun_ajaran = $result->getTahunAjaran();

        if ($id_guru == null) {
            $id_guru = null;
        }

        $data = [
            'nama' => $kelas,
            'rombel' => ucfirst($rombel),
            'id_guru' => $id_guru,
            'kouta_siswa' => $kouta,
            'jumlah_siswa' => 0,
            'id_tahun_ajaran' => $id_tahun_ajaran->id,
        ];

        // Cek apakah rombel sudah ada di database
        $rombelSudahAda = Kelas::where('rombel', ucfirst($rombel))->exists();

        if ($rombelSudahAda) {
            return redirect('/tata-usaha/manajemen-kelas')->with('error', 'Rombel sudah ada');
        }

        $result = new Kelas();
        $result->tambahKelas($data);

        // update jenis guru menjadi jadi wali kelas
        $result = new Guru();
        $result->updateGuru($id_guru, ['jenis' => 'Wali Kelas']);

        return redirect('/tata-usaha/manajemen-kelas')->with('success', 'Data Kelas Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'nama' => $request->kelas,
            'rombel' => $request->rombel,
            'id_guru' => $request->id_guru,
            'kouta_siswa' => $request->kouta_siswa,
        ];
        $resultKelas = new Kelas();

        // get id_guru wali kelas lama
        $id_guru = $resultKelas->getWaliKelasLama($id);

        // ganti guru wali kelas menjadi non walikelas
        $resultGuru = new Guru();
        $resultGuru->updateGuru($id_guru->id_guru, ['jenis' => 'Non Wali Kelas']);

        // update jenis guru sudah jadi wali kelas

        $resultGuru->updateGuru($request->id_guru, ['jenis' => 'Wali Kelas']);

        $resultKelas->updateKelas($data, $id);

        return redirect('/tata-usaha/manajemen-kelas')->with('success', 'Data Kelas Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $resultKelas = new Kelas();

            // get id_guru wali kelas lama
            $id_guru = $resultKelas->getWaliKelasLama($id);

            // ganti guru wali kelas menjadi non walikelas
            $resultGuru = new Guru();
            $resultGuru->updateGuru($id_guru->id_guru, ['jenis' => 'Non Wali Kelas']);

            $result = new Kelas();
            $result->deleteKelas($id);

            return redirect('/tata-usaha/manajemen-kelas')->with('success', 'Data Kelas Berhasil Dihapus');
        } catch (\Throwable $th) {
            return back();
        }

    }
}
