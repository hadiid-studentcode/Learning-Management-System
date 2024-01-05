<?php

namespace App\Http\Controllers\TataUsaha;

use App\Models\Guru;
use App\Models\Pegawai;
use App\Models\Pemasukan;
use App\Models\RekapKeuangan;
use App\Models\TahunAjaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemasukanKeuanganTataUsahaController extends TataUsahaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->img = $this->imageHeader();

        // get id dan nama guru

        $resultGuru = new Guru();
        $guru = $resultGuru->viewGuru(['id', 'nama']);

        // get id dan nama tata usaha
        $resultTataUsaha = new Pegawai();
        $tataUsaha = $resultTataUsaha->viewTataUsaha(['pegawai.id', 'pegawai.nama']);

        // get id dan nama pegawai
        $pegawai = $resultTataUsaha->viewPegawai(['pegawai.id', 'pegawai.nama']);

        return view('tataUsaha.rekap-keuangan.input-pemasukan')
            ->with('title', 'Pemasukan Keuangan')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('route', $this->route)
            ->with('guru', $guru)
            ->with('tataUsaha', $tataUsaha)
            ->with('pegawai', $pegawai)
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
        $tanggal = $request->tanggal;

        $nominal = $request->nominal;

        // Menghapus karakter non-digit dari string
        $numericString = preg_replace('/\D/', '', $nominal);

        // Mengkonversi string numerik menjadi integer
        $nominalValue = intval($numericString);

        $pengirim = $request->pengirim;  // ketegori

        $metode = $request->metode; // metode pembayaran
        $metodeLainnya = $request->metodeLainnya; // metode lainnya
        $deskripsi = $request->deskripsi;
        $bukti_transaksi = $request->bukti_transaksi; // bukti transaksi

        if ($metode == 'Lainnya') {
            $metode = $metodeLainnya;
        } else {
            $metode = $metode;
        }

        if ($bukti_transaksi !== null) {
            $bukti_transaksi_image = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('bukti_transaksi')->getClientOriginalName());
        } else {
            $bukti_transaksi_image = null;
        }

        $result = new TahunAjaran();
        $tahunAjaran = $result->getTahunAjaran();

        $parts = explode('-', $tahunAjaran->tahun_ajaran);

        $tahun_awal = $parts[0];

        $resultPemasukan = new Pemasukan();
        $jumlahPemasukkan = $resultPemasukan->getJumlahPemasukan();
        $jumlahTransaksiPemasukkan = $jumlahPemasukkan + 1;

        if ($request->metode == 'Tunai') {
            $metode = 'C';
        } else {

            $metode = 'T';
        }

        $dataPemasukan = [
            'no_transaksi' => $tahun_awal . 'T0' . $jumlahTransaksiPemasukkan . $metode . date('s'),
            'tanggal' => $tanggal,
            'pembayaran' => $request->kategori,
            'tarif' => null,
            'nominal' => $nominalValue,
            'sisa' => null,
            'diterima_dari' => $pengirim,
            'metode_pembayaran' => 'Tunai',
            'deskripsi' => $deskripsi,
            'bukti_transaksi' => $tahun_awal . 'T0' . $jumlahTransaksiPemasukkan . $metode . date('s'),
            'id_tahun_ajaran' => $tahunAjaran->id,
            'report' => null,
        ];

        // simpan data pengeluaran ke database
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

        // if ($bukti_transaksi != null) {
        //     $resultPemasukan->uploadBuktiTransaksi($request->file('bukti_transaksi'), $bukti_transaksi_image);
        // }

        // simpan bukti transaksi

        $folderPath = 'storage/tata_usaha/pemasukan';

        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        Pdf::loadView('partials.cetak.pdf', [
            'diterima_dari' => $dataPemasukan['diterima_dari'],
            'tgl_bayar' => $dataPemasukan['tanggal'],
            'nomor_induk' => '-',
            'noBukti' => $dataPemasukan['bukti_transaksi'],
            'kelas' => '-',
            'operator' => Auth::user()->nama_lengkap,
            'jenis' => 'dataPemasukkan',
            'pembayaran' => $dataPemasukan['pembayaran'],
            'nominal' => $dataPemasukan['nominal'],

        ])->setPaper('A4', 'landscape')->save('storage/tata_usaha/pemasukan/' . $dataPemasukan['bukti_transaksi'] . '.pdf')->stream('download.pdf');

        return redirect('/tata-usaha/pemasukan')->with('message', 'Data Pengeluaran Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
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
}
