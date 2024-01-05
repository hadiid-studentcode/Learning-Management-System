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

   
}
