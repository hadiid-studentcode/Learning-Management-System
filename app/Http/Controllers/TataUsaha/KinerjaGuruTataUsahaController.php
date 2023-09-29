<?php

namespace App\Http\Controllers\TataUsaha;

use App\Models\Guru;
use App\Models\Kinerja;
use App\Models\Pertemuan;
use Illuminate\Http\Request;

class KinerjaGuruTataUsahaController extends TataUsahaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $result = new Kinerja();
        $kinerjaGuru = $result->viewKinerjaGuru(['*']);
        $this->img = $this->imageHeader();

        // get guru
        $resultGuru = new Guru();
        $guru = $resultGuru->viewGuru('*');

        // get poin upload tugas dan upload materi
        $resultPertemuan = new Pertemuan();
        $poin = $resultPertemuan->getPoinUploadMateriDanTugas();

        return view('tataUsaha.kinerja-guru.index')
            ->with('title', 'Kinerja Guru')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('route', $this->route)
            ->with('guru', $guru)
            ->with('poin', $poin)
            ->with('kinerjaGuru', $kinerjaGuru);
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
