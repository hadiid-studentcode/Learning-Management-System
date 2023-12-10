<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardSiswaController extends SiswaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = auth()->user()->id;
        // get siswa where id_user
        $result = new Siswa();
        $siswa = $result->getSiswaWhereIdUser(
            [
                'siswa.nama',
                'siswa.nisn',
                'siswa.foto',
                'kelas.nama as kelas',
                'kelas.rombel',
                'guru.nama as nama_guru',
                'guru.nohp as nohp_guru',

            ],

            $id
        );

        return view('siswa.dashboard.index')
            ->with('title', 'Dashboard')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('route', $this->route)
            ->with('siswa', $siswa);
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
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }
}
