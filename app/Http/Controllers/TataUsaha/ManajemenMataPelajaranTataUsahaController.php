<?php

namespace App\Http\Controllers\TataUsaha;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Pertemuan;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class ManajemenMataPelajaranTataUsahaController extends TataUsahaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->img = $this->imageHeader();

        // get guru
        $result = new Guru();
        $getGuru = $result->viewGuru(['id', 'nama', 'bidang_studi']);

        // get kelas
        $result = new Kelas();
        $getKelas = $result->getKelasAll(['id', 'nama', 'rombel']);
        // get mapel
        $result = new Mapel();
        $getMapel = $result->viewMapel([
            'mapel.*',
            'kelas.nama as kelas',
            'kelas.rombel as rombel',
            'guru.nama as guru',
            'tahun_ajaran.tahun_ajaran',

        ])->paginate(10);

        // tahun ajaran
        $tahun_mulai = date('Y');
        $tahun_selesai = date('Y') + 1;

        return view('tataUsaha.jadwal-kelas.index')
            ->with('title', 'Manajemen Mata Pelajaran')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('route', $this->route)
            ->with('guru', $getGuru)
            ->with('mapel', $getMapel)
            ->with('tahun_mulai', $tahun_mulai)
            ->with('tahun_selesai', $tahun_selesai)
            ->with('kelas', $getKelas);
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

        try {

            $string = $request->hari;
            $hari = substr($string, 0, 3);

            // tahun ajaran
            $tahunMulai = $request->tahun_mulai;
            $tahunSelesai = $request->tahun_selesai;

            $bagianTahunMulai = substr($tahunMulai, 2, 2); // Mengambil 2 karakter, dimulai dari indeks 2
            $bagianTahunSelesai = substr($tahunSelesai, 2, 2); // Mengambil 2 karakter, dimulai dari indeks 2

            // mengambil detik
            $waktu = time(); // Mengambil waktu saat ini

            $detik = date('s', $waktu);

            // kode =  hari + tahun ajaran
            $kode = strtoupper($hari).$bagianTahunMulai.$bagianTahunSelesai.$detik;

            // jika tahun ajaran belum ada di database tahun ajaran
            if (! TahunAjaran::where('tahun_ajaran', $tahunMulai.'-'.$tahunSelesai)->exists()) {
                // return redirect('/tata-usaha/manajemen-mata-pelajaran')->with('error', 'Tahun Ajaran Sudah Ada');
                // save tahun ajaran
                $tahunAjaran = $tahunMulai.'-'.$tahunSelesai;

                $dataTahunAjaran = [
                    'tahun_ajaran' => $tahunAjaran,
                ];
                $result = new TahunAjaran();
                $result->saveTahunAjaran($dataTahunAjaran);
            }

            $result = new TahunAjaran();

            $getLastIdTahunAjaran = $result->getTahunAjaran();

            $data = [
                'kode' => $kode,
                'nama' => ucwords($request->mata_pelajaran),
                'hari' => ucwords($request->hari),
                'KKM' => null,
                'waktu_mulai' => $request->jam_mulai,
                'waktu_selesai' => $request->jam_selesai,
                'id_guru' => $request->id_guru,
                'id_kelas' => $request->id_kelas,
                'id_tahun_ajaran' => $getLastIdTahunAjaran->id,

            ];

            // fitur bentrok mapel

            $hari = ucwords($request->hari);
            $waktu_mulai = $request->jam_mulai;
            $waktu_selesai = $request->jam_selesai;
            $id_kelas = $request->id_kelas;

            // dd($waktu_selesai);

            // waktu hari di jam sekolah jam 07.00 am - 05.00 pm diluar dari itu error

            if (! ($waktu_mulai >= '07:00' && $waktu_selesai <= '17:00')) {

                return back()->with('error', 'Jadwal Mapel Berada Diluar Jam Sekolah');
            }

            $resultMapel = new Mapel();
            $mapel = $resultMapel->firstMapeWhereHariAndWaktu($hari, $waktu_mulai, $waktu_selesai, $id_kelas, $getLastIdTahunAjaran->id);

            if ($mapel) {
                return back()->with('error', 'Bentrok ! Mata Pelajaran Sudah Ada');
            }

            // akhir

            // save mata pelajaran
            $resultMapel = new Mapel();
            $resultMapel->saveMapel($data);

            // get id mapel
            $id_mapel = $resultMapel->getLastInsertIdMapel();

            // save 100 pertemuan
            for ($i = 1; $i <= 100; $i++) {

                $dataPertemuan = [
                    'pertemuan_ke' => $i,
                    'id_mapel' => $id_mapel->id,
                    'jenis' => null,
                    'nama_materi' => null,
                    'deskripsi' => null,
                    'file' => null,
                    'tanggal' => null,
                ];
                $resultPertemuan = new Pertemuan();
                $resultPertemuan->savePertemuan($dataPertemuan);
            }

            return redirect('/tata-usaha/manajemen-mata-pelajaran')->with('success', 'Mata Pelajaran Berhasil Ditambah');
        } catch (\Throwable $th) {

            dd($th->getMessage());

            return redirect('/tata-usaha/manajemen-mata-pelajaran')->with('error', 'Mata Pelajaran Gagal Ditambah');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $r, string $id)
    {

        try {
            $parts = explode('-', $r->kelas);
            $kelas = $parts[0];
            $rombel = $parts[1];
            $hari = $r->hari;
            $isShow = true;
        } catch (\Throwable $th) {

            dd($th->getMessage());

            return back()->with('error', 'Data Tidak Ditemukan');
        }

        $result = new Mapel();
        $searchMapel = $result->searchMapel([
            'mapel.*',
            'kelas.nama as kelas',
            'kelas.rombel as rombel',
            'guru.nama as guru',
            'tahun_ajaran.tahun_ajaran',

        ], $kelas, $rombel, $hari)->paginate(10);

        $this->img = $this->imageHeader();

        // get guru
        $result = new Guru();
        $getGuru = $result->viewGuru(['id', 'nama', 'bidang_studi']);

        // get kelas
        $result = new Kelas();
        $getKelas = $result->getKelasAll(['id', 'nama', 'rombel']);

        // tahun ajaran
        $tahun_mulai = date('Y');
        $tahun_selesai = date('Y') + 1;

        return view('tataUsaha.jadwal-kelas.index')
            ->with('title', 'Manajemen Mata Pelajaran')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('route', $this->route)
            ->with('guru', $getGuru)
            ->with('mapel', $searchMapel)
            ->with('tahun_mulai', $tahun_mulai)
            ->with('tahun_selesai', $tahun_selesai)
            ->with('kelas', $getKelas)
            ->with('searchKelas', $kelas)
            ->with('searchRombel', $rombel)
            ->with('searchHari', $hari)
            ->with('isShow', $isShow);

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

        $string = $request->hari;
        $hari = substr($string, 0, 3);

        // tahun ajaran
        $tahunMulai = $request->tahun_mulai;
        $tahunSelesai = $request->tahun_selesai;

        $bagianTahunMulai = substr($tahunMulai, 2, 2); // Mengambil 2 karakter, dimulai dari indeks 2
        $bagianTahunSelesai = substr($tahunSelesai, 2, 2); // Mengambil 2 karakter, dimulai dari indeks 2

        // mengambil detik
        $waktu = time(); // Mengambil waktu saat ini

        $detik = date('s', $waktu);

        // kode =  hari + tahun ajaran
        $kode = strtoupper($hari).$bagianTahunMulai.$bagianTahunSelesai.$detik;

        $data = [
            'kode' => $kode,
            'nama' => ucwords($request->mata_pelajaran),
            'hari' => ucwords($request->hari),
            'waktu_mulai' => $request->jam_mulai,
            'waktu_selesai' => $request->jam_selesai,
            'id_guru' => $request->id_guru,
            'id_kelas' => $request->id_kelas,

        ];

        // save mata pelajaran
        $result = new Mapel();
        $result->updateMapel($data, $id);

        return redirect('/tata-usaha/manajemen-mata-pelajaran')->with('success', 'Mata Pelajaran Berhasil Ditambah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $result = new Mapel();
        $result->deleteMapel($id);

        return redirect('/tata-usaha/manajemen-mata-pelajaran')->with('success', 'Mata Pelajaran Berhasil Dihapus');
    }
}
