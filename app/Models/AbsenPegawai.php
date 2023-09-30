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
}
