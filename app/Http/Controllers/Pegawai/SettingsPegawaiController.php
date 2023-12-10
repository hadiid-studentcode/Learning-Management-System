<?php

namespace App\Http\Controllers\Pegawai;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class SettingsPegawaiController extends PegawaiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->title = 'Settings';
        $id = auth()->user()->id;

        $email = auth()->user()->email;
        $username = auth()->user()->userid;

        $result = new Pegawai();
        $getPegawaiFirst = $result->getPegawaiFirst(['*'], $id);

        $string = $getPegawaiFirst->foto;
        $parts = explode('-', $string);
        $filename = end($parts);

        $this->img = $this->imageHeader();

        return view('pegawai.setting.index')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('pegawai', $getPegawaiFirst)
            ->with('username', $username)
            ->with('emailUser', $email)
            ->with('photo', $getPegawaiFirst->foto)
            ->with('filename', $filename)
            ->with('img', $this->img)
            ->with('folder', $this->folder);

    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([

            'foto' => 'mimes:jpg,jpeg,png|max:5000',
        ]);

        // panggil jenis pegawai berdasarkan id
        $result = new Pegawai();
        // $getJenisAndIdUsers = $result->getJenisPegawaiAndIdUsers($id);

        // $jenis = $getJenisAndIdUsers->jenis;

        if ($request->hasfile('foto')) {

            $foto = round(microtime(true) * 1000).'-'.str_replace(' ', '-', $request->file('foto')->getClientOriginalName());

            $data = [
                'nama' => $request->input('nama'),
                'no_hp' => $request->input('nohp'),
                'tempat_lahir' => $request->input('tempatlahir'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'agama' => $request->input('agama'),
                'status_perkawinan' => $request->input('status_perkawinan'),
                'kelurahan' => $request->input('kelurahan'),
                'kecamatan' => $request->input('kecamatan'),
                'kabupatenKota' => $request->input('kabupatenKota'),
                'provinsi' => $request->input('provinsi'),
                'alamat' => $request->input('alamat'),
                'foto' => $foto,
            ];

            // upload foto pegawai
            $result->uploadFotoPegawai($request->file('foto'), $foto, $id);

            // panggil foto di database
            // $getfoto = $result->getPhotosUser($id);
            // $fotoPath = $getfoto->foto;

            // $image_path = './Assets/images/pegawai/'.$fotoPath;

            // // dd($image_path);

            // if (File::exists($image_path)) {
            //     File::delete($image_path);
            // }

            // simpan Pegawai ke database
            // $result = new Pegawai();
            $result->updatePegawaiWhereIdUsers($id, $data);

            $resultUsers = new User();
            $resultUsers->updateUserName($id, [
                'nama_lengkap' => $request->input('nama'),
                'foto' => $foto,
            ]);

            // $img = Image::make($request->file('foto'));
            // // kompres gambar
            // $img->filesize();
            // $img->save('Assets/images/pegawai/'.$foto, 10);

            // ubah nama lengkap di tabel user

            return redirect('/pegawai/setting');
        } elseif ($request->hasfile('foto') == false) {

            $data = [
                'nama' => $request->input('nama'),
                'no_hp' => $request->input('nohp'),
                'tempat_lahir' => $request->input('tempatlahir'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'agama' => $request->input('agama'),
                'status_perkawinan' => $request->input('status_perkawinan'),
                'kelurahan' => $request->input('kelurahan'),
                'kecamatan' => $request->input('kecamatan'),
                'kabupatenKota' => $request->input('kabupatenKota'),
                'provinsi' => $request->input('provinsi'),
                'alamat' => $request->input('alamat'),
            ];

            // simpan Pegawai ke database
            $result->updatePegawaiWhereIdUsers($id, $data);
            // ubah nama lengkap di tabel user
            $resultUsers = new User();
            $resultUsers->updateUserName($id, ['nama_lengkap' => $request->input('nama')]);

            return redirect('/pegawai/setting');
        } else {
            return back()
                ->with('warning', 'Data Pegawai Gagal Disimpan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     //
    // }
}
