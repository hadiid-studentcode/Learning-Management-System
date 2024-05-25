<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';

    protected $fillable = [
        'nik',
        'nbm',
        'nama',
        'jenis',
        'status',
        'bidang_studi',
        'jenis_kelamin',
        'nohp',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'status_perkawinan',
        'kelurahan',
        'kecamatan',
        'kabupatenKota',
        'provinsi',
        'alamat',
        'foto',
        'id_user',
    ];

    protected $primaryKey = 'id';

    public function getNameGuru()
    {
        $result = Guru::select('id_user', 'nama')->get();

        return $result;
    }

    public function getJenisGuruAndIdUsers($id)
    {
        $result = DB::table('guru')
            ->select('id_user')
            ->where('id', '=', $id)
            ->first();

        return $result;
    }

    public function getNoHpAndJenisAttribute($nbm, $user)
    {
        $Guru_nohp_jenis = DB::table('guru')
            ->select('nohp', 'jenis')
            ->where('nbm', '=', $nbm)
            ->where('nama', '=', $user)
            ->first();

        return $Guru_nohp_jenis;
    }

    public function getGuruFirst($select, $id_user)
    {
        $result = DB::table('guru')
            ->select($select)
            ->where('id_user', '=', $id_user)
            ->first();

        return $result;
    }

    public function getGuruFirstWhereId($select, $id)
    {
        $result = DB::table('guru')
            ->select($select)
            ->where('id', '=', $id)
            ->first();

        return $result;
    }

    public function updateGuru($id, $data)
    {
        $result = Guru::where('id', $id)->update($data);

        return $result;
    }

    public function viewGuru($select)
    {
        $result = DB::table('guru')
            ->select($select)
            ->get();

        return $result;
    }

    public function uploadFotoGuru($foto, $dbfoto, $id)
    {
        $folderPath = 'storage/guru/images';

        if (! is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $result = new Guru();
        $getfoto = $result->getGuruFirstWhereId(['foto'], $id);

        if (! empty($getfoto->foto)) {
            $fotoPath = $getfoto->foto;

            $image_path = 'storage/guru/images/'.$fotoPath;

            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        $img = Image::make($foto);
        // perbaiki rotasi foto
        $img->orientate();
        // kompres gambar
        $img->filesize();

        return $img->save('storage/guru/images/'.$dbfoto, 10);
    }

    public function saveGuru($data)
    {
        $result = Guru::create($data);

        return $result;
    }

    public function deleteGuru($id)
    {
        $result = Guru::where('id', $id)->delete();

        return $result;
    }

    public function getUserIdGuru($id)
    {
        $result = DB::table('guru')
            ->select('id_user')
            ->where('id', '=', $id)
            ->first();

        return $result;
    }

    public function viewGuruNonWaliKelas()
    {
        $result = DB::table('guru')
            ->select('id', 'nama')
            ->where('jenis', '=', 'Non Wali Kelas')
            ->get();

        return $result;
    }

    public function HapusFotoGuru($id)
    {
        $result = new Guru();
        $getfoto = $result->getGuruFirstWhereId(['foto'], $id);

        if (! empty($getfoto->foto)) {
            $fotoPath = $getfoto->foto;

            $image_path = 'storage/guru/images/'.$fotoPath;

            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
    }

    public function getGuruCount()
    {
        $result = DB::table('guru')
            ->count();

        return $result;
    }
}
