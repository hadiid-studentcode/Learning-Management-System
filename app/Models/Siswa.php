<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'nisn',
        'nama',
        'id_kelas',
        'jenis_kelamin',
        'agama',
        'kelurahan',
        'kecamatan',
        'kabupatenKota',
        'provinsi',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'foto',
        'id_user',
    ];

    protected $primaryKey = 'id';

    public function getPhotoSiswa($id)
    {
        $result = DB::table('siswa')
            ->select('foto')
            ->where('id', $id)
            ->first();

        return $result;
    }

    public function updateSiswa($id, $data)
    {
        $result = DB::table('siswa')
            ->where('nisn', $id)
            ->orWhere('id', $id)
            ->update($data);

        return $result;
    }

    public function getSiswaAll($select)
    {
        $result = DB::table('siswa')
            ->select($select)
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->join('wali_murid', 'wali_murid.id_siswa', '=', 'siswa.id')
            ->get();

        return $result;
    }

    public function getSiswaAllNotkelas($select)
    {
        $result = DB::table('siswa')
            ->select($select)
            ->join('wali_murid', 'wali_murid.id_siswa', '=', 'siswa.id')
            ->get();

        return $result;
    }

    public function getSiswaByKelas($select, $id_kelas)
    {
        $result = DB::table('siswa')
            ->select($select)
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->where('id_kelas', $id_kelas)
            ->get();

        return $result;
    }

    public function getSiswaOrNisn($search)
    {
        $result = DB::table('siswa')
            ->select('siswa.*', 'kelas.nama as kelas', 'kelas.rombel')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->where('siswa.nama', 'LIKE', '%'.$search.'%')
            ->orWhere('siswa.nisn', 'LIKE', '%'.$search.'%')
            ->first();

        return $result;
    }

    public function saveSiswa($data)
    {
        return Siswa::create($data);
    }

    public function uploadFotoSiswa($foto, $dbfoto, $id)
    {

        $result = new Siswa();
        $getfoto = $result->getPhotoSiswa($id);

        if (! empty($getfoto->foto)) {
            $fotoPath = $getfoto->foto;

            $image_path = 'storage/siswa/images/'.$fotoPath;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        $folderPath = public_path('storage/siswa/images');

        if (! is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $img = Image::make($foto);
        // perbaiki rotasi foto
        $img->orientate();
        // kompres gambar
        $img->filesize();

        return $img->save('storage/siswa/images/'.$dbfoto, 10);
    }

    public function updateSiswaId_users($data, $userid)
    {

        $result = DB::table('siswa')
            ->where('nisn', '=', $userid)
            ->update($data);

        return $result;
    }

    public function deleteSiswa($id)
    {
        $result = DB::table('siswa')
            ->where('id', $id)
            ->delete();

        return $result;
    }

    public function getSiswaCount()
    {
        $result = DB::table('siswa')
            ->count();

        return $result;
    }

    public function getUserIdSiswa($id)
    {
        $result = DB::table('siswa')
            ->select('id_user')
            ->where('id', '=', $id)
            ->first();

        return $result;
    }

    public function getSiswaFirst()
    {
        $result = DB::table('siswa')
            ->select(
                'siswa.*',
                'kelas.nama as kelas',
                'kelas.rombel as rombel',
                'guru.nama as nama_guru',
                'guru.nohp as nohp_guru'
            )
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->join('guru', 'kelas.id_guru', '=', 'guru.id')
            ->first();

        return $result;
    }

    public function getIdKelas($id_user)
    {
        $result = DB::table('siswa')
            ->select('siswa.id_kelas')
            ->where('id_user', '=', $id_user)
            ->first();

        return $result;
    }

    public function getSiswaWhereIdUser($select, $id)
    {
        $result = DB::table('siswa')
            ->select($select)
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->join('guru', 'kelas.id_guru', '=', 'guru.id')
            ->where('siswa.id_user', '=', $id)
            ->first();

        return $result;
    }

    public function getIdSiswa($select, $id_user)
    {

        $result = DB::table('siswa')
            ->select($select)
            ->where('siswa.id_user', '=', $id_user)
            ->first();

        return $result;
    }

    public function getLastIdSiswwa()
    {
        $result = DB::table('siswa')
            ->select('id')
            ->orderBy('id', 'desc')
            ->first();

        return $result;
    }

    public function lastIdSiswa()
    {
        // panggil ide user yang terakhir
        $result = new Siswa();
        $id_siswa = $result->getLastIdSiswwa();
        $id = $id_siswa->id;

        return $id;
    }

    public function getSiswaWhereKelasAndRombel($select, $tahunAjaran, $kelas, $rombel)
    {

        $result = DB::table('siswa')
            ->select($select)
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->join('tahun_ajaran', 'kelas.id_tahun_ajaran', '=', 'tahun_ajaran.id')
            ->where('kelas.nama', '=', $kelas)
            ->where('kelas.rombel', '=', $rombel)
            ->where('tahun_ajaran.tahun_ajaran', '=', $tahunAjaran)
            ->get();

        return $result;
    }

    public function firstSiswaWhereNisn($select, $nisn)
    {
        $result = DB::table('siswa')
            ->select($select)

            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->where('nisn', '=', $nisn)
            ->first();

        return $result;
    }

    public function getSiswaWhereIdUserGuru($select, $id_user_guru)
    {
        $result = DB::table('siswa')
            ->select(
                $select

            )
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->join('guru', 'kelas.id_guru', '=', 'guru.id')
            ->join('wali_murid', 'siswa.id', '=', 'wali_murid.id_siswa')
            ->where('guru.id_user', '=', $id_user_guru)
            ->get();

        return $result;
    }

    public function firstSiswaWhereIdUserGuruAndNameSiswa($id_user_guru, $name_siswa)
    {
        $result = DB::table('siswa')
            ->select(
                'siswa.id',
                'siswa.nama',
                'siswa.nisn',
                'kelas.nama as kelas',
                'kelas.rombel',
                'guru.nama as waliKelas',

            )
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->join('guru', 'kelas.id_guru', '=', 'guru.id')
            ->where('guru.id_user', '=', $id_user_guru)
            ->where('siswa.nama', '=', $name_siswa)
            ->first();

        return $result;
    }

    public function firstSiswaWhereIdKelas($id_kelas)
    {
        $data = DB::table('siswa')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->join('guru', 'kelas.id_guru', '=', 'guru.id')
            ->select('siswa.nama', 'siswa.nisn', 'kelas.nama as kelas', 'kelas.rombel', 'guru.nama as guru')
            ->where('siswa.id_kelas', $id_kelas)
            ->first();

        return $data;
    }

    public function firstSiswaWhereIdKelasNotGuru($id_kelas)
    {
        $data = DB::table('siswa')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->select('siswa.nama', 'siswa.nisn', 'kelas.nama as kelas', 'kelas.rombel')
            ->where('siswa.id_kelas', $id_kelas)
            ->first();

        return $data;
    }

    public function getSiswaWhereIdTahunAjaranAndIdkelas($select, $id_tahun_ajaran, $id_kelas)
    {
        $result = DB::table('siswa')
            ->select($select)
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->where('kelas.id_tahun_ajaran', $id_tahun_ajaran)
            ->where('kelas.id', $id_kelas)
            ->get();

        return $result;
    }

    public function getSiswaWhereidUserWaliMurid($select, $id_user_waliMurid)
    {
        $results = DB::table('wali_murid')
            ->join('siswa', 'wali_murid.id_siswa', '=', 'siswa.id')
            ->select('siswa.id', 'siswa.nisn')
            ->where('wali_murid.id_user', $id_user_waliMurid)
            ->first();

        return $results;
    }

    public function HapusFotoSiswa($id)
    {
        $result = new Siswa();
        $getfoto = $result->getPhotoSiswa($id);

        if (! empty($getfoto->foto)) {
            $fotoPath = $getfoto->foto;

            $image_path = 'storage/siswa/images/'.$fotoPath;

            if (File::exists($image_path)) {
                File::delete($image_path);
            }

        }

    }
}
