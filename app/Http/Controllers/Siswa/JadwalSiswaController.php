<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Calender;
use App\Models\Mapel;
use App\Models\Pemasukan;
use App\Models\Pertemuan;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\tugasSiswa;
use Illuminate\Http\Request;

class JadwalSiswaController extends SiswaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $id_user = Auth()->user()->id;

        // get siswa where id kelas
        $result = new Siswa();
        $getidKelas = $result->getIdKelas($id_user);

        // get first tahun ajaran terkini
        $resultTahunAjaran = new TahunAjaran();
        $tahunAjaranFirst = $resultTahunAjaran->getTahunAjaran();

        // get mapel where id_kelas
        $resultMapel = new Mapel();
        $getMapel = $resultMapel->getMapelWhereIdkelas($getidKelas->id_kelas, $tahunAjaranFirst->id);

        // get tahun ajaran
        $tahunAjaranAll = $resultTahunAjaran->getTahunAjaranAll();

        // akses kunci

        date_default_timezone_set('Asia/Jakarta'); // Set zona waktu ke Waktu Indonesia Barat

        setlocale(LC_TIME, 'id_ID');

        $tanggalNow = date('Y-m-d');

        $bulanNow = date('m');

        // tahun ajaran sekarnag
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
            $kunci = $resultPemasukan->getKunciAkunSiswa($id_user);
        } else {
            $kunci = null;
        }

        // akses kunci
        
        return view('siswa.jadwal.index')
            ->with('title', 'Jadwal')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('mapel', $getMapel)
            ->with('kunci', $kunci)
            ->with('tahunAjaranFirst', $tahunAjaranFirst)
            ->with('tahunAjaran', $tahunAjaranAll)
            ->with('route', $this->route);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $r)
    {

        $SearchtahunAjaran = $r->tahun_ajaran;
        $Searchhari = $r->hari;

        $id_user = Auth()->user()->id;

        // get siswa where id kelas
        $result = new Siswa();
        $getidKelas = $result->getIdKelas($id_user);

        $resultMapel = new Mapel();
        $searchMapel = $resultMapel->searchMapelWheretahunAjaranAndHari($SearchtahunAjaran, $Searchhari, $getidKelas->id_kelas);

        // get tahun ajaran
        $resultTahunAjaran = new TahunAjaran();
        $tahunAjaranAll = $resultTahunAjaran->getTahunAjaranAll();

        // akses kunci

        date_default_timezone_set('Asia/Jakarta'); // Set zona waktu ke Waktu Indonesia Barat

        setlocale(LC_TIME, 'id_ID');

        $tanggalNow = date('Y-m-d');

        $bulanNow = date('m');

        // tahun ajaran sekarnag
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
            $kunci = $resultPemasukan->getKunciAkunSiswa($id_user);
        } else {
            $kunci = null;
        }

        // akses kunci

        return view('siswa.jadwal.index')
            ->with('title', 'Jadwal')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('mapel', $searchMapel)
            ->with('tahunAjaran', $tahunAjaranAll)
            ->with('searchTahunAjaran', $SearchtahunAjaran)
            ->with('searchHari', $Searchhari)
            ->with('kunci', $kunci)

            ->with('route', $this->route);
    }

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
    public function show(string $kode)
    {

        $id_user = Auth()->user()->id;

        // get siswa where id kelas
        $result = new Siswa();
        $getidKelas = $result->getIdKelas($id_user);

        // get mapel where kode first
        $resultMapel = new Mapel();
        $getMapel = $resultMapel->getMapelWhereKode($kode);

        // get pertemuan where id_kelas
        $resultPertemuan = new Pertemuan();
        $getPertemuan = $resultPertemuan->getPertemuanWhereIdKelas($kode, $getidKelas->id_kelas);

        // get tugas siswa where pertemuan and id siswa

        // get tugas siswa where pertemuan and id siswa

        $resultSiswa = new Siswa();
        $siswa = $resultSiswa->getIdSiswa('siswa.id', $id_user);
        $resultTugasSiswa = new tugasSiswa();
        $tugas = $resultTugasSiswa->getTugasSiswaWhereIdSiswaAndWhereIdMapel($siswa->id, $getMapel->id);

        $resultCalender = new Calender();
        $tanggal = $resultCalender->convertDateToBahasaIndonesia($getPertemuan);

        return view('siswa.jadwal.show')
            ->with('title', $this->title = 'Jadwal')
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('pertemuan', $getPertemuan)
            ->with('mapel', $getMapel)
            ->with('tugas', $tugas)
            ->with('tanggal', $tanggal['tanggal'])
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

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }

    public function detailMapel(string $kodemapel)
    {

        $parts = explode('-', $kodemapel);
        $kode_mapel = $parts[0];
        $id_pertemuan = $parts[1];

        //    get mapel berdasarkan where kode mapel
        $result = new Mapel();
        $getMapel = $result->pertemuan($kode_mapel);

        // get pertemuan where kode mapel
        $resultPertemuan = new Pertemuan();
        $getPertemuan = $resultPertemuan->getPertemuanWhereIdPertemuan($id_pertemuan);

        // get tugas siswa where pertemuan and id siswa
        $id_user = Auth()->user()->id;

        $resultSiswa = new Siswa();
        $siswa = $resultSiswa->getIdSiswa('siswa.id', $id_user);
        $resultTugasSiswa = new tugasSiswa();
        $tugas = $resultTugasSiswa->getTugasSiswaWhereIdPertemuanAndIdSiswa($id_pertemuan, $siswa->id);

        return view('siswa.jadwal.pertemuan')
            ->with('title', $this->title = 'Jadwal')
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('mapel', $getMapel)
            ->with('kode', $kodemapel)
            ->with('pertemuan', $getPertemuan)
            ->with('tugas', $tugas)
            ->with('folder', $this->folder);
    }

    public function uploadTugas(Request $r, string $kode)
    {

        $r->validate([

            'file_tugas' => 'required',
        ]);

        if ($r->hasfile('file_tugas')) {

            $id_user = Auth()->user()->id;

            $resultSiswa = new Siswa();
            $siswa = $resultSiswa->getIdSiswa('siswa.id', $id_user);

            $parts = explode('-', $kode);
            $kode_mapel = $parts[0];
            $id_pertemuan = $parts[1];

            // cek status pengiriman tugas

            date_default_timezone_set('Asia/Jakarta'); // Set zona waktu ke Waktu Indonesia Barat

            setlocale(LC_TIME, 'id_ID'); // Set lokal ke Bahasa Indonesia

            $datenow = date('Y-m-d H:i:s');

            if ($datenow <= $r->tanggal_tugas) {
                $status = 'Tepat Waktu';
            } else {
                $status = 'Telambat';
            }

            $file_tugas = $r->file('file_tugas');
            $filename = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $file_tugas->getClientOriginalName());

            $data = [
                'id_siswa' => $siswa->id,
                'id_pertemuan' => $id_pertemuan,
                'file_tugas' => $filename,
                'status' => $status,
                'nilai' => null,
            ];

            $result = new tugasSiswa();
            $result->uploadTugasSiswa($file_tugas, $filename);
            $result->saveTugasSiswa($data);

            return redirect('siswa/jadwal/cek/'.$kode)->with('success', 'Tugas berhasil diupload!');
        } else {
            return back()->with('error', 'File Tugas Tidak Boleh Kosong');
        }
    }
}
