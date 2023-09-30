<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class tugasSiswa extends Model
{
    use HasFactory;
    use HasFactory;

    protected $table = 'tugas_siswa';

    protected $fillable = [
        'id_siswa',
        'id_pertemuan',
        'file_tugas',
        'status',
        'nilai',
    ];

    protected $primaryKey = 'id';

    public function uploadTugasSiswa($file, $dbfile)
    {

        $folderPath = public_path('storage/siswa/tugas');

        if (! is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        // simpan file tugas
        return $file->storeAs('public/siswa/tugas', $dbfile);
    }

    public function saveTugasSiswa($data)
    {
        return tugasSiswa::create($data);
    }

    public function getTugasSiswaWhereIdPertemuanAndIdSiswa($idPertemuan, $idSiswa)
    {
        return tugasSiswa::where('id_pertemuan', $idPertemuan)->where('id_siswa', $idSiswa)->first();
    }

    public function getTugasSiswaWhereIdPertemuan($id_pertemuan)
    {
        return tugasSiswa::where('id_pertemuan', $id_pertemuan)->get();
    }

    public function getTugasSiswaWhereIdPertemuanFirst($id_pertemuan)
    {
        return tugasSiswa::where('id_pertemuan', $id_pertemuan)->first();
    }

    public function saveNilaiSiswa($data, $id_siswa, $pertemuan)
    {
        return tugasSiswa::where('id_siswa', $id_siswa)->where('id_pertemuan', $pertemuan)->update($data);
    }

    public function getTugasSiswaWhereIdSiswaAndWhereIdMapel($id_siswa, $id_mapel)
    {
        $result = DB::table('tugas_siswa')
            ->select('pertemuan.pertemuan_ke', 'tugas_siswa.nilai')
            ->join('pertemuan', 'tugas_siswa.id_pertemuan', '=', 'pertemuan.id')
            ->where('tugas_siswa.id_siswa', $id_siswa)
            ->where('pertemuan.id_mapel', $id_mapel)
            ->get();

        return $result;
    }

    public function getRekapNilaiSiswaWhereNameSiswa($nama_siswa)
    {
        $siswaData = DB::table('tugas_siswa')
            ->select([
                'siswa.id as id_siswa',
                'siswa.nama',
                'mapel.id as id_mapel',
                'mapel.nama as mapel',
                'mapel.KKM',
                DB::raw('SUM(tugas_siswa.nilai) as nilai'),
                DB::raw('AVG(tugas_siswa.nilai) as rata_rata'),
            ])

            ->join('pertemuan', 'tugas_siswa.id_pertemuan', '=', 'pertemuan.id')
            ->join('mapel', 'pertemuan.id_mapel', '=', 'mapel.id')
            ->join('kelas', 'mapel.id_kelas', '=', 'kelas.id')
            ->join('siswa', 'tugas_siswa.id_siswa', '=', 'siswa.id')

            ->where('siswa.nama', '=', $nama_siswa)
            ->groupBy('siswa.id', 'siswa.nama', 'mapel.id', 'mapel.nama', 'mapel.KKM')
            ->get();

        return $siswaData;
    }

    public function getNilaiWhereIdSiswaMapelHari($id_siswa, $mapel, $hari)
    {
        $siswaData = DB::table('tugas_siswa')
            ->select([
                'tugas_siswa.id_siswa',
                'pertemuan.pertemuan_ke',
                'tugas_siswa.nilai',
                'mapel.KKM',
            ])

            ->join('pertemuan', 'tugas_siswa.id_pertemuan', '=', 'pertemuan.id')
            ->join('mapel', 'pertemuan.id_mapel', '=', 'mapel.id')

            ->where('tugas_siswa.id_siswa', '=', $id_siswa)
            ->where('mapel.nama', '=', $mapel)
            ->where('mapel.hari', '=', $hari)

            ->get();

        return $siswaData;
    }
}
