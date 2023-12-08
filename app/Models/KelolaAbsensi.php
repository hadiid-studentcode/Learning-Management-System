<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KelolaAbsensi extends Model
{
    use HasFactory;

    protected $table = 'kelola_absensi';

    protected $fillable = [
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',

    ];

    protected $primaryKey = 'id';

    public function saveAbsensi($data)
    {

        return KelolaAbsensi::create($data);
    }

    public function getAbsenWhereDateNow($date_now)
    {

        $result = DB::table('kelola_absensi')
            ->select('*')
            ->where('tanggal', $date_now)
            ->latest()

            ->first();

        return $result;
    }

    public function absensi()
    {

        // $date = date('2023-12-04');

        date_default_timezone_set('Asia/Jakarta');

        $date = date('Y-m-d');

        $date_now = date('Y-m-d H:i:s');

        // $date_now = date('2023-12-04 17:01:00');

        // data absensi guru
        $result = new KelolaAbsensi();
        $absen = $result->getAbsenWhereDateNow($date);

     

        if ($absen == null) {
            return $absen = [
                'date_now' => null,
                'waktu_mulai' => null,
                'waktu_selesai' => null,
            ];
        }

        $waktu_mulai = $absen->tanggal.' '.$absen->waktu_mulai;
        $waktu_selesai = $absen->tanggal.' '.$absen->waktu_selesai;

        return $absen = [
            'date_now' => $date_now,
            'waktu_mulai' => $waktu_mulai,
            'waktu_selesai' => $waktu_selesai,

        ];

    }

    public function getAbsensiAll()
    {
        $result = KelolaAbsensi::all();

        return $result;
    }

    public function getDelete($id)
    {

        $result = KelolaAbsensi::find($id);

        return $result->delete();
    }
}
