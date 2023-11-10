<?php

namespace App\Http\Controllers\Guru;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AturKkmGuruController extends GuruController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $name = Auth::user()->nama_lengkap;

        $this->img = $this->imageHeader();

        // get mapel dan kelas yang diajarkan

        $resultMapel = new Mapel();
        $mapelGuru = $resultMapel->getMapelWhereNameGuru($name);

        return view('guru.atur-kkm.index')
            ->with('title', $this->title = 'Atur KKM')
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('mapel', $mapelGuru)
            ->with('jenisGuru', $this->jenisGuru())
            ->with('folder', $this->folder);
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
        $id_kelas = $request->kelas;
        $id_mapel = $request->mataPelajaran;
        $kkm = $request->nilaiKKM;

        $data = [
            'KKM' => $kkm,
        ];

        $result = new Mapel();
        $result->updateMapel($data, $id_mapel);
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
        $kkm = $request->kkm;

        $data = [
            'KKM' => $kkm,
        ];

        $result = new Mapel();
        $result->updateMapel($data, $id);

        return back()->with('success', 'Kkm Berhasil Diupdate');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
