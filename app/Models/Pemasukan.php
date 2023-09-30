<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class Pemasukan extends Model
{
    use HasFactory;

    protected $table = 'pemasukan';

    protected $fillable = [
        'no_transaksi',
        'tanggal',
        'pembayaran',
        'tarif',
        'nominal',
        'sisa',
        'diterima_dari',
        'metode_pembayaran',
        'deskripsi',
        'bukti_transaksi',
        'id_tahun_ajaran',
        'report',

    ];

    protected $primaryKey = 'id';

    public function savePemasukan($data)
    {
        $result = Pemasukan::create($data);

        return $result;
    }

    public function uploadBuktiTransaksi($file, $dbfile)
    {

        $folderPath = public_path('storage/tata_usaha/pemasukan');

        if (! is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $img = Image::make($file);
        // perbaiki rotasi foto
        $img->orientate();
        // kompres gambar
        $img->filesize();

        return $img->save('storage/tata_usaha/pemasukan/'.$dbfile, 10);
    }

    public function getPemasukan()
    {
        $result = DB::table('pemasukan')
            ->select('*')

            ->get();

        return $result;
    }

    public function getPemasukanLastfirst($select)
    {
        $result = DB::table('pemasukan')
            ->select($select)
            ->latest()
            ->first();

        return $result;
    }

    public function getJumlahPemasukan()
    {
        return DB::table('pemasukan')->count();
    }

    public function getPemasukanSiswaByNisn($select, $nisn)
    {

        $result = DB::table('pemasukan')
            ->select($select)
            ->join('tahun_ajaran', 'pemasukan.id_tahun_ajaran', '=', 'tahun_ajaran.id')
            ->where('diterima_dari', '=', $nisn)
            ->orderByDesc('id')
            ->get();


        return $result;
    }

    public function updatePembayaranSiswa($data, $no_transaksi)
    {
        $result = DB::table('pemasukan')
            ->where('no_transaksi', '=', $no_transaksi)
            ->update($data);

        return $result;
    }

    public function deletePembayaran($no_transaksi)
    {
        $result = DB::table('pemasukan')
            ->where('no_transaksi', '=', $no_transaksi)
            ->delete();

        return $result;
    }

    public function firstPembayaranSiswaById($select, $no_transaksi)
    {

        $result = DB::table('pemasukan')
            ->select($select)

            ->where('no_transaksi', '=', $no_transaksi)
            ->first();

        return $result;
    }

    public function saveNoBukti($no_transaksi)
    {

        $result = DB::table('pemasukan')
            ->where('no_transaksi', '=', $no_transaksi)
            ->update([
                'bukti_transaksi' => $no_transaksi,
            ]);

        return $result;
    }

    public function reportPemasukkan($no_transaksi)
    {

        $result = DB::table('pemasukan')
            ->where('no_transaksi', '=', $no_transaksi)
            ->update([
                'report' => 'Menunggu',
            ]);

        return $result;
    }

    public function getPemasukanReport()
    {
        $result = DB::table('pemasukan')
            ->select('*')

            ->where('report', '=', 'Menunggu')
            // ->Orwhere('report', '=', 'Diterima')
            // ->Orwhere('report', '=', 'Ditolak')
            ->get();

        return $result;
    }

    public function updatePemasukkan($no_transaksi, $data)
    {
        $result = DB::table('pemasukan')
            ->where('no_transaksi', '=', $no_transaksi)
            ->update($data);

        return $result;
    }

    public function getStatusPembayaran($nisn_siswa)
    {
        $deskripsi = DB::table('pemasukan')
            ->select('deskripsi')
            ->where('no_transaksi', 'like', '%'.$nisn_siswa.'%')
            ->get();

        return $deskripsi;
    }

    public function getKunciAkunWaliMurid($id_user)
    {
        setlocale(LC_TIME, 'id_ID');
        $tanggalSekarang = date('d F Y');
        $bulanSekarang = strtoupper(date('F'));

        $tanggalNow = date('Y-m-d');
        $bulanNow = date('m');

        // tahun ajaran sekarnag
        $resultTahunAjaran = new TahunAjaran();
        $tahunAjaran = $resultTahunAjaran->getTahunAjaran();
        $parts = explode('-', $tahunAjaran->tahun_ajaran);

        $tahunSekarang = $parts[0]; // "2023"
        $tahunBesok = $parts[1]; // "2024"

        // nim siswa where id user wali murid
        $resultSiswa = new Siswa();
        $siswa = $resultSiswa->getSiswaWhereidUserWaliMurid(['id_siswa', 'nisn'], $id_user);

        $results = DB::table('pemasukan')
            ->select('pemasukan.deskripsi')
            ->where('pembayaran', 'like', '%SPP%')
            ->where('no_transaksi', 'like', '%'.$siswa->nisn.'%')
            ->where('pembayaran', 'like', '%'.$bulanSekarang.' TAHUN '.$tahunAjaran->tahun_ajaran.'%')
            ->where('tanggal', '>=', $tahunSekarang.'-'.$bulanNow.'-01')
            ->where('tanggal', '<=', $tahunSekarang.'-'.$bulanNow.'-30')
            ->first();

        $data = [$results, $bulanSekarang, $tahunAjaran->tahun_ajaran];

        return $data;
    }

    public function getKunciAkunSiswa($id_user)
    {
        setlocale(LC_TIME, 'id_ID');
        $tanggalSekarang = date('d F Y');
        $bulanSekarang = strtoupper(date('F'));

        $tanggalNow = date('Y-m-d');
        $bulanNow = date('m');

        // tahun ajaran sekarnag
        $resultTahunAjaran = new TahunAjaran();
        $tahunAjaran = $resultTahunAjaran->getTahunAjaran();
        $parts = explode('-', $tahunAjaran->tahun_ajaran);

        $tahunSekarang = $parts[0]; // "2023"
        $tahunBesok = $parts[1]; // "2024"

        // nim siswa where id user wali murid
        $resultSiswa = new Siswa();
        $siswa = $resultSiswa->getIdSiswa(['nisn'], $id_user);

        $results = DB::table('pemasukan')
            ->select('pemasukan.deskripsi')
            ->where('pembayaran', 'like', '%SPP%')
            ->where('no_transaksi', 'like', '%'.$siswa->nisn.'%')
            ->where('pembayaran', 'like', '%'.$bulanSekarang.' TAHUN '.$tahunAjaran->tahun_ajaran.'%')
            ->where('tanggal', '>=', $tahunSekarang.'-'.$bulanNow.'-01')
            ->where('tanggal', '<=', $tahunSekarang.'-'.$bulanNow.'-30')
            ->first();

        $data = [$results, $bulanSekarang, $tahunAjaran->tahun_ajaran];

        return $data;
    }
}
