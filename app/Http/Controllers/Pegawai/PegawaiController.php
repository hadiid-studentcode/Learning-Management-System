<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Intervention\Image\Facades\Image;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $title;

    protected $userName;

    protected $role = 'Pegawai';

    protected $route = 'pegawai';

    protected $folder = 'pegawai';

    protected $img;

    public function imageHeader()
    {
        $id = Auth()->user()->id;
        $result = new Pegawai();
        $user_pegawai = $result->getPhotosUser($id);

        $this->img = $user_pegawai->foto;

        return $this->img;
    }

    public function uploadFotoGuru($foto, $dbfoto)
    {
        $img = Image::make($foto);
        // perbaiki rotasi foto
        $img->orientate();
        // kompres gambar
        $img->filesize();

        return $img->save('Assets/images/guru/'.$dbfoto, 10);
    }

    public function uploadFotoPegawai($foto, $dbfoto)
    {
        $folderPath = public_path('Assets/images/pegawai');

        if (! is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $img = Image::make($foto);
        // perbaiki rotasi foto
        $img->orientate();
        // kompres gambar
        $img->filesize();

        return $img->save('Assets/images/pegawai/'.$dbfoto, 10);
    }
}
