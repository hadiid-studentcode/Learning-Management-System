<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Pertemuan;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class GuruController extends Controller
{
    protected $title;

    protected $userName;

    protected $role = 'Guru';

    protected $route = 'guru';

    protected $img;

    protected $folder = 'guru';

    public function imageHeader()
    {
        $id = Auth()->user()->id;
        $result = new Guru();
        $user_guru = $result->getGuruFirst(['foto'], $id);
        $this->img = $user_guru->foto;

        return $this->img;
    }


    public function uploadMateriGuru($pertemuan, $file, $dbfile)
    {
        // periksa apakah folder ini ada atau tidak

        $folderPath = 'storage/guru/materi';

        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        // panggil file di database
        $resultMateri = new Pertemuan();
        $getFileMateri = $resultMateri->getPertemuanWhereIdPertemuan($pertemuan);

        $file_path = 'storage/guru/materi/'.$getFileMateri->file_materi;

        if (File::exists($file_path)) {

            File::delete($file_path);
        }

        // $request->photo->store('images', 's3');

        // simpan file materi
      return move_uploaded_file($file, 'storage/guru/materi/'.$dbfile);
        // return $file->move_uploaded_file('storage/guru/materi/', $dbfile);
    }

    public function uploadTugasGuru($pertemuan, $file, $dbfile)
    {

        // periksa folder
        $folderPath = 'storage/guru/tugas';

        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        // panggil file di database
        $resultTugas = new Pertemuan();
        $getFileTugas = $resultTugas->getPertemuanWhereIdPertemuan($pertemuan);

        $file_path = 'storage/guru/tugas/'.$getFileTugas->file_tugas;

        if (File::exists($file_path)) {

            File::delete($file_path);
        }

     

        // simpan file tugas

        return move_uploaded_file($file, 'storage/guru/tugas/'.$dbfile);
    }

    public function jenisGuru()
    {
        $user_id = Auth()->user()->id;

        // get status guru where id user
        $resultGuru = new Guru();
        $guru = $resultGuru->getGuruFirst(['jenis'], $user_id);

        return $guru->jenis;
    }
}
