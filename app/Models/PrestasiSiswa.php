<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class PrestasiSiswa extends Model
{
    use HasFactory;

    protected $table = 'prestasi_siswa';

    protected $fillable = [
        'id_siswa',
        'nama',
        'status',
        'tanggal',
        'prediket',
        'foto',
        'id_tahun_ajaran',
    ];

    protected $primaryKey = 'id';

    public function getPrestasiSiswa($select)
    {
        $result = DB::table('prestasi_siswa')
            ->select($select)
            ->join('siswa', 'prestasi_siswa.id_siswa', '=', 'siswa.id')
            ->join('tahun_ajaran', 'prestasi_siswa.id_tahun_ajaran', '=', 'tahun_ajaran.id')
            ->get();

        return $result;
    }

    public function uploadFotoPrestasiSiswa($foto, $dbfoto)
    {

        $folderPath = public_path('storage/siswa/prestasi');

        if (! is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $img = Image::make($foto);
        // perbaiki rotasi foto
        $img->orientate();
        // kompres gambar
        $img->filesize();

        return $img->save('storage/siswa/prestasi/'.$dbfoto, 10);
    }

    public function savePrestasiSiswa($data)
    {
        return PrestasiSiswa::create($data);
    }

    public function deletePrestasiSiswa($id)
    {
        $result = DB::table('prestasi_siswa')
            ->where('id', $id)
            ->delete();

        return $result;
    }

    public function getPrestasiSiswaWhereIdSiswa($id_siswa)
    {
        $result = DB::table('prestasi_siswa')
            ->select(
                'prestasi_siswa.id',
                'prestasi_siswa.nama as nama_prestasi',
                'prestasi_siswa.tanggal',
                'prestasi_siswa.prediket',
                'prestasi_siswa.foto',
                'tahun_ajaran.tahun_ajaran'

            )
            ->join('tahun_ajaran', 'prestasi_siswa.id_tahun_ajaran', '=', 'tahun_ajaran.id')
            ->where('prestasi_siswa.id_siswa', '=', $id_siswa)
            ->get();

        return $result;
    }
}
