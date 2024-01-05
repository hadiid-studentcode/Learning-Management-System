<?php

namespace App\Http\Controllers\TataUsaha;

use App\Models\Calender;
use App\Models\JenisPembayaran;
use App\Models\Kelas;
use App\Models\Pemasukan;
use App\Models\RekapKeuangan;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranTataUsahaController extends TataUsahaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // data kelas
        $result = new Kelas();
        $kelas = $result->getKelasAll(['id', 'nama']);

        // data siswa
        $result = new Siswa();
        $siswa = $result->getSiswaAll(['*']);

        // data pembayaran
        $result = new Pemasukan();
        $pembayaran = $result->getPemasukan();

        $this->img = $this->imageHeader();

        return view('tataUsaha.pembayaran.index')
            ->with('title', 'Pembayaran')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('kelas', $kelas)
            ->with('siswa', $siswa)
            ->with('pembayaran', $pembayaran)
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

        $nominal = str_replace('.', '', $request->nominal);

        $jumlah = str_replace('.', '', $request->jumlah_pembayaran);

        $nisn = $request->siswa_nisn;

        // get tahun ajaran
        $result = new TahunAjaran();
        $tahun_ajaran = $result->getTahunAjaran();

        $parts = explode('-', $tahun_ajaran->tahun_ajaran);

        $tahun_awal = $parts[0];

        // if ($request->jenisPembayaran == 'lainya') {
        //     $jenis = $request->jenisPembayaranLainnya;
        //     $nominal = $request->nominal;
        // } else if ($request->jenisPembayaran == 'spp') {

        // } else {

        //     $parts = explode('-', $request->jenisPembayaran);
        //     $jenis = $parts[0];
        //     $nominal  = intval($parts[1]);
        // }

        switch ($request->jenisPembayaran) {
            case 'Lainnya':
                $jenis = $request->jenisPembayaranLainnya;
                $kelas = null;
                $bulan = null;
                break;
            case 'spp':

                $parts = explode('-', $request->kelasSPP);

                $nama = $parts[0];
                $nominal = intval($parts[1]);

                $bulan = strtoupper($request->bulanSPP);
                $jenis = $nama.' '.$bulan;
                break;

            default:
                $parts = explode('-', $request->jenisPembayaran);

                $jenis = $parts[0];
                $nominal = intval($parts[1]);

                break;
        }

        $sisa = $nominal - $jumlah;

        if ($sisa == 0) {
            $keterangan = 'Lunas';
        } else {
            $keterangan = 'Belum Lunas';
        }

        // pemeriksaan supaya tidak terjadi minus atau kesalahan input

        if ($sisa < 0) {
            return back()->with('error', 'Kesalahan Input ! Jumlah Pembayaran Melebihi Jumlah Tarif Pembayaran');
        }

        // $data = [
        //     'id_siswa' => $request->siswa_id,
        //     'jenis' => $jenis,
        //     'kelas' => $kelas,
        //     'bulan' => $bulan,
        //     'nominal' => $nominal,
        //     'tanggal' => $request->tanggal_pembayaran,
        //     'jumlah' => $jumlah,
        //     'sisa' => $sisa,
        //     'keterangan' => $keterangan,
        //     'id_tahun_ajaran' => $tahun_ajaran->id,
        // ];

        $resultPemasukan = new Pemasukan();
        $jumlahPemasukkan = $resultPemasukan->getJumlahPemasukan();
        $jumlahTransaksiPemasukkan = $jumlahPemasukkan + 1;

        $dataPemasukan = [
            'no_transaksi' => $tahun_awal.'T0'.$jumlahTransaksiPemasukkan.''.$nisn.'C'.date('s'),
            'tanggal' => $request->tanggal_pembayaran,
            'pembayaran' => $jenis.' TAHUN '.$tahun_ajaran->tahun_ajaran,
            'tarif' => $nominal,
            'nominal' => $jumlah,
            'sisa' => $sisa,
            'diterima_dari' => $nisn,
            'metode_pembayaran' => 'Tunai',
            'deskripsi' => $keterangan,
            'bukti_transaksi' => $tahun_awal.'T0'.$jumlahTransaksiPemasukkan.''.$nisn.'C'.date('s'),
            'id_tahun_ajaran' => $tahun_ajaran->id,
            'report' => null,
        ];

        $resultPemasukan = new Pemasukan();
        $resultPemasukan->savePemasukan($dataPemasukan);

        // get data pemasukkan first last
        $pemasukan = $resultPemasukan->getPemasukanLastfirst(['id']);

        //    save rekap keuangan
        $dataRekapKeuangan = [
            'pemasukan' => $pemasukan->id,
            'pengeluaran' => null,
            'jenis' => 'Pemasukan',
        ];

        $resultRekapKeuangan = new RekapKeuangan();
        $resultRekapKeuangan->saveRekapKeuangan($dataRekapKeuangan);

        return redirect('tata-usaha/pembayaran/cari-siswa?cariSiswaAtauNisn='.$nisn)->with('success', 'Data Pembayaran Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {

        $search = $request->input('cariSiswaAtauNisn');

        $result = new Siswa();
        $data = $result->getSiswaOrNisn($search);

        if (! $data) {
            return redirect('tata-usaha/pembayaran/')->with('error', 'Data Tidak Ditemukan.');
        }
        $nisn_siswa = $data->nisn;

        // tahun ajaran
        $result = new TahunAjaran();
        $tahun_ajaran = $result->getTahunAjaran();

        // tampilan rincian pembayaran berdasarkan search

        $result = new Pemasukan();
        $pembayaran = $result->getPemasukanSiswaByNisn([
            'pemasukan.id',
            'pemasukan.no_transaksi',
            'pemasukan.tanggal',
            'pemasukan.pembayaran',
            'pemasukan.tarif',
            'pemasukan.nominal',
            'pemasukan.sisa',
            'pemasukan.diterima_dari',
            'pemasukan.metode_pembayaran',
            'pemasukan.deskripsi',
            'pemasukan.bukti_transaksi',
            'pemasukan.id_tahun_ajaran',
            'tahun_ajaran.tahun_ajaran',
        ], $nisn_siswa);

        $this->img = $this->imageHeader();

        $resultJenisPembayaran = new JenisPembayaran();
        $jenisPembayaran = $resultJenisPembayaran->getJenisPembayaranAll(['jenis', 'nominal']);
        $spp = $resultJenisPembayaran->getSppSiswa(['jenis', 'nominal']);

        return view('tataUsaha.pembayaran.index')
            ->with('title', 'Pembayaran')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('siswa', $data)
            ->with('search', $search)
            ->with('tahun_ajaran', $tahun_ajaran->tahun_ajaran)
            ->with('pembayaran', $pembayaran)
            ->with('jenisPembayaran', $jenisPembayaran)
            ->with('spp', $spp)
            ->with('nisn', $nisn_siswa)
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
    public function update(Request $request, string $no_transaksi)
    {

        $tanggalPembayaran = date('Y-m-d');
        $sisaPembayaran = (int) str_replace('.', '', $request->editSisaPembayaran);
        $jumlahPembayaran = (int) str_replace('.', '', $request->editJumlahPembayaran);
        $nisn = $request->siswa_nisn;

        $sisaNow = $sisaPembayaran - $jumlahPembayaran;

        if ($sisaNow < 0) {
            return back()->with('error', 'Kesalahan Input ! Jumlah Pembayaran Melebihi Jumlah Sisa Pembayaran');
        }

        // nominal sekarang (dari database pemasukan) + nominal yang dibayar sekarang

        $result = new Pemasukan();
        $nominalOld = $result->firstPembayaranSiswaById(['nominal'], $no_transaksi);

        $nominal = $nominalOld->nominal + $jumlahPembayaran;

        if ($sisaNow == 0) {
            $keterangan = 'Lunas';
        } else {
            $keterangan = 'Belum Lunas';
        }

        $data = [
            'tanggal' => $tanggalPembayaran,
            'nominal' => $nominal,
            'sisa' => $sisaNow,
            'deskripsi' => $keterangan,
        ];

        // update pembayaran siswa
        $result->updatePembayaranSiswa($data, $no_transaksi);

        return redirect('tata-usaha/pembayaran/cari-siswa?cariSiswaAtauNisn='.$nisn)->with('success', 'Data Pembayaran Berhasil Diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $no_transaksi)
    {

        try {
            $nisn = $request->siswa_nisn;

            $result = new Pemasukan();
            $result->deletePembayaran($no_transaksi);

            return redirect('tata-usaha/pembayaran/cari-siswa?cariSiswaAtauNisn='.$nisn)->with('success', 'Data Pembayaran Berhasil Dihapus.');
        } catch (\Throwable $th) {
            return back();
        }

    }

    public function cetak($kode)
    {

        $operator = Auth::user()->nama_lengkap;

        $resultPemasukan = new Pemasukan();
        $dataPembayaranSiswa = $resultPemasukan->firstPembayaranSiswaById([
            'pemasukan.no_transaksi',
            'pemasukan.diterima_dari',
            'pemasukan.nominal',
            'pemasukan.tanggal',
            'pemasukan.pembayaran',
            'pemasukan.tarif',
            'pemasukan.deskripsi',
            'pemasukan.bukti_transaksi',

        ], $kode);

        // get siswa
        $resultSiswa = new Siswa();
        $dataSiswa = $resultSiswa->firstSiswaWhereNisn([
            'siswa.nama',
            'siswa.nisn',
            'kelas.nama as kelas',
            'kelas.rombel',
        ], $dataPembayaranSiswa->diterima_dari);

        $resultCalender = new Calender();
        $tanggal_pembayaran = $resultCalender->TanggalBahasaIndonesia($dataPembayaranSiswa->tanggal);

        $folderPath = 'storage/tata_usaha/pemasukan';

        if (! is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        Pdf::loadView('partials.cetak.pdf', [
            'pembayaran' => $dataPembayaranSiswa,
            'siswa' => $dataSiswa,
            'pembayaran' => $dataPembayaranSiswa,
            'operator' => $operator,
            'jenis' => 'dataPemasukkanSiswa',
            'tanggal' => $tanggal_pembayaran['tanggal'],
        ])->setPaper('A4', 'landscape')->save('storage/tata_usaha/pemasukan/'.$dataPembayaranSiswa->bukti_transaksi.'.pdf')->stream('download.pdf');

        return view('partials.cetak.index')
            ->with('pembayaran', $dataPembayaranSiswa)
            ->with('siswa', $dataSiswa)
            ->with('pembayaran', $dataPembayaranSiswa)
            ->with('operator', $operator)

            ->with('tanggal', $tanggal_pembayaran['tanggal']);
    }

    public function report($nisn, $no_transaksi)
    {
        try {
            $result = new Pemasukan();

            $result->reportPemasukkan($no_transaksi);

            return redirect('tata-usaha/pembayaran/cari-siswa?cariSiswaAtauNisn='.$nisn)->with('success', 'Data Pembayaran Berhasil Direport Silahkan Menunggu.');
        } catch (\Throwable $th) {
            return back();
        }

    }
}
