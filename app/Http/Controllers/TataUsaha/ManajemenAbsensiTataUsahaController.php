<?php

namespace App\Http\Controllers\TataUsaha;

use App\Models\AbsenGuru;
use App\Models\AbsenPegawai;
use App\Models\KelolaAbsensi;
use Illuminate\Http\Request;

class ManajemenAbsensiTataUsahaController extends TataUsahaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $result = new KelolaAbsensi();
        $kelolaAbsensi = $result->getAbsensiAll();

        $this->img = $this->imageHeader();

        return view('tataUsaha.manajemen-absensi.index')
            ->with('title', 'Manajemen Absensi')
            ->with('role', $this->role)
            ->with('folder', $this->folder)
            ->with('img', $this->img)
            ->with('kelolaAbsensi', $kelolaAbsensi)
            ->with('route', $this->route);
    }

    public function laporan()
    {
        dd(1);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $this->img = $this->imageHeader();

        // get absen guru
        $resultGuru = new AbsenGuru();
        $getGuru = $resultGuru->getAbsenGuru([
            'absen_guru.*',
            'guru.nama',
        ]);

        // get absen Pegawai

        $resultPegawai = new AbsenPegawai();
        $getPegawai = $resultPegawai->getAbsenPegawai([
            'absen_pegawai.*',
            'pegawai.nama',

        ]);

        return view('tataUsaha.manajemen-absensi.create')
            ->with('title', 'Manajemen Absensi')
            ->with('role', $this->role)
            ->with('folder', $this->folder)
            ->with('img', $this->img)
            ->with('guru', $getGuru)
            ->with('pegawai', $getPegawai)
            ->with('route', $this->route);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            $data = [

                'tanggal' => $request->tanggal,
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai,

            ];

            $result = new KelolaAbsensi();
            $result->saveAbsensi($data);

            return back();
        } catch (\Throwable $th) {
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $r, string $id)
    {

       

        //    get absen pegawai

        $resultPegawaiSearch = new AbsenPegawai();
        $getPegawaiSearch = $resultPegawaiSearch->getAbsenPegawaiSearch([
            'absen_pegawai.*',
            'pegawai.nama',
        ], $r->start_date, $r->end_date);

        // get absen guru

        $resultGuruSearch = new AbsenGuru();
        $getGuruSearch = $resultGuruSearch->getAbsenGuruSearch([
            'absen_guru.*',
            'guru.nama',
        ], $r->start_date, $r->end_date);

        // get absen guru
        $resultGuru = new AbsenGuru();
        $getGuru = $resultGuru->getAbsenGuru([
            'absen_guru.*',
            'guru.nama',
        ]);

        // get absen Pegawai

        $resultPegawai = new AbsenPegawai();
        $getPegawai = $resultPegawai->getAbsenPegawai([
            'absen_pegawai.*',
            'pegawai.nama',

        ]);

        return view('tataUsaha.manajemen-absensi.create')
            ->with('title', 'Manajemen Absensi')
            ->with('role', $this->role)
            ->with('folder', $this->folder)
            ->with('img', $this->img)
            ->with('guru', $getGuru)
            ->with('pegawai', $getPegawai)
            ->with('pegawaiSearch', $getPegawaiSearch)
            ->with('start_date', $r->start_date)
            ->with('end_date', $r->end_date)
            ->with('getGuruSearch', $getGuruSearch)
            ->with('route', $this->route);
    }

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

        try {
            if ($request->jenis == 'guru') {

                if ($request->status == 'Hadir') {
                    $poin_absen = 0.5;
                } elseif ($request->status == 'Terlambat') {
                    $poin_absen = 0.1;
                } elseif ($request->status == 'Izin') {
                    $poin_absen = 0.3;
                } elseif ($request->status == 'Sakit') {
                    $poin_absen = 0.3;
                } elseif ($request->status == 'Mangkir') {
                    $poin_absen = 0;
                }

                $dataGuru = [
                    'status' => $request->status,
                    'poin_absensi' => $poin_absen,
                ];

                $result = new AbsenGuru();
                $result->updateAbsenGuru($id, $dataGuru);
            } else {
                $dataPegawai = [
                    'status' => $request->status,
                ];

                $result = new AbsenPegawai();
                $result->updateAbsenPegawai($id, $dataPegawai);
            }

            if ($request->tanggal == null) {

                return back();
            } else {

                return redirect('tata-usaha/manajemen-absensi/Search?tanggal='.$request->tanggal);
            }
        } catch (\Throwable $th) {
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $result = new KelolaAbsensi();
            $result->getDelete($id);

            return back();
        } catch (\Throwable $th) {
            return back();
        }
    }

    public function destroyAbsenGuru(string $id)
    {
        try {

            $result = new AbsenGuru();
            $result->getDelete($id);

            return back();
        } catch (\Throwable $th) {
            return back();
        }
    }

    public function destroyAbsenPegawai(string $id)
    {

        try {

            $result = new AbsenPegawai();
            $result->getDelete($id);

            return back();
        } catch (\Throwable $th) {
            return back();
        }
    }

    public function cetak(string $start_date, string $end_date)
    {

        $absenGuru = new AbsenGuru();
        $absenPegawai = new AbsenPegawai();

        if ($start_date == 'all' || $end_date == 'all') {
            // get absen guru
            $guru = $absenGuru->getAbsenGuru([
                'absen_guru.*',
                'guru.nama',
            ]);
            $dateGuru = '';

            // get absen pegawai
            $pegawai = $absenPegawai->getAbsenPegawai([
                'absen_pegawai.*',
                'pegawai.nama',
            ]);

            $datePegawai = '';
        } else {

            // get absen guru
            $guru = $absenGuru->getAbsenGuruSearch([
                'absen_guru.*',
                'guru.nama',
            ], $start_date, $end_date);
            $dateGuru = $start_date.' s.d '.$end_date;
            // get absen pegawai
            $pegawai = $absenPegawai->getAbsenPegawaiSearch([
                'absen_pegawai.*',
                'pegawai.nama',
            ], $start_date, $end_date);

            $datePegawai = $start_date.' s.d '.$end_date;
        }

        $hadirGuru = $guru->where('status', 'Hadir')->count();
        $izinGuru = $guru->where('status', 'Izin')->count();
        $sakitGuru = $guru->where('status', 'Sakit')->count();
        $terlambatGuru = $guru->where('status', 'Terlambat')->count();
        $mangkirGuru = $guru->where('status', 'Mangkir')->count();

        $hadirPegawai = $pegawai->where('status', 'Hadir')->count();
        $izinPegawai = $pegawai->where('status', 'Izin')->count();
        $sakitPegawai = $pegawai->where('status', 'Sakit')->count();
        $terlambatPegawai = $pegawai->where('status', 'Terlambat')->count();
        $mangkirPegawai = $pegawai->where('status', 'Mangkir')->count();

        return view('tataUsaha.manajemen-absensi.cetak')
            ->with('guru', $guru)
            ->with('dateGuru', $dateGuru)
            ->with('pegawai', $pegawai)
            ->with('datePegawai', $datePegawai)
            ->with('totalHadir_guru', $hadirGuru)
            ->with('totalIzin_guru', $izinGuru)
            ->with('totalSakit_guru', $sakitGuru)
            ->with('totalTerlambat_guru', $terlambatGuru)
            ->with('totalMangkir_guru', $mangkirGuru)
            ->with('totalHadir_pegawai', $hadirPegawai)
            ->with('totalIzin_pegawai', $izinPegawai)
            ->with('totalSakit_pegawai', $sakitPegawai)
            ->with('totalTerlambat_pegawai', $terlambatPegawai)
            ->with('totalMangkir_pegawai', $mangkirPegawai);
    }

  
}
