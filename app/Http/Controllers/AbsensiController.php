<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\KelolaAbsensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $id_guru = 1;

    

        $kelolaabsensi = new KelolaAbsensi();

        date_default_timezone_set('Asia/Jakarta');

        $date = date('Y-m-d');

       

        $time = date('H:i:s');

      





        $kelola = $kelolaabsensi->getAbsenWhereDateNow(date('Y-m-d'));

      



        return view('absensi')
            ->with('id_guru', $id_guru)
            ->with('time', $time)
            ->with('date', $date)
            ->with('kelola', $kelola);
    }

    public function absensi(Request $request)
    {

        dd($request->all());

        $id_guru = $request->idguru;
        $tanggal = $request->tanggal;
        $waktudatang = $request->waktudatang;
        $waktupulang = $request->waktupulang;
        $status = $request->status;
        $poin = $request->poin;

        $data = [
            'id_guru' => $id_guru,
            'status' => $status,
            'poin' => $poin,
            'waktu_datang' => $waktudatang,
            'waktu_pulang' =>   $waktupulang,
            'tanggal' => $tanggal

        ];

        $absensi = new Absensi();
        $absensi->getDataAbsensi($data);

        return back();
    }
}
