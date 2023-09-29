<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RekapNilaiSiswa extends Model
{
    use HasFactory;

    protected $table = 'rekap_nilai_siswa';

    protected $fillable = [
        'id_siswa',
        'id_mapel',
        'total_nilai',
        'rata_rata',
        'catatan',
        'id_tahun_ajaran',
    ];

    protected $primaryKey = 'id';

    public function saveRekapNilaiSiswa($data)
    {
        return RekapNilaiSiswa::create($data);
    }

    public function getRekapNilaiSiswaWhereIdSiswaAndIdMapel($id_siswa, $id_mapel)
    {

        $siswaData = DB::table('rekap_nilai_siswa')
            ->select('*')

            ->where('id_siswa', '=', $id_siswa)
            ->where('id_mapel', '=', $id_mapel)

            ->get();

        return $siswaData;
    }

    public function updateRekapNilaiSiswa($data, $id_siswa, $id_mapel)
    {
        return RekapNilaiSiswa::where('id_siswa', $id_siswa)->where('id_mapel', $id_mapel)->update($data);
    }

    public function getRekapNilaiSiswaWhereIdSiswaAndIdKelas($select, $id_siswa, $id_kelas)
    {
        $data = DB::table('rekap_nilai_siswa')
            ->join('siswa', 'rekap_nilai_siswa.id_siswa', '=', 'siswa.id')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->join('mapel', 'rekap_nilai_siswa.id_mapel', '=', 'mapel.id')
            ->select($select)
            ->where('kelas.id', $id_kelas)
            ->where('rekap_nilai_siswa.id_siswa', $id_siswa)
            ->get();

        return $data;
    }

    public function getRekapNilaiSiswaAll()
    {
        $result = DB::table('rekap_nilai_siswa')
            ->join('siswa', 'rekap_nilai_siswa.id_siswa', '=', 'siswa.id')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->join('mapel', 'rekap_nilai_siswa.id_mapel', '=', 'mapel.id')
            ->select('rekap_nilai_siswa.id_siswa', 'mapel.nama as mapel', 'mapel.KKM', 'rekap_nilai_siswa.total_nilai', 'rekap_nilai_siswa.rata_rata', 'rekap_nilai_siswa.catatan')
            ->get();

        return $result;
    }
}
