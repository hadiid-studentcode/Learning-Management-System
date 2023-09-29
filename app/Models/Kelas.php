<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama',
        'rombel',
        'id_guru',
        'kouta_siswa',
        'id_tahun_ajaran',

    ];

    protected $primaryKey = 'id';

    public function getWaliKelas($id_guru)
    {
        $result = DB::table('kelas')
            ->select('nama as kelas', 'rombel as rombel')
            ->where('id_guru', '=', $id_guru)
            ->first();

        return $result;
    }

    public function getKelasAll($select)
    {
        $result = DB::table('kelas')
            ->select($select)
            ->orderBy('nama', 'asc')
            ->get();

        return $result;
    }

    public function tambahKelas($data)
    {

        $result = Kelas::create($data);

        return $result;
    }

    public function deleteKelas($id)
    {
        $result = Kelas::where('id', $id)->delete();

        return $result;
    }

    public function getkelas()
    {
        $query = DB::table('kelas')
            ->select(
                'kelas.id',
                'kelas.nama',
                'kelas.rombel',
                DB::raw('IFNULL(guru.nama, "Tidak ada guru") as guru'),
                DB::raw('IFNULL(guru.id, "0") as id_guru'),
                'kelas.kouta_siswa',
                DB::raw('COUNT(siswa.id) as jumlah_siswa')
            )
            ->leftJoin('siswa', 'kelas.id', '=', 'siswa.id_kelas')
            ->leftJoin('guru', 'kelas.id_guru', '=', 'guru.id')
            ->orderBy('kelas.nama', 'asc')
            ->groupBy(
                'kelas.id',
                'kelas.nama',
                'kelas.rombel',
                'kelas.id_guru',
                'guru.nama',
                'guru.id',
                'kelas.kouta_siswa'
            );

        $result = $query->get();

        return $result;
    }

    public function updateKelas($data, $id)
    {
        $result = Kelas::where('id', $id)->update($data);

        return $result;
    }

    public function getWaliKelasLama($id)
    {
        $result = DB::table('kelas')
            ->select('id_guru')
            ->where('id', '=', $id)
            ->first();

        return $result;
    }

    public function firstKelasAndRombelWhereIdUserGuru($id_user_guru)
    {
        $kelas = DB::table('kelas')
            ->select('kelas.nama as kelas', 'kelas.rombel')
            ->join('guru', 'kelas.id_guru', '=', 'guru.id')
            ->where('guru.id_user', '=', $id_user_guru)
            ->first();

        return $kelas;
    }

    public function getKelasWhereIdSiswa($id_siswa)
    {
        $result = DB::table('kelas')
            ->select('kelas.id', 'kelas.nama as kelas', 'kelas.rombel', 'tahun_ajaran.tahun_ajaran')
            ->join('siswa', 'siswa.id_kelas', '=', 'kelas.id')
            ->join('tahun_ajaran', 'kelas.id_tahun_ajaran', '=', 'tahun_ajaran.id')
            ->where('siswa.id', '=', $id_siswa)
            ->get();

        return $result;
    }

    public function firstKelasWhereIdKelas($id_kelas)
    {
        $result = DB::table('kelas')
            ->select('kelas.id', 'kelas.nama as kelas', 'kelas.rombel', 'tahun_ajaran.tahun_ajaran')
            ->join('tahun_ajaran', 'kelas.id_tahun_ajaran', '=', 'tahun_ajaran.id')
            ->where('kelas.id', '=', $id_kelas)
            ->first();

        return $result;
    }

    public function getKelasCount()
    {
        $result = DB::table('kelas')
            ->count();

        return $result;
    }
}
