<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RekapKeuangan extends Model
{
    use HasFactory;

    protected $table = 'rekap_keuangan';

    protected $fillable = [

        'pemasukan',
        'pengeluaran',
        'jenis',

    ];

    protected $primaryKey = 'id';

    public function saveRekapKeuangan($data)
    {
        $result = RekapKeuangan::create($data);

        return $result;
    }

    public function getRekapKeuanganWherePemasukan()
    {
        $result = DB::table('rekap_keuangan')
            ->select(
                'rekap_keuangan.id as id_rekap_keuangan',
                'rekap_keuangan.jenis',
                'pemasukan.tanggal',
                'pemasukan.pembayaran',
                'pemasukan.nominal',
                'pemasukan.deskripsi',
                'pemasukan.bukti_transaksi',
                'pemasukan.no_transaksi',
                'pemasukan.report'
            )
            ->join('pemasukan', 'pemasukan.id', '=', 'rekap_keuangan.pemasukan')
            ->where('rekap_keuangan.jenis', '=', 'Pemasukan')
            ->get();

        return $result;
    }

    public function getRekapKeuanganWherePengeluaran()
    {

        $result = DB::table('rekap_keuangan')
            ->select(
                'rekap_keuangan.id as id_rekap_keuangan',
                'rekap_keuangan.jenis',
                'pengeluaran.tanggal',
                'pengeluaran.pembayaran',
                'pengeluaran.nominal',
                'pengeluaran.deskripsi',
                'pengeluaran.bukti_transaksi',
                'pengeluaran.no_transaksi',
                'pengeluaran.report'
            )
            ->join('pengeluaran', 'pengeluaran.id', '=', 'rekap_keuangan.pengeluaran')
            ->where('rekap_keuangan.jenis', '=', 'Pengeluaran')

            ->get();

        return $result;
    }

    public function getRekapKeuanganBySearchPemasukan($tahunAjaran, $bulan)
    {
        $result = DB::table('rekap_keuangan')
            ->select('rekap_keuangan.id as id_rekap_keuangan', 'rekap_keuangan.jenis', 'pemasukan.tanggal', 'pemasukan.pembayaran', 'pemasukan.nominal', 'pemasukan.deskripsi', 'pemasukan.bukti_transaksi', 'pemasukan.no_transaksi')
            ->join('pemasukan', 'rekap_keuangan.pemasukan', '=', 'pemasukan.id')
            ->whereMonth('pemasukan.tanggal', '=', $bulan)
            ->where('pemasukan.id_tahun_ajaran', '=', $tahunAjaran)
            ->where('rekap_keuangan.jenis', '=', 'Pemasukan')

            ->get();

        return $result;
    }

    public function getRekapKeuanganBySearchPengeluaran($tahunAjaran, $bulan)
    {
        $result = DB::table('rekap_keuangan')
            ->select('rekap_keuangan.id as id_rekap_keuangan', 'rekap_keuangan.jenis', 'pengeluaran.tanggal', 'pengeluaran.pembayaran', 'pengeluaran.nominal', 'pengeluaran.deskripsi', 'pengeluaran.bukti_transaksi', 'pengeluaran.no_transaksi')
            ->join('pengeluaran', 'rekap_keuangan.pengeluaran', '=', 'pengeluaran.id')
            ->whereMonth('pengeluaran.tanggal', '=', $bulan)
            ->where('pengeluaran.id_tahun_ajaran', '=', $tahunAjaran)
            ->where('rekap_keuangan.jenis', '=', 'Pengeluaran')

            ->get();

        return $result;
    }

    public function totalPemasukkanDanPengeluaran($data)
    {

        $pemasukanTotal = 0;
        $pengeluaranTotal = 0;

        foreach ($data as $item) {
            if ($item->jenis == 'Pemasukan') {
                $pemasukanTotal += $item->nominal;
            } elseif ($item->jenis == 'Pengeluaran') {
                $pengeluaranTotal += $item->nominal;
            }
        }

        $total = [
            'pemasukan' => $pemasukanTotal,
            'pengeluaran' => $pengeluaranTotal,
        ];

        return $total;
    }
}
