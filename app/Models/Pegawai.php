<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    protected $fillable = [
        'nik',
        'nama',
        'jenis',
        'no_hp',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
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

    public function getNoHpAndJenisAttribute($id_user)
    {
        $pegawai_nohp_jenis = DB::table('pegawai')
            ->select('no_hp', 'jenis')
            ->where('id_user', $id_user)
            ->first();

        return $pegawai_nohp_jenis;
    }

    public function getPegawaiFirst($Select, $id)
    {

        return
            DB::table('pegawai')
            ->select($Select)
            ->join('users', 'pegawai.id_user', '=', 'users.id')
            ->where('id_user', $id)
            ->first();
    }

    public function getPhotosUser($id)
    {
        return
            DB::table('pegawai')
            ->select('foto')
            ->where('id_user', $id)
            ->first();
    }

    public function getTataUsahaIdandName()
    {
        $result = DB::table('pegawai')
            ->select('pegawai.id_user', 'pegawai.nama')
            ->join('users', 'pegawai.id_user', '=', 'users.id')
            ->where('users.hak_akses', '=', 'Tata Usaha')
            ->whereNot('pegawai.jenis', '=', 'admin')
            ->get();

        return $result;
    }

    public function getJenisPegawaiAndIdUsers($id)
    {
        $result = DB::table('pegawai')
            ->select('jenis', 'id_user')
            ->where('id_user', '=', $id)
            ->first();

        return $result;
    }

    public function updatePegawai($id, $data)
    {
        $result = Pegawai::where('id', $id)->update($data);

        return $result;
    }

    public function updatePegawaiWhereIdUsers($id_user, $data)
    {
        $result = Pegawai::where('id_user', $id_user)->update($data);

        return $result;
    }

    public function getTataUsahaBagianHumas()
    {
        $result = DB::table('pegawai')
            ->select('users.id')
            ->join('users', 'pegawai.id_user', '=', 'users.id')
            ->where('jenis', '=', 'Bagian Hubungan Masyarakat')
            ->where('users.hak_akses', '=', 'Tata Usaha')
            ->first();

        return $result;
    }

    public function getfotoPegawai($id)
    {

        $result = DB::table('pegawai')
            ->select('foto')
            ->where('id_user', '=', $id)
            ->first();

        return $result;
    }

    public function savePegawai($data)
    {
        return Pegawai::create($data);
    }

    public function getPegawai()
    {
        return Pegawai::all();
    }

    public function deletePegawai($id)
    {
        return Pegawai::where('id', $id)->delete();
    }

    public function uploadFotoPegawai($foto, $dbfoto, $id)
    {

        $result = new Pegawai();
        $getfoto = $result->getfotoPegawai($id);

        if (!empty($getfoto->foto)) {
            $fotoPath = $getfoto->foto;

            $image_path = 'storage/pegawai/images/' . $fotoPath;

            // dd($image_path);

            if (File::exists($image_path)) {

                // dd('masuk');

                File::delete($image_path);
            }

            // dd('tidak');
        }

        $folderPath = public_path('storage/pegawai/images');

        if (!is_dir($folderPath)) {

            mkdir($folderPath, 0777, true);
        }

        $img = Image::make($foto);
        // perbaiki rotasi foto
        $img->orientate();
        // kompres gambar
        $img->filesize();

        return $img->save('storage/pegawai/images/' . $dbfoto, 10);
    }

    public function getUserIdPegawai($id)
    {
        $result = DB::table('pegawai')
            ->select('id_user')
            ->where('id', '=', $id)
            ->first();

        return $result;
    }

    public function viewTataUsaha($select)
    {
        return DB::table('pegawai')
            ->select($select)
            ->join('users', 'pegawai.id_user', '=', 'users.id')
            ->where('users.hak_akses', '=', 'Tata Usaha')
            ->get();
    }

    public function viewPegawai($select)
    {
        return DB::table('pegawai')
            ->select($select)
            ->join('users', 'pegawai.id_user', '=', 'users.id')
            ->where('users.hak_akses', '=', 'Pegawai')
            ->get();
    }

    public function getPegawaiCount()
    {
        $result = DB::table('pegawai')
            ->count();

        return $result;
    }

    public function getPegawaiFirstWhereId($select, $id)
    {
        $result = DB::table('pegawai')
            ->select($select)
            ->where('id', '=', $id)
            ->first();

        return $result;
    }

    public function HapusFotoPegawai($id)
    {
        $result = new Pegawai();
        $getfoto = $result->getPegawaiFirstWhereId(['foto'], $id);

        if (!empty($getfoto->foto)) {
            $fotoPath = $getfoto->foto;

            $image_path = 'storage/pegawai/images/' . $fotoPath;

            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
    }
}
