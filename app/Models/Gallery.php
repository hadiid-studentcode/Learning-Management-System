<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery';

    protected $fillable = [
        'nama',
        'jenis',
        'deskripsi',
        'tempat',
        'date',
        'foto',
    ];

    protected $primaryKey = 'id';

    public function saveGallery($data)
    {
        $result = Gallery::create($data);

        return $result;
    }

    public function getGallery()
    {
        return Gallery::all();
    }

    public function deleteGallery($id)
    {
        return Gallery::where('id', $id)->delete();
    }

    public function getPhotoGallery($id)
    {
        $result = DB::table('gallery')
            ->select('foto')
            ->where('id', $id)
            ->first();

        return $result;
    }

    public function uploadFotoGallery($foto, $dbfoto, $id)
    {
        $folderPath = 'storage/gallery';

        if (! is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $result = new Gallery();
        $getfoto = $result->getPhotoGallery($id);

        if (! empty($getfoto->foto)) {
            $fotoPath = $getfoto->foto;

            $image_path = 'storage/gallery/'.$fotoPath;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        $img = Image::make($foto);
        // perbaiki rotasi foto
        $img->orientate();
        // kompres gambar
        $img->filesize();

        return $img->save('storage/gallery/'.$dbfoto, 10);
    }
}
