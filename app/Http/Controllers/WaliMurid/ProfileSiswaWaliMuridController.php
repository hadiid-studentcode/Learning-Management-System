<?php

namespace App\Http\Controllers\WaliMurid;

use App\Models\Pemasukan;
use App\Models\WaliMurid;
use Illuminate\Http\Request;

class ProfileSiswaWaliMuridController extends WaliMuridController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->title = 'Profile Siswa';
        $id = auth()->user()->id;

        // data siswa
        $result = new WaliMurid();
        $siswa = $result->getSiswa($id);

        if ($siswa == null) {
            $siswa = $result->firstSiswa($id);
            $siswa->guru = 'Belum Ada Wali Kelas';
        }

        // status pembayaran berdasarkan id siswa
        $nisn_siswa = $siswa->nisn;
        $result = new Pemasukan();
        $status_pembayaran = $result->getStatusPembayaran($nisn_siswa);

        $status = '';
        

        // status pembayaran spp
        foreach ($status_pembayaran as $s) {
            $status = $s->deskripsi;

            if ($status == 'Belum Lunas') {
                $status = 'Belum Lunas';
            } else {
                $status = 'Lunas';
            }

        }

        $this->img = $this->imageHeader();

        return view('waliMurid.profile-siswa.index')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('siswa', $siswa)

            ->with('status', $status);

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
        //
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
        //
    }
}
