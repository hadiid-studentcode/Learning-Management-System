<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AbsenGuru extends Model
{
    use HasFactory;

    protected $table = 'absen_guru';

    protected $fillable = [
        'id_guru',
        'waktu',
        'status',
        'poin_absensi',

    ];

    protected $primaryKey = 'id';

    public function saveAbsen($data)
    {
        return AbsenGuru::create($data);
    }

    public function getAbsenGuru($select)
    {
        $result = DB::table('absen_guru')

            ->select($select)
            ->join('guru', 'absen_guru.id_guru', '=', 'guru.id')
            ->get();

        return $result;
    }
    

    public function updateAbsenGuru($id, $data)
    {
        $result = DB::table('absen_guru')
            ->where('id', $id)
            ->update($data);

        return $result;
    }

    public function getAbsenGuruSearch($select, $tanggal)
    {
        $results = DB::table('absen_guru')
            ->select($select)
            ->join('guru', 'absen_guru.id_guru', '=', 'guru.id')

            ->where('waktu', 'like', '%'.$tanggal.'%')
            ->get();

        return $results;
    }

    public function getPoinAbsen()
    {
        $result = DB::table('absen_guru')
            ->select('id_guru', 'poin_absensi')
            ->get();

        return $result;
    }

    public function JumlahAbsen($id_guru, $status)
    {
        $jumlah = DB::table('absen_guru')
            ->select(DB::raw('count(status) as jumlah'))
            ->where('status', $status)
            ->where('id_guru', $id_guru)

            ->first();

        return $jumlah;
    }

    public function isAbsenGuru($id_user, $absen_waktuMulai)
    {
        date_default_timezone_set('Asia/Jakarta'); // Set zona waktu ke Waktu Indonesia Barat

        setlocale(LC_TIME, 'id_ID');
        // get jika pegawai sudah absen pada hari ini
        $resultPegawai = new guru();
        $guru = $resultPegawai->getGuruFirst(['guru.id'], $id_user);
        $date = date('Y-m-d');

        $absenGuru = DB::table('absen_guru')
            ->where('id_guru', $guru->id)
            ->where('waktu', '<', $date.' 23:59:59')
            ->first();

        if (! empty($absenGuru)) {
            if (explode(' ', $absenGuru->waktu)[0] == explode(' ', $absen_waktuMulai)[0]) {

                $isAbsenGuru = $absenGuru;
            } else {

                $isAbsenGuru = null;
            }
        } else {

            $isAbsenGuru = null;
        }

        return $isAbsenGuru;
    }

    public function getDelete($id)
    {

        $result = AbsenGuru::find($id);

        return $result->delete();
    }
}
