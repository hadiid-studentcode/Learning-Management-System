<?php

namespace App\Http\Controllers\SuperUser;

use App\Models\JenisPembayaran;
use App\Models\Kelas;
use App\Models\Pemasukan;
use App\Models\RekapKeuangan;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class PembayaranSiswaSuperUserController extends SuperUserController
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

        // data pembayara
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
            'bukti_transaksi' => null,
            'id_tahun_ajaran' => $tahun_ajaran->id,
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

        return redirect('super-user/pembayaran/cari-siswa?cariSiswaAtauNisn='.$nisn)->with('success', 'Data Pembayaran Berhasil Disimpan.');
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

            return redirect('super-user/pembayaran/')->with('error', 'Data Tidak Ditemukan.');
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

        if ($sisaNow == 0) {
            $keterangan = 'Lunas';
        } else {
            $keterangan = 'Belum Lunas';
        }

        $data = [
            'tanggal' => $tanggalPembayaran,
            'nominal' => $jumlahPembayaran,
            'sisa' => $sisaNow,
            'deskripsi' => $keterangan,
        ];

        // update pembayaran siswa
        $result = new Pemasukan();
        $result->updatePembayaranSiswa($data, $no_transaksi);

        return redirect('super-user/pembayaran/cari-siswa?cariSiswaAtauNisn='.$nisn)->with('success', 'Data Pembayaran Berhasil Diubah.');
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

            return redirect('super-user/pembayaran/cari-siswa?cariSiswaAtauNisn='.$nisn)->with('success', 'Data Pembayaran Berhasil Dihapus.');
        } catch (\Throwable $th) {
            return back();
        }
    }

    public function cetak($kode)
    {

        $result = new Pemasukan();
        $dataPembayaranSiswa = $result->firstPembayaranSiswaById([
            'pemasukan.no_transaksi',
            'pemasukan.diterima_dari',
            'pemasukan.nominal',
            'pemasukan.tanggal',

        ], $kode);

        // get siswa
        $resultSiswa = new Siswa();
        $dataSiswa = $resultSiswa->firstSiswaWhereNisn([
            'siswa.nama',
            'siswa.nisn',
            'kelas.nama as kelas',
            'kelas.rombel',
        ], $dataPembayaranSiswa->diterima_dari);

        $nama_bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        // Tanggal yang ingin ditampilkan
        $tanggal = $dataPembayaranSiswa->tanggal;

        // Mendapatkan angka bulan dari tanggal
        $angka_bulan = date('n', strtotime($tanggal));

        // Mendapatkan nama bulan dari array
        $nama_bulan_indonesia = $nama_bulan[$angka_bulan];

        // Format tanggal sesuai keinginan
        $tanggal_pembayaran = date('d', strtotime($tanggal)).' '.$nama_bulan_indonesia.' '.date('Y', strtotime($tanggal));

        // Menampilkan tanggal dalam format yang diinginkan

        // Tanggal yang ingin ditampilkan
        $tanggal_sekarang = date('Y-m-d');

        // Mendapatkan angka bulan dari tanggal
        $angka_bulan = date('n', strtotime($tanggal_sekarang));

        // Mendapatkan nama bulan dari array
        $nama_bulan_indonesia = $nama_bulan[$angka_bulan];

        // Format tanggal sesuai keinginan
        $tanggal_sekarang = date('d', strtotime($tanggal_sekarang)).' '.$nama_bulan_indonesia.' '.date('Y', strtotime($tanggal_sekarang));

        return view('tataUsaha.pembayaran.cetak')
            ->with('pembayaran', $dataPembayaranSiswa)
            ->with('tanggal_sekarang', $tanggal_sekarang)
            ->with('tanggal', $tanggal_pembayaran);
    }
}
