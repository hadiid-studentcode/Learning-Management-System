<?php

namespace App\Http\Controllers\WaliMurid;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\WaliMurid;

class WaliMuridController extends Controller
{
    protected $title;

    protected $role = 'Wali Murid';

    protected $route = 'wali-murid';

    protected $folder = 'siswa';

    protected $img;

    public function imageHeader()
    {

        $id_user = Auth()->user()->id;

        // panggil nisn siswa
        $result = new WaliMurid();
        $siswa = $result->getSiswa($id_user);

        if ($siswa == null) {
            $siswa = $result->firstSiswa($id_user);
        }

        return $img_siswa = $siswa->foto;

    }
}
