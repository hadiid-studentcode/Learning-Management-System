<?php

namespace App\Http\Controllers\SuperUser;

use App\Models\Calender;
use App\Models\RekapKeuangan;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class RekapKeuanganSuperUserController extends SuperUserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->img = $this->imageHeader();

        // get rekap keuangan
        $resultRekapKeuangan = new RekapKeuangan();

        $pemasukan = $resultRekapKeuangan->getRekapKeuanganWherePemasukan();
        $pengeluaran = $resultRekapKeuangan->getRekapKeuanganWherePengeluaran();

        $rekapKeuangan = array_merge($pemasukan->toArray(), $pengeluaran->toArray());

        $total = $resultRekapKeuangan->totalPemasukkanDanPengeluaran($rekapKeuangan);

        // get id dan nama guru

        // get tahun ajaran
        $result = new TahunAjaran();
        $tahunAjaran = $result->getTahunAjaranAll();

        if (empty($rekapKeuangan)) {
            $tanggal['tanggal'] = '';
        }

        foreach ($rekapKeuangan as $rk) {

            $result = new Calender();

            $tanggal = $result->TanggalBahasaIndonesia($rk->tanggal);

        }

        return view('superuser.rekap-keuangan.index')
            ->with('title', 'Rekap Keuangan')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('tahunAjaran', $tahunAjaran)
            ->with('route', $this->route)
            ->with('totalPemasukan', $total['pemasukan'])
            ->with('totalPengeluaran', $total['pengeluaran'])
            ->with('tanggal', $tanggal['tanggal'])
            ->with('rekapKeuangan', $rekapKeuangan);
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

        $string = $r->bulan;
        $parts = explode('-', $string);
        $monthDay = $parts[0];
        $month = $parts[1];

        $resultRekapKeuangan = new RekapKeuangan();
        $rekapKeuanganPemasukan = $resultRekapKeuangan->getRekapKeuanganBySearchPemasukan($r->tahunAjaran, $monthDay);
        $rekapKeuanganPengeluaran = $resultRekapKeuangan->getRekapKeuanganBySearchPengeluaran($r->tahunAjaran, $monthDay);

        $rekapKeuanganSearch = array_merge($rekapKeuanganPemasukan->toArray(), $rekapKeuanganPengeluaran->toArray());

        $pemasukan = $resultRekapKeuangan->getRekapKeuanganWherePemasukan();
        $pengeluaran = $resultRekapKeuangan->getRekapKeuanganWherePengeluaran();

        // $rekapKeuangan = array_merge($pemasukan->toArray(), $pengeluaran->toArray());

        // $total = $resultRekapKeuangan->totalPemasukkanDanPengeluaran($rekapKeuangan);

        $totalSearch = $resultRekapKeuangan->totalPemasukkanDanPengeluaran($rekapKeuanganSearch);

        // get tahun ajaran
        $result = new TahunAjaran();
        $tahunAjaran = $result->getTahunAjaranAll();

        // get tahunAjaran where id
        $tahunAjaranWhereid = $result->getTahunAjaranWhereId($r->tahunAjaran);

        // foreach ($rekapKeuangan as $rk) {

        //     $result = new Calender();

        //     $tanggal = $result->TanggalBahasaIndonesia($rk->tanggal);
        // }

        if (empty($rekapKeuanganSearch)) {
            $tanggalSearch['tanggal'] = '';
        }

        foreach ($rekapKeuanganSearch as $rks) {

            $result = new Calender();

            $tanggalSearch = $result->TanggalBahasaIndonesia($rks->tanggal);
        }

        return view('superuser.rekap-keuangan.index')
            ->with('title', 'Rekap Keuangan')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('tahunAjaran', $tahunAjaran)
            ->with('route', $this->route)
            ->with('montDay', $monthDay)
            ->with('month', $month)
            ->with('tahunAjaranWhereid', $tahunAjaranWhereid)
            ->with('rekapKeuanganSearch', $rekapKeuanganSearch)
            // ->with('totalPemasukan', $total['pemasukan'])
            // ->with('totalPengeluaran', $total['pengeluaran'])
            ->with('totalPemasukanSearch', $totalSearch['pemasukan'])
            ->with('totalPengeluaranSearch', $totalSearch['pengeluaran'])
            // ->with('tanggal', $tanggal)
            ->with('tanggalSearch', $tanggalSearch['tanggal']);
        // ->with('rekapKeuangan', $rekapKeuangan);
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

    public function cetak($date, $key)
    {

        $resultRekapKeuangan = new RekapKeuangan();

        if ($key == 'all') {

            // rekap keuangan

            $pemasukan = $resultRekapKeuangan->getRekapKeuanganWherePemasukan();
            $pengeluaran = $resultRekapKeuangan->getRekapKeuanganWherePengeluaran();

            $rekapKeuangan = array_merge($pemasukan->toArray(), $pengeluaran->toArray());

            $total = $resultRekapKeuangan->totalPemasukkanDanPengeluaran($rekapKeuangan);

            // $folderPath = public_path('storage/tata_usaha/rekap-keuangan/');

            // if (! is_dir($folderPath)) {
            //     mkdir($folderPath, 0777, true);
            // }

            // Pdf::loadView('Partials.cetak.laporan', [
            //     'rekapKeuangan' => $rekapKeuangan,
            //     'total' => $total,
            //     'jenis' => 'rekap keuangan',

            // ])->setPaper('A4', 'landscape')->save('storage/tata_usaha/rekap-keuangan/'.date('now').'.pdf')->stream('download.pdf');

            return view('partials.cetak.laporan')
                ->with('rekapKeuangan', $rekapKeuangan)
                ->with('total', $total)
                ->with('jenis', 'rekap keuangan');
        } else {

            $string = $key;
            $parts = explode('-', $string);
            $monthDay = $parts[0];
            $month = $parts[1];

            // tahun ajaran where id
            $resultTahunAjaran = new TahunAjaran();
            $tahunAjaran = $resultTahunAjaran->getTahunAjaranWhereId($date);

            // rekap keuangan search
            $rekapKeuanganPemasukan = $resultRekapKeuangan->getRekapKeuanganBySearchPemasukan($date, $monthDay);
            $rekapKeuanganPengeluaran = $resultRekapKeuangan->getRekapKeuanganBySearchPengeluaran($date, $monthDay);

            $rekapKeuanganSearch = array_merge($rekapKeuanganPemasukan->toArray(), $rekapKeuanganPengeluaran->toArray());

            $totalSearch = $resultRekapKeuangan->totalPemasukkanDanPengeluaran($rekapKeuanganSearch);

            // $folderPath = public_path('storage/tata_usaha/rekap-keuangan/'.$month);

            // if (! is_dir($folderPath)) {
            //     mkdir($folderPath, 0777, true);
            // }

            // Pdf::loadView('Partials.cetak.laporan', [
            //     'rekapKeuanganSearch' => $rekapKeuanganSearch,
            //     'totalSearch' => $totalSearch,
            //     'jenis' => 'rekap keuangan search',
            // ])->setPaper('A4', 'landscape')->save('storage/tata_usaha/rekap-keuangan/'.$month.'/'.date('now').'.pdf')->stream('download.pdf');

            return view('partials.cetak.laporan')
                ->with('rekapKeuanganSearch', $rekapKeuanganSearch)
                ->with('totalSearch', $totalSearch)
                ->with('bulan', $month)
                ->with('tahunAjaran', $tahunAjaran->tahun_ajaran)
                ->with('jenis', 'rekap keuangan search');
        }
    }
}
