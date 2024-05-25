<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran';

    protected $fillable = [
        'no_transaksi',
        'tanggal',
        'nominal',
        'pembayaran',
        'guru',
        'tata_usaha',
        'pegawai',
        'metode_pembayaran',
        'deskripsi',
        'bukti_transaksi',
        'id_tahun_ajaran',
        'report',

    ];

    protected $primaryKey = 'id';

    public function savePengeluaran($data)
    {
        $result = Pengeluaran::create($data);

        return $result;
    }

    public function uploadBuktiTransaksi($file, $dbfile)
    {

        $folderPath = 'storage/tata_usaha/pengeluaran';

        if (! is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $img = Image::make($file);
        // perbaiki rotasi foto
        $img->orientate();
        // kompres gambar
        $img->filesize();

        return $img->save('storage/tata_usaha/pengeluaran/'.$dbfile, 10);
    }

    public function getPengeluaran()
    {
        $result = DB::table('pengeluaran')
            ->select('*');

        return $result;
    }

    public function getPengeluaranLastfirst($select)
    {
        $result = DB::table('pengeluaran')
            ->select($select)
            ->latest()
            ->first();

        return $result;
    }

    public function getPengeluaranReport()
    {
        $result = DB::table('pengeluaran')
            ->select('*')

            ->where('report', '=', 'Menunggu')
            // ->Orwhere('report', '=', 'Diterima')
            // ->Orwhere('report', '=', 'Ditolak')
            ->get();

        return $result;
    }

    public function getJumlahPengeluaran()
    {
        return DB::table('pengeluaran')->count();
    }

    public function updatePengeluaran($no_transaksi, $data)
    {
        $result = DB::table('pengeluaran')
            ->where('no_transaksi', '=', $no_transaksi)
            ->update($data);

        return $result;
    }

    public function deletePengeluaranWhereNoTransaksi($no_transaksi)
    {
        $result = DB::table('pengeluaran')
            ->where('no_transaksi', $no_transaksi)
            ->delete();

        return $result;
    }
}
