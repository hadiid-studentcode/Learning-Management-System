<?php

namespace App\Http\Controllers\TataUsaha;

use App\Models\User;
use Illuminate\Http\Request;

class ManajemenAkunTataUsahaController extends TataUsahaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->img = $this->imageHeader();
        $userid = auth()->user()->userid;

        $result = new User();
        if ($userid == 'admintu') {
            $getAkun = $result->getUsersAdmintu();
        } else {
            $getAkun = $result->getUsers();

        }

        return view('tataUsaha.manajemen-akun.index')
            ->with('title', 'Manajemen Akun')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('akun', $getAkun)
            ->with('route', $this->route);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {

    //     $data = [
    //         'nama_lengkap' => $request->nama_lengkap,
    //         'email' => '',
    //         'userid' => $request->username,
    //         'password' => bcrypt($request->password),
    //         'foto' => '',
    //         'hak_akses' => $request->posisi,
    //     ];

    //     // save users baru
    //     $result = new User();
    //     $result->saveUsers($data);

    //     return redirect('/tata-usaha/manajemen-akun')->with('success', 'Data berhasil disimpan');
    // }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = [
            'password' => bcrypt($request->password),
        ];

        //    update user
        $result = new User();
        $result->updateData($id, $data);

        return redirect('/tata-usaha/manajemen-akun')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     $result = new User();
    //     $result->deleteUser($id);

    //     return redirect('/tata-usaha/manajemen-akun')->with('success', 'Data berhasil dihapus');
    // }
}
