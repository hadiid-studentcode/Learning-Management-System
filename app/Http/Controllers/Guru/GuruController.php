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

    public function uploadFotoGuru($foto, $dbfoto)
    {

        $folderPath = public_path('Assets/images/guru');

        if (! is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $img = Image::make($foto);
        // perbaiki rotasi foto
        $img->orientate();
        // kompres gambar
        $img->filesize();

        return $img->save('Assets/images/guru/'.$dbfoto, 10);
    }

    public function uploadMateriGuru($pertemuan, $file, $dbfile)
    {

        // panggil file di database
        $resultMateri = new Pertemuan();
        $getFileMateri = $resultMateri->getPertemuanWhereIdPertemuan($pertemuan);

        $file_path = 'storage/guru/materi/'.$getFileMateri->file_materi;

        if (File::exists($file_path)) {

            File::delete($file_path);
        }

        $folderPath = public_path('storage/guru/materi');

        if (! is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        // simpan file materi
        return $file->storeAs('public/guru/materi/', $dbfile);
    }

    public function uploadTugasGuru($pertemuan, $file, $dbfile)
    {

        // panggil file di database
        $resultTugas = new Pertemuan();
        $getFileTugas = $resultTugas->getPertemuanWhereIdPertemuan($pertemuan);

        $file_path = 'storage/guru/tugas/'.$getFileTugas->file_tugas;

        if (File::exists($file_path)) {

            File::delete($file_path);
        }

        $folderPath = public_path('storage/guru/tugas');

        if (! is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        // simpan file tugas
        return $file->storeAs('public/guru/tugas', $dbfile);
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
