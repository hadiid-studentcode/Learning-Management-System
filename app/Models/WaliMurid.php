<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WaliMurid extends Model
{
    use HasFactory;

    protected $table = 'wali_murid';

    protected $fillable = [
        'nik',
        'nama',
        'hubungan',
        'jenis_kelamin',
        'agama',
        'no_hp',
        'kelurahan',
        'kecamatan',
        'kabupatenKota',
        'provinsi',
        'email',
        'pekerjaan',
        'alamat',
        'id_siswa',
        'id_user',
    ];

    protected $primaryKey = 'id';

    public function getSiswa($id)
    {
        $siswa = DB::table('wali_murid')
            ->select(
                'siswa.id',
                'siswa.nama',
                'siswa.nisn',
                'siswa.tempat_lahir',
                'siswa.tanggal_lahir',
                'siswa.jenis_kelamin',
                'siswa.agama',
                'siswa.kelurahan',
                'siswa.kecamatan',
                'siswa.kabupatenKota',
                'siswa.provinsi',
                'siswa.foto',
                'siswa.alamat',
                'siswa.id_user',
                'kelas.nama as kelas',
                'kelas.rombel',
                'guru.nama as guru'
            )
            ->join('siswa', 'wali_murid.id_siswa', '=', 'siswa.id')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->join('guru', 'kelas.id_guru', '=', 'guru.id')
            ->where('wali_murid.id_user', '=', $id)
            ->first();

        return $siswa;
    }

    public function firstSiswa($id)
    {
        $siswa = DB::table('wali_murid')
            ->select(
                'siswa.id',
                'siswa.nama',
                'siswa.nisn',
                'siswa.tempat_lahir',
                'siswa.tanggal_lahir',
                'siswa.jenis_kelamin',
                'siswa.agama',
                'siswa.kelurahan',
                'siswa.kecamatan',
                'siswa.kabupatenKota',
                'siswa.provinsi',
                'siswa.foto',
                'siswa.alamat',
                'siswa.id_user',
                'kelas.nama as kelas',
                'kelas.rombel'
            )
            ->join('siswa', 'wali_murid.id_siswa', '=', 'siswa.id')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->where('wali_murid.id_user', '=', $id)
            ->first();

        return $siswa;
    }

    public function getFotoSiswa($id)
    {
        $result = DB::table('wali_murid')
            ->select(
                'siswa.foto', 'siswa.nama'
            )
            ->join('siswa', 'wali_murid.id_siswa', '=', 'siswa.id')
            ->where('wali_murid.id_user', '=', $id)
            ->first();

        return $result;
    }

    public function getWaliMurid($id)
    {
        $result = DB::table($this->table)
            ->select(
                'wali_murid.*',
                'siswa.id_user as id_usersiswa',
                'userSiswa.userid as usernameSiswa',
                'userWaliMurid.id as id_userwaliMurid',
                'userWaliMurid.userid as usernameWaliMurid'
            )
            ->join('siswa', 'wali_murid.id_siswa', '=', 'siswa.id')
            ->join('users as userSiswa', 'siswa.id_user', '=', 'userSiswa.id')
            ->join('users as userWaliMurid', 'wali_murid.id_user', '=', 'userWaliMurid.id')
            ->where('wali_murid.id_user', '=', $id)
            ->first();

        return $result;
    }

    public function updateWaliMurid($data, $id_user)
    {
        $result = DB::table($this->table)
            ->where('id_user', '=', $id_user)
            ->update($data);

        return $result;
    }

    public function viewWaliMurid($select)
    {
        $result = DB::table($this->table)
            ->select($select)
            ->get();

        return $result;
    }

    public function saveWaliMurid($data)
    {
        $result = DB::table($this->table)
            ->insert($data);

        return $result;
    }

    public function getIdUserWhereIdSiswa($id_siswa)
    {
        $result = DB::table('wali_murid')
            ->select(
                'id_user'
            )
            ->where('wali_murid.id_siswa', '=', $id_siswa)
            ->first();

        return $result;
    }

    public function getIdSiswa($id)
    {
        $result = DB::table('wali_murid')
            ->select(
                'id_siswa'
            )
            ->where('id_user', '=', $id)
            ->first();

        return $result;
    }
}
