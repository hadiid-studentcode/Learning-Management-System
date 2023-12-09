<?php

namespace App\Http\Controllers\TataUsaha;

use App\Models\Guru;
use App\Models\Pegawai;
use App\Models\Pengeluaran;
use App\Models\RekapKeuangan;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class PengeluaranKeuanganTataUsahaController extends TataUsahaController
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

        return view('tataUsaha.rekap-keuangan.input-pengeluaran')
            ->with('title', 'Pengeluaran Keuangan')
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

        $kategori = $request->kategori;  // ketegori
        $guru = $request->guru; // gaji guru
        $tataUsaha = $request->tu; // gaji tata usaha
        $pegawai = $request->pegawai; // gaji pegawai
        $biayaLainnya = $request->biayaLainnya; // kategori lainnya
        $metode = $request->metode; // metode pembayaran
        $metodeLainnya = $request->metodeLainnya; // metode lainnya
        $deskripsi = $request->deskripsi;
        $bukti_transaksi = $request->bukti_transaksi; // bukti transaksi

        if ($kategori == 'Biaya Lainnya') {
            $kategori = $biayaLainnya;
        } elseif ($metode == 'Lainnya') {
            $metode = $metodeLainnya;
        }

        if ($bukti_transaksi !== null) {
            $bukti_transaksi_image = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $request->file('bukti_transaksi')->getClientOriginalName());
        } else {
            $bukti_transaksi_image = null;

        }

        $result = new TahunAjaran();
        $tahunAjaran = $result->getTahunAjaran();

        $parts = explode('-', $tahunAjaran->tahun_ajaran);

        $tahun_awal = $parts[0];

        if ($request->metode == 'Tunai') {
            $metode = 'C';
        } else {

            $metode = 'T';
        }

        $resultPengeluaran = new Pengeluaran();
        $jumlahPengeluaran = $resultPengeluaran->getJumlahPengeluaran();
        $jumlahTransaksiPengeluaran = $jumlahPengeluaran + 1;

        $data = [
            'no_transaksi' => $tahun_awal.'T0'.$jumlahTransaksiPengeluaran.$metode.date('s'),
            'tanggal' => $tanggal,
            'nominal' => $nominalValue,
            'pembayaran' => $kategori,
            'guru' => $guru,
            'tata_usaha' => $tataUsaha,
            'pegawai' => $pegawai,
            'metode_pembayaran' => $metode,
            'deskripsi' => $deskripsi,
            'bukti_transaksi' => $bukti_transaksi_image,
            'id_tahun_ajaran' => $tahunAjaran->id,
            'report' => null,
        ];

        try {
            // simpan data pengeluaran ke database
            $resultPengeluaran = new Pengeluaran();
            $resultPengeluaran->savePengeluaran($data);
            //code...
        } catch (\Throwable $th) {
            return back();
        }

        // get data pemasukkan first last
        $pengeluaran = $resultPengeluaran->getPengeluaranLastfirst(['id']);

        //    save rekap keuangan
        $dataRekapKeuangan = [
            'pemasukan' => null,
            'pengeluaran' => $pengeluaran->id,
            'jenis' => 'Pengeluaran',
        ];

        $resultRekapKeuangan = new RekapKeuangan();
        $resultRekapKeuangan->saveRekapKeuangan($dataRekapKeuangan);

        if ($bukti_transaksi != null) {
            $resultPengeluaran->uploadBuktiTransaksi($request->file('bukti_transaksi'), $bukti_transaksi_image);
        }

        // simpan bukti transaksi

        return redirect('/tata-usaha/pengeluaran')->with('message', 'Data Pengeluaran Berhasil Disimpan.');
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
