<?php

namespace App\Http\Controllers\TataUsaha;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryTataUsahaController extends TataUsahaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $result = new Gallery();
        $data = $result->getGallery();

        $this->img = $this->imageHeader();

        return view('tataUsaha.gallery.index')
            ->with('title', 'Gallery')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('gallery', $data)
            ->with('route', $this->route);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'nama_kegiatan' => 'required',
                'jenis_kegiatan' => 'required',
                'deskripsi_kegiatan' => 'required',
                'tempat_kegiatan' => 'required',
                'tanggal_kegiatan' => 'required',
                'foto_kegiatan' => 'mimes:jpg,jpeg,png|max:10000|required',
            ]);

            // Kode ini akan dieksekusi jika validasi berhasil

            $foto = $this->roundFoto($request->foto_kegiatan);

            $data = [
                'nama' => $request->nama_kegiatan,
                'jenis' => $request->jenis_kegiatan,
                'deskripsi' => $request->deskripsi_kegiatan,
                'tempat' => $request->tempat_kegiatan,
                'date' => $request->tanggal_kegiatan,
                'foto' => $foto,
            ];

            // simpan gallery ke database
            $result = new Gallery();
            $result->saveGallery($data);

            // upload ke folder gallery
            $result->uploadFotoGallery($request->foto_kegiatan, $foto, '');

            return redirect('/tata-usaha/gallery');

        } catch (\Illuminate\Validation\ValidationException $exception) {
            // Kode ini akan dieksekusi jika validasi gagal
            return back()->withErrors($exception->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = new Gallery();
        $result->deleteGallery($id);

        return redirect('tata-usaha/gallery')->with('message', 'Gallery Berhasil Dihapus');

    }
}
