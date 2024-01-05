<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class PesertaPPDB extends Model
{
    use HasFactory;
    protected $table = 'peserta_ppdb';

    protected $fillable = [

        'nisn_siswa',
        'nama_siswa',
        'kelas_siswa',
        'jenis_kelamin_siswa',
        'agama_siswa',
        'kelurahan_siswa',
        'kecamatan_siswa',
        'kabupatenKota_siswa',
        'provinsi_siswa',
        'alamat_siswa',
        'tempat_lahir_siswa',
        'tanggal_lahir_siswa',
        'foto_siswa',
        'nik_wali_murid',
        'nama_wali_murid',
        'hubungan_wali_murid',
        'jenis_kelamin_wali_murid',
        'agama_wali_murid',
        'no_hp_wali_murid',
        'kelurahan_wali_murid',
        'kecamatan_wali_murid',
        'kabupatenKota_wali_murid',
        'provinsi_wali_murid',
        'email_wali_murid',
        'pekerjaan_wali_murid',
        'alamat_wali_murid',
        'status_ppdb',

    ];

    protected $primaryKey = 'id';

    public function createPesertaPPDB($data)
    {
        return PesertaPPDB::create($data);
    }

    public function uploadFotoPesertaPPDB($foto, $dbfoto)
    {

        $folderPath = 'storage/siswa/images';

        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }


        if (!empty($dbfoto)) {
            $image_path = 'storage/siswa/images/' . $dbfoto;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }

       


        $img = Image::make($foto);
        // perbaiki rotasi foto
        $img->orientate();
        // kompres gambar
        $img->filesize();



        return $img->save('storage/siswa/images/' . $dbfoto);
    }

    public function getPesertaPPDB()
    {
        return  PesertaPPDB::all();
    }

    public function getPesertaWhereid($id)
    {
        return PesertaPPDB::where('id', $id)->first();
    }

    public function HapusFotoPeserta($id)
    {
        $resultPesertaPPDB = new PesertaPPDB();

        $peserta =  $resultPesertaPPDB->getPesertaWhereid($id);

        if (!empty($peserta->foto_siswa)) {
            $fotoPath = $peserta->foto_siswa;

            $image_path = 'storage/siswa/images/' . $fotoPath;

            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
    }
    public function updatePesertaPPDB($id, $data)
    {

        return PesertaPPDB::where('id', $id)->update($data);
    }
}
