<?php

namespace App\Http\Controllers\Guru;

use App\Models\AbsenSiswa;
use App\Models\Kinerja;
use App\Models\Mapel;
use App\Models\Pertemuan;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\tugasSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JadwalGuruController extends GuruController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //    ---------------------------------------------------------

        $this->img = $this->imageHeader();
        $id_user = Auth()->user()->id;

        $result = new Mapel();
        $getKelas = $result->ViewMapelWhereGuru($id_user);

        // get tahun ajaran
        $resultTahunAjaran = new TahunAjaran();
        $tahunAjaran = $resultTahunAjaran->getTahunAjaranAll();

        return view('guru.jadwal.index')
            ->with('title', $this->title = 'Jadwal')
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('kelas', $getKelas)
            ->with('tahunAjaran', $tahunAjaran)
            ->with('jenis', $this->jenisGuru())

            ->with('folder', $this->folder);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $r)
    {

        $SearchtahunAjaran = $r->tahun_ajaran;
        $Searchhari = $r->hari;

        $this->img = $this->imageHeader();
        $id_user = Auth()->user()->id;

        $resultMapel = new Mapel();
        $searchMapel = $resultMapel->searchMapelWhereTahunAjaranAndHariAndIdUserGuru($SearchtahunAjaran, $Searchhari, $id_user);

        // get tahun ajaran
        $resultTahunAjaran = new TahunAjaran();
        $tahunAjaran = $resultTahunAjaran->getTahunAjaranAll();

        return view('guru.jadwal.index')
            ->with('title', 'Jadwal')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('kelas', $searchMapel)
            ->with('tahunAjaran', $tahunAjaran)
            ->with('searchTahunAjaran', $SearchtahunAjaran)
            ->with('searchHari', $Searchhari)
            ->with('jenis', $this->jenisGuru())
            ->with('route', $this->route);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kode)
    {

        $this->img = $this->imageHeader();
        $id_user = Auth()->user()->id;

        // get mapel
        $result = new Mapel();
        $getMapel = $result->ViewMapelFirst($id_user, $kode);

        // get pertemuan
        $result = new Pertemuan();
        $getPertemuan = $result->getPertemuan($getMapel->id, $getMapel->id_kelas);

        return view('guru.jadwal.show')
            ->with('title', $this->title = 'Jadwal')
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('mapel', $getMapel)
            ->with('pertemuan', $getPertemuan)
            ->with('jenis', $this->jenisGuru())
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

    public function detailMapel(string $jenis, string $kodemapel)
    {

        $this->img = $this->imageHeader();

        $parts = explode('-', $kodemapel);
        $kode_mapel = $parts[0];
        $id_pertemuan = $parts[1];

        //    get mapel berdasarkan where kode mapel
        $result = new Mapel();
        $getMapel = $result->pertemuan($kode_mapel);

        // get pertemuan where kode mapel
        $resultPertemuan = new Pertemuan();
        $getPertemuan = $resultPertemuan->getPertemuanWhereIdPertemuan($id_pertemuan);

        // get siswa berdasarkan id_kelas
        $resultSiswa = new Siswa();
        $getSiswa = $resultSiswa->getSiswaByKelas([
            'siswa.*',
            'kelas.nama as kelas',
            'kelas.rombel',

        ], $getMapel->id_kelas);

        // get tugas siswa berdasarkan id_pertemuan
        $resultTugasSiswa = new tugasSiswa();
        $getTugasSiswa = $resultTugasSiswa->getTugasSiswaWhereIdPertemuan($id_pertemuan);

        // get absensi siswa
        $resultAbsenSiswa = new AbsenSiswa();
        $getAbsenSiswa = $resultAbsenSiswa->getAbsenSiswaWhereIdPertemuan($id_pertemuan);

        // get tugas siswa
        $resultTugasSiswa = new tugasSiswa();
        $getTugasSiswa = $resultTugasSiswa->getTugasSiswaWhereIdPertemuan($id_pertemuan);
        $getTugasSiswaFirst = $resultTugasSiswa->getTugasSiswaWhereIdPertemuanFirst($id_pertemuan);

        $user_id = Auth()->user()->id;

        return view('guru.jadwal.pertemuan')
            ->with('title', $this->title = 'Jadwal')
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('mapel', $getMapel)
            ->with('kode', $kodemapel)
            ->with('pertemuan', $getPertemuan)
            ->with('siswa', $getSiswa)
            ->with('tugasSiswa', $getTugasSiswa)
            ->with('jenisPertemuan', $jenis)
            ->with('absen', $getAbsenSiswa)
            ->with('tugas', $getTugasSiswa)
            ->with('tugasSiswa', $getTugasSiswaFirst)
            ->with('jenis', $this->jenisGuru())
            ->with('folder', $this->folder);
    }

    public function uploadMateri(Request $r, string $kode_p)
    {
        $resultKinerja = new Kinerja();
        $point = $resultKinerja->kinerjaUploadMateri($r->nama_materi, $r->tanggal, $r->keterangan_materi, $r->file_materi);

        $parts = explode('-', $kode_p);
        $kode = $parts[0];
        $pertemuan = $parts[1];

        // get id mapel
        $result = new Mapel();
        $get_id_mapel = $result->pertemuan($kode);
        $id_mapel = $get_id_mapel->id;

        if ($r->file('file_materi')) {

            $file_materi = $r->file('file_materi');
            $filename = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $file_materi->getClientOriginalName());

            $data = [

                'nama_materi' => ucwords($r->nama_materi),
                'deskripsi_materi' => ucwords($r->keterangan_materi),
                'file_materi' => $filename,
                'tanggal_materi' => $r->tanggal,
                'poin_upload_materi' => $point,

            ];
            // simpan file materi
            $this->uploadMateriGuru($pertemuan, $file_materi, $filename);
        } else {

            $data = [

                'nama_materi' => ucwords($r->nama_materi),
                'deskripsi_materi' => ucwords($r->keterangan_materi),
                'tanggal_materi' => $r->tanggal,
                'poin_upload_materi' => $point,

            ];
        }

        // update pertemuan
        $result = new Pertemuan();
        $result->saveMateri($data, $pertemuan, $id_mapel);

        return redirect('guru/jadwal/cek/materi/'.$kode_p)->with('success', 'Materi berhasil diupload!');
    }

    public function uploadTugas(Request $r, string $kode_p)
    {

        $resultKinerja = new Kinerja();
        $point = $resultKinerja->kinerjaUploadTugas($r->nama_tugas, $r->deadline_tugas, $r->deskripsi_tugas, $r->file_tugas);

        $parts = explode('-', $kode_p);
        $kode = $parts[0];
        $pertemuan = $parts[1];

        // get id mapel
        $result = new Mapel();
        $get_id_mapel = $result->pertemuan($kode);
        $id_mapel = $get_id_mapel->id;

        if ($r->file('file_tugas')) {

            $file_tugas = $r->file('file_tugas');
            $filename = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $file_tugas->getClientOriginalName());

            $data = [

                'nama_tugas' => ucwords($r->nama_tugas),
                'deskripsi_tugas' => ucwords($r->deskripsi_tugas),
                'file_tugas' => $filename,
                'tanggal_tugas' => $r->deadline_tugas,
                'poin_upload_tugas' => $point,

            ];

            // simpan file materi
            $this->uploadTugasGuru($pertemuan, $file_tugas, $filename);
        } else {

            $data = [

                'nama_tugas' => ucwords($r->nama_tugas),
                'deskripsi_tugas' => ucwords($r->deskripsi_tugas),
                'tanggal_tugas' => $r->deadline_tugas,
                'poin_upload_tugas' => $point,

            ];
        }

        // update pertemuan
        $result = new Pertemuan();
        $result->saveMateri($data, $pertemuan, $id_mapel);

        return redirect('guru/jadwal/cek/materi/'.$kode_p)->with('success', 'Tugas Berhasil Diupload!');
    }

    public function absen(Request $r, string $kode_p, string $id_siswa)
    {

        if ($r->status_absensi == null) {
            return back();
        }

        $parts = explode('-', $kode_p);
        $kode = $parts[0];
        $pertemuan = $parts[1];

        $data = [
            'id_siswa' => $id_siswa,
            'id_pertemuan' => $pertemuan,
            'waktu' => date('Y-m-d H:i:s'),
            'status' => $r->status_absensi,
        ];

        if (AbsenSiswa::where('id_siswa', $id_siswa)->where('id_pertemuan', $pertemuan)->exists()) {
            $result = new AbsenSiswa();
            $result->UpdateAbsenSiswa($data, $id_siswa, $pertemuan);
        } else {

            $result = new AbsenSiswa();
            $result->saveAbsenSiswa($data);
        }

        return redirect('guru/jadwal/cek/absensi/'.$kode_p)->with('success', 'Absensi Berhasil Disimpan!');
    }

    public function nilai(Request $r, string $kode_p, string $id_siswa)
    {

        $parts = explode('-', $kode_p);
        $kode = $parts[0];
        $pertemuan = $parts[1];

        $data = [
            'nilai' => $r->nilai_tugas,
        ];

        $result = new tugasSiswa();
        $result->saveNilaiSiswa($data, $id_siswa, $pertemuan);

        return redirect('guru/jadwal/cek/nilai/'.$kode_p)->with('success', 'Nilai Berhasil Disimpan!');
    }
}
