<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AbsenPegawai extends Model
{
    use HasFactory;

    protected $table = 'absen_pegawai';

    protected $fillable = [
        'id_pegawai',
        'waktu',
        'status',

    ];

    protected $primaryKey = 'id';

    public function getAbsenPegawai($select)
    {
        $result = DB::table('absen_pegawai')
            ->select($select)
            ->join('pegawai', 'absen_pegawai.id_pegawai', '=', 'pegawai.id')
            ->get();

        return $result;
    }

    public function updateAbsenPegawai($id, $data)
    {
        $result = DB::table('absen_pegawai')
            ->where('id', $id)
            ->update($data);

        return $result;
    }

    public function getAbsenPegawaiSearch($select, $tanggal)
    {
        $results = DB::table('absen_pegawai')
            ->select($select)
            ->join('pegawai', 'absen_pegawai.id_pegawai', '=', 'pegawai.id')

            ->where('waktu', 'like', '%'.$tanggal.'%')
            ->get();

        return $results;
    }

    public function saveAbsen($data)
    {
        return AbsenPegawai::create($data);
    }

    public function JumlahAbsen($id_pegawai, $status)
    {
        $jumlah = DB::table('absen_pegawai')
            ->select(DB::raw('count(status) as jumlah'))
            ->where('status', $status)
            ->where('id_pegawai', $id_pegawai)

            ->first();

        return $jumlah;
    }

    public function isAbsenPegawai($id_user, $absen_waktuMulai)
    {
        date_default_timezone_set('Asia/Jakarta'); // Set zona waktu ke Waktu Indonesia Barat

        setlocale(LC_TIME, 'id_ID');
        // get jika pegawai sudah absen pada hari ini
        $resultPegawai = new Pegawai();
        $pegawai = $resultPegawai->getPegawaiFirst(['pegawai.id'], $id_user);
        $date = date('Y-m-d');

        // $date = date('2023-12-05');

        $absenPegawai = DB::table('absen_pegawai')
            ->where('id_pegawai', $pegawai->id)
            ->where('waktu', '<', $date.' 23:59:59')
            ->latest()
            ->first();

        if (! empty($absenPegawai)) {
            if (explode(' ', $absenPegawai->waktu)[0] == explode(' ', $absen_waktuMulai)[0]) {

                $isAbsenPegawai = $absenPegawai;
            } else {

                $isAbsenPegawai = null;
            }
        } else {

            $isAbsenPegawai = null;
        }

        return $isAbsenPegawai;
    }
}
