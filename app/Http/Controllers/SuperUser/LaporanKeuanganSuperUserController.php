<?php

namespace App\Http\Controllers\SuperUser;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class LaporanKeuanganSuperUserController extends SuperUserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // data pemasukkan (report)

        $resultPemasukkan = new Pemasukan();

        $pemasukanReport = $resultPemasukkan->getPemasukanReport();

        // data pengeluaran (report)

        $resultPengeluaran = new Pengeluaran();
        $pengeluaranReport = $resultPengeluaran->getPengeluaranReport();

        return view('superuser.laporan-keuangan.index')
            ->with('title', 'Laporan Keuangan')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('pemasukkan', $pemasukanReport)
            ->with('pengeluaran', $pengeluaranReport)
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

    public function updatePemasukkanAccepted($no_transaksi)
    {

        // update report pemasukkan menjadi diterima

        $data = [
            'report' => 'Diterima',
        ];

        $result = new Pemasukan();
        $result->updatePemasukkan($no_transaksi, $data);
        $result->deletePembayaran($no_transaksi);

        // hapus data pemasukan

        return redirect('super-user/laporan-keuangan')->with('success', 'Laporan Berhasil Diterima');

    }

    public function updatePemasukkanRejected($no_transaksi)
    {

        // update report pemasukkan menjadi diterima

        $data = [
            'report' => 'Ditolak',
        ];

        $result = new Pemasukan();
        $result->updatePemasukkan($no_transaksi, $data);

        return redirect('super-user/laporan-keuangan')->with('success', 'Laporan Berhasil Ditolak');
    }

    public function updatePengeluaranAccepted($no_transaksi)
    {

        // update report pemasukkan menjadi diterima

        $data = [
            'report' => 'Diterima',
        ];

        $result = new Pengeluaran();
        $result->updatePengeluaran($no_transaksi, $data);

        // hapus data pengeluaran
        $result->deletePengeluaranWhereNoTransaksi($no_transaksi);

        return redirect('super-user/laporan-keuangan')->with('success', 'Laporan Berhasil Diterima');
    }

    public function updatePengeluaranRejected($no_transaksi)
    {

        // update report pemasukkan menjadi diterima

        $data = [
            'report' => 'Ditolak',
        ];

        $result = new Pengeluaran();
        $result->updatePengeluaran($no_transaksi, $data);

        return redirect('super-user/laporan-keuangan')->with('success', 'Laporan Berhasil Ditolak');
    }
}
