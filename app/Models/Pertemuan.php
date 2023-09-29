<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pertemuan extends Model
{
    use HasFactory;

    protected $table = 'pertemuan';

    protected $fillable = [
        'pertemuan_ke',
        'id_mapel',
        'nama_materi',
        'deskripsi_materi',
        'file_materi',
        'tanggal_materi',
        'nama_tugas',
        'deskripsi_tugas',
        'file_tugas',
        'tanggal_tugas',
        'poin_upload_materi',
        'poin_upload_tugas',

    ];

    protected $primaryKey = 'id';

    public function savePertemuan($data)
    {
        return Pertemuan::create($data);
    }

    public function getPertemuanWhereIdMapel($id_mapel)
    {
        $result = DB::table('pertemuan')
            ->select(
                'pertemuan.*',
                'mapel.*'

            )
            ->join('mapel', 'pertemuan.id_mapel', '=', 'mapel.id')
            ->where('id_mapel', '=', $id_mapel)

            ->first();

        return $result;
    }

    public function getPertemuan($id_mapel, $id_kelas)
    {

        $result = DB::table('pertemuan')
            ->select(
                'pertemuan.*',
                'mapel.nama as mapel',
                'kelas.nama as kelas',
                'kelas.rombel',
                'mapel.hari',
                'mapel.waktu_mulai',
                'mapel.waktu_selesai',
                'mapel.kode',

            )
            ->join('mapel', 'pertemuan.id_mapel', '=', 'mapel.id')
            ->join('kelas', 'mapel.id_kelas', '=', 'kelas.id')
            ->where('id_mapel', $id_mapel)
            ->where('id_kelas', $id_kelas)

            ->get();

        return $result;
    }

    public function saveMateri($data, $id_pertemuan, $id_mapel)
    {
        return Pertemuan::where('id', $id_pertemuan)
            ->where('id_mapel', $id_mapel)
            ->update($data);
    }

    public function getPertemuanWhereIdPertemuan($id)
    {
        $result = DB::table('pertemuan')
            ->select(
                '*'
            )
            ->where('id', $id)
            ->first();

        return $result;
    }

    public function getPertemuanWhereIdKelas($kode, $id_kelas)
    {
        $result = DB::table('pertemuan')
            ->select(
                'pertemuan.id',
                'pertemuan.pertemuan_ke',
                'pertemuan.nama_materi',
                'pertemuan.tanggal_materi',
                'mapel.kode',
                'pertemuan.file_materi'

            )
            ->join('mapel', 'pertemuan.id_mapel', '=', 'mapel.id')
            ->join('kelas', 'mapel.id_kelas', '=', 'kelas.id')
            ->where('mapel.kode', $kode)
            ->where('kelas.id', $id_kelas)
            ->get();

        return $result;
    }

    public function getPoinUploadMateriDanTugas()
    {

        $result = DB::table('pertemuan')
            ->join('mapel', 'pertemuan.id_mapel', '=', 'mapel.id')
            ->select('mapel.id_guru', 'id_mapel', 'pertemuan_ke', 'poin_upload_materi', 'poin_upload_tugas')
            ->get();

        return $result;
    }
}
