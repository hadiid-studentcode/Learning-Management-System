<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapel';

    protected $fillable = [
        'kode',
        'nama',
        'hari',
        'KKM',
        'waktu_mulai',
        'waktu_selesai',
        'id_guru',
        'id_kelas',
        'id_tahun_ajaran',

    ];

    protected $primaryKey = 'id';

    public function getMapel($select, $id)
    {
        $result = DB::table('mapel')
            ->select($select)
            ->where('id', '=', $id)
            ->first();

        return $result;
    }

    public function saveMapel($data)
    {
        return Mapel::create($data);
    }

    public function viewMapel($select)
    {
        $result = DB::table('mapel')
            ->select($select)
            ->join('kelas', 'mapel.id_kelas', '=', 'kelas.id')
            ->join('guru', 'mapel.id_guru', '=', 'guru.id')
            ->join('tahun_ajaran', 'mapel.id_tahun_ajaran', '=', 'tahun_ajaran.id')
            ->get();

        return $result;
    }

    public function deleteMapel($id)
    {
        return Mapel::where('id', '=', $id)->delete();
    }

    public function updateMapel($data, $id)
    {
        return Mapel::where('id', '=', $id)->update($data);
    }

    public function ViewMapelFirst($id, $kode)
    {
        $result = DB::table('mapel')
            ->select(
                'mapel.id',
                'mapel.kode',
                'mapel.nama',
                'kelas.nama as kelas',
                'kelas.rombel as rombel',
                'mapel.waktu_mulai',
                'mapel.waktu_selesai',
                'mapel.id_kelas',
                'mapel.hari'

            )
            ->join('kelas', 'mapel.id_kelas', '=', 'kelas.id')
            ->join('guru', 'mapel.id_guru', '=', 'guru.id')
            ->where('guru.id_user', '=', $id)
            ->where('mapel.kode', '=', $kode)
            ->first();

        return $result;
    }

    public function pertemuan($kode)
    {
        $result = DB::table('mapel')
            ->select(
                'mapel.id',
                'mapel.nama',
                'mapel.kode',
                'mapel.hari',
                'kelas.nama as kelas',
                'kelas.rombel as rombel',
                'mapel.waktu_mulai',
                'mapel.waktu_selesai',
                'mapel.id_kelas'
            )
            ->join('kelas', 'mapel.id_kelas', '=', 'kelas.id')
            ->join('guru', 'mapel.id_guru', '=', 'guru.id')
            ->where('mapel.kode', '=', $kode)
            ->first();

        return $result;
    }

    public function getidmapelnew()
    {
        $result = DB::table('mapel')
            ->select('id')
            ->latest()
            ->first();

        return $result;
    }

    public function ViewMapelWhereGuru($id_user, $id_tahun_ajaran)
    {
        $result = DB::table('mapel')
            ->select(
                'mapel.id',
                'mapel.kode',
                'mapel.nama',
                'kelas.nama as kelas',
                'kelas.rombel as rombel',
                'mapel.waktu_mulai',
                'mapel.waktu_selesai',
                'mapel.hari'
            )
            ->join('kelas', 'mapel.id_kelas', '=', 'kelas.id')
            ->join('guru', 'mapel.id_guru', '=', 'guru.id')
            ->where('guru.id_user', '=', $id_user)
            ->where('mapel.id_tahun_ajaran', '=', $id_tahun_ajaran)
            ->get();

        return $result;
    }

    public function getLastInsertIdMapel()
    {
        $result = DB::table('mapel')
            ->select('id')
            ->latest()
            ->first();

        return $result;
    }

    public function getMapelWhereIdkelas($id_kelas,$id_tahun_ajaran)
    {

        $result = DB::table('mapel')
            ->select(
                'mapel.id',
                'mapel.kode',
                'mapel.nama',
                'kelas.nama as kelas',
                'kelas.rombel as rombel',
                'mapel.waktu_mulai',
                'mapel.waktu_selesai',
                'mapel.hari'
            )
            ->join('kelas', 'mapel.id_kelas', '=', 'kelas.id')
            ->where('mapel.id_kelas', '=', $id_kelas)
            ->where('mapel.id_tahun_ajaran', '=', $id_tahun_ajaran)
            ->get();

        return $result;
    }

    public function getMapelWhereKode($kode)
    {

        $result = DB::table('mapel')
            ->select(
                'mapel.id',
                'mapel.kode',
                'mapel.nama',
                'kelas.nama as kelas',
                'kelas.rombel as rombel',
                'mapel.waktu_mulai',
                'mapel.waktu_selesai',
                'mapel.hari'
            )
            ->join('kelas', 'mapel.id_kelas', '=', 'kelas.id')
            ->where('mapel.kode', '=', $kode)
            ->first();

        return $result;
    }

    public function searchMapelWheretahunAjaranAndHari($tahun_ajaran, $hari, $id_kelas)
    {
        $result = DB::table('mapel')
        ->select(
            'mapel.id',
            'mapel.kode',
            'mapel.nama',
            'kelas.nama as kelas',
            'kelas.rombel as rombel',
            'mapel.waktu_mulai',
            'mapel.waktu_selesai',
            'mapel.hari'
        )
        ->join('kelas', 'mapel.id_kelas', '=', 'kelas.id')
        ->join('tahun_ajaran', 'mapel.id_tahun_ajaran', '=', 'tahun_ajaran.id');

        if (!empty($tahun_ajaran)) {
            $result->where('tahun_ajaran.tahun_ajaran', '=', $tahun_ajaran);
        }

        if (!empty($hari)) {
            $result->where('mapel.hari', '=', $hari);
        }

        $result = $result->where('mapel.id_kelas', '=', $id_kelas)
        ->get();

        return $result;

    }

    public function searchMapelWhereTahunAjaranAndHariAndIdUserGuru($seachTahunAjaran, $searchHari, $id_user)
    {
        $result = DB::table('mapel')
        ->select(
            'mapel.id',
            'mapel.kode',
            'mapel.nama',
            'kelas.nama as kelas',
            'kelas.rombel as rombel',
            'mapel.waktu_mulai',
            'mapel.waktu_selesai',
            'mapel.hari'
        )
            ->join('kelas', 'mapel.id_kelas', '=', 'kelas.id')
            ->join('guru', 'mapel.id_guru', '=', 'guru.id')
            ->join('tahun_ajaran', 'mapel.id_tahun_ajaran', '=', 'tahun_ajaran.id');

        if (!empty($seachTahunAjaran)) {
            $result->where('tahun_ajaran.tahun_ajaran', '=', $seachTahunAjaran);
        }

        if (!empty($searchHari)) {
            $result->where('mapel.hari', '=', $searchHari);
        }

        $result = $result->where('guru.id_user', '=', $id_user)
            ->get();

        return $result;
    }


    public function getMapelWhereNameGuru($name_guru)
    {
        $result = DB::table('mapel')
            ->select(
                'mapel.id',
                'mapel.nama',
                'mapel.hari',
                'mapel.KKM',
                'mapel.id_kelas',
                'kelas.nama as kelas',
                'kelas.rombel'
            )
            ->join('kelas', 'mapel.id_kelas', '=', 'kelas.id')
            ->join('guru', 'mapel.id_guru', '=', 'guru.id')
            ->where('guru.nama', '=', $name_guru)
            ->get();

        return $result;
    }

    public function getKelasGuruWhereNameGuru($name_guru)
    {
        $result = DB::table('mapel')
            ->select(
                'kelas.nama as kelas',
                'kelas.rombel'
            )
            ->join('kelas', 'mapel.id_kelas', '=', 'kelas.id')
            ->join('guru', 'mapel.id_guru', '=', 'guru.id')
            ->where('guru.nama', '=', $name_guru)
            ->groupBy('kelas.nama', 'kelas.rombel')
            ->get();

        return $result;
    }

    public function getMapelGuruWhereNameGuru($name_guru)
    {
        $result = DB::table('mapel')
            ->select(
                'mapel.nama',
                'mapel.hari'
            )
            ->join('kelas', 'mapel.id_kelas', '=', 'kelas.id')
            ->join('guru', 'mapel.id_guru', '=', 'guru.id')
            ->where('guru.nama', '=', $name_guru)

            ->get();

        return $result;
    }

    public function getMapelWhereKelasRombelMapelHari($kelas, $rombel, $mapel, $hari)
    {
        $result = DB::table('mapel')
            ->select(
                'siswa.id as id_siswa',
                'siswa.nama',
                'siswa.nisn',
                'kelas.nama as kelas',
                'kelas.rombel',
                'mapel.nama as mapel',
                'mapel.hari'
            )
            ->join('kelas', 'mapel.id_kelas', '=', 'kelas.id')
            ->join('siswa', 'siswa.id_kelas', '=', 'kelas.id')
            ->where('kelas.rombel', '=', $rombel)
            ->where('kelas.nama', '=', $kelas)
            ->where('mapel.nama', '=', $mapel)
            ->where('mapel.hari', '=', $hari)
            ->get();

        return $result;
    }

    public function getMapelWhereIdSiswa($id_siswa)
    {
        $result = DB::table('mapel')
            ->select('mapel.kode', 'mapel.nama', 'tahun_ajaran.tahun_ajaran')
            ->join('kelas', 'mapel.id_kelas', '=', 'kelas.id')
            ->join('siswa', 'siswa.id_kelas', '=', 'kelas.id')
            ->join('tahun_ajaran', 'mapel.id_tahun_ajaran', '=', 'tahun_ajaran.id')
            ->where('siswa.id', '=', $id_siswa)
            ->get();

        return $result;
    }

    public function firstMapelWhereKodeMapel($kode)
    {
        $result = DB::table('mapel')
            ->select('mapel.kode', 'mapel.nama', 'tahun_ajaran.tahun_ajaran')
            ->join('tahun_ajaran', 'mapel.id_tahun_ajaran', '=', 'tahun_ajaran.id')
            ->where('mapel.kode', '=', $kode)
            ->first();

        return $result;

    }

    public function firstMapeWhereHariAndWaktu($hari, $waktu_mulai, $waktu_selesai, $id_kelas)
    {

        $result = DB::table('mapel')
            ->select('hari', 'waktu_mulai', 'waktu_selesai', 'id_kelas')
            ->where('hari', $hari)
            ->where('id_kelas', $id_kelas)
            ->where('waktu_mulai', '<=', $waktu_selesai)
            ->where('waktu_selesai', '>=', $waktu_mulai)
            ->first();

        return $result;
    }
}
