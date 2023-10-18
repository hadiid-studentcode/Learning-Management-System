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
}
