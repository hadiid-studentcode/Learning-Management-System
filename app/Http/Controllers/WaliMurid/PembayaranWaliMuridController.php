<?php

namespace App\Http\Controllers\WaliMurid;

use App\Models\Calender;
use App\Models\Pemasukan;
use App\Models\WaliMurid;
use Illuminate\Http\Request;

class PembayaranWaliMuridController extends WaliMuridController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->title = 'Pembayaran';
        $id = auth()->user()->id;

        $result = new WaliMurid();
        $getFoto = $result->getFotoSiswa($id);
        $this->img = $this->imageHeader();

        // data pembayaran
        // $getSiswa_id = $result->getIdSiswa($id);
        $getSiswa = $result->getSiswa($id);

        if ($getSiswa == null) {
            $getSiswa = $result->firstSiswa($id);
            $getSiswa->guru = 'Belum Ada Wali Kelas';
        }

        $result = new Pemasukan();
        $pembayaran = $result->getPemasukanSiswaByNisn(['*'], $getSiswa->nisn);

        if (! empty($pembayaran)) {

            $tanggal['tanggal'] = '';
        }

        foreach ($pembayaran as $p) {
            $result = new Calender();
            $tanggal = $result->TanggalBahasaIndonesia($p->tanggal);

        }

        return view('waliMurid.pembayaran.index')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('siswa', $getSiswa)
            ->with('pembayaran', $pembayaran)
            ->with('tanggal', $tanggal['tanggal'])
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
