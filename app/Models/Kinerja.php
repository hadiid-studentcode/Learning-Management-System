<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Kinerja extends Model
{
    use HasFactory;

    protected $table = 'kinerja_guru';

    protected $fillable = [
        'id_tahun_ajaran',
        'date',
        'id_guru',
        'absensi',
        'id_pertemuan',

    ];

    protected $primaryKey = 'id';

    public function viewKinerjaGuru($select)
    {
        $result = Kinerja::select($select)->get();

        return $result;
    }

    public function firstPointUploadMateriWhereIdGuru($id_guru)
    {
        $result = Kinerja::select('upload_materi')->where('id_guru', $id_guru)->first();

        return $result;
    }

    public function SaveKinerjaGuru($data)
    {

        $result = Kinerja::create($data);

        return $result;
    }

    public function kinerjaUploadMateri($materi, $tanggal, $keterangan, $file)
    {

        $point = 0;
        //   kalkulasi kinerja guru
        if ($materi && $tanggal && $keterangan && $file) {
            $point = 0.25;
        } elseif ($materi || $tanggal || $keterangan || $file) {
            $point = 0.15;
        } else {
            $point = 0;
        }

        return $point;

    }

    public function kinerjaUploadTugas($tugas, $deadline, $deskripsi, $file)
    {

        $point = 0;
        //   kalkulasi kinerja guru
        if ($tugas && $deadline && $deskripsi && $file) {
            $point = 0.25;
        } elseif ($tugas || $deadline || $deskripsi || $file) {
            $point = 0.15;
        } else {
            $point = 0;
        }

        return $point;
    }



}
