<?php

namespace App\Http\Controllers\TataUsaha;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Intervention\Image\Facades\Image;

class TataUsahaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $title;

    protected $userName;

    protected $role = 'Tata Usaha';

    protected $route = 'tata-usaha';

    protected $folder = 'pegawai';

    protected $img;

    public function deleteFotofile($id)
    {
    }

    public function imageHeader()
    {
        $id = Auth()->user()->id;

        $result = new Pegawai();
        $user_pegawai = $result->getPhotosUser($id);

        $this->img = $user_pegawai->foto;

        return $this->img;
    }

    public function roundFoto($requestFoto)
    {
        $foto = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $requestFoto->getClientOriginalName());

        return $foto;
    }

    public function uploadFotoSiswa($foto, $dbfoto)
    {

        $img = Image::make($foto);
        // perbaiki rotasi foto
        $img->orientate();
        // kompres gambar
        $img->filesize();

        return $img->save('Assets/images/siswa/'.$dbfoto, 10);
    }

    public function uploadFoto($foto, $folder, $dbfoto)
    {

        $folderPath = public_path('Assets/images/'.$folder);

        if (! is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $img = Image::make($foto);
        // perbaiki rotasi foto
        $img->orientate();
        // kompres gambar
        $img->filesize();

        return $img->save('Assets/images/'.$folder.'/'.$dbfoto, 10);
    }
}
