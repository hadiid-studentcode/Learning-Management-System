<?php

namespace App\Http\Controllers\Guru;

use App\Models\Pegawai;
use App\Models\Pesan;
use App\Models\User;
use App\Models\WaliMurid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PesanGuruController extends GuruController
{
    /**
     * Display a listing of the resource.
     */
    protected $title = 'Pesan';

    public function index()
    {
        $id_user = Auth::user()->id;
        $result = new Pesan();
        $pesan = $result->viewPesan('Guru', $id_user);

        foreach ($pesan as $p) {
            $p->formattedTime = $result->timeDiff($p->created_at);

            $p->shortenedMessage = Str::limit($p->isi_pesan, 20);
        }
        $this->img = $this->imageHeader();

        return view('guru.pesan.index')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('jenisGuru', $this->jenisGuru())

            ->with('pesan', $pesan);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->img = $this->imageHeader();
        // get walu murid
        $resultWalimurid = new WaliMurid();
        $getWalimurid = $resultWalimurid->viewWaliMurid(['nama', 'id_user']);
        // get tata usaha
        $resultPegawai = new Pegawai();
        $getTataUsaha = $resultPegawai->getTataUsahaIdandName();
        // get kepala sekolah (users role kepala sekolah)

        return view('guru.pesan.create')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('waliMurid', $getWalimurid)
            ->with('jenisGuru', $this->jenisGuru())

            ->with('tatausaha', $getTataUsaha);
    }

    public function balas(Request $request, $id_penerima)
    {
        $this->img = $this->imageHeader();

        $id_user = Auth::user()->id;

        $data = [
            'perihal' => $request->input('perihal'),
            'id_pengirim' => $id_user,
            'penerima' => $request->input('penerima'),
            'id_penerima' => $id_penerima,
            'isi_pesan' => htmlspecialchars($request->input('isi_pesan')),
            'status' => 'Pesan Belum Dibaca',
        ];

        $result = new Pesan();
        $result->saveMessage($data);

        return redirect('/guru/pesan');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $this->validate($request, [
                'perihal' => 'required',
                'penerima' => 'required',
                'isi_pesan' => 'required',
            ]);
        } catch (\Throwable $th) {
            return back()->with('message', 'Pesan Gagal Dikirim');
        }

        $id_user = Auth::user()->id;

        if ($request->input('id_walimurid') != null) {
            $id_penerima = $request->input('id_walimurid');
        } elseif ($request->input('id_tu') != null) {
            $id_penerima = $request->input('id_tu');
        } else {
            $result = new User();
            $id_kepalaSekolah = $result->idKepalaSekolahUser();
            $id_penerima = $id_kepalaSekolah->id;
        }

        $data = [
            'perihal' => $request->input('perihal'),
            'id_pengirim' => $id_user,
            'penerima' => $request->input('penerima'),
            'id_penerima' => $id_penerima,
            'isi_pesan' => htmlspecialchars($request->input('isi_pesan')),
            'status' => 'Pesan Belum Dibaca',
        ];

        $result = new Pesan();
        $result->saveMessage($data);

        return redirect('guru/pesan')->with('message', 'Pesan Berhasil Dikirim');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->img = $this->imageHeader();

        $id_user = Auth::user()->id;

        $result = new Pesan();
        $showPesan = $result->showPesan('Guru', $id_user, $id);
        $formattedTime = $result->timeDiff($showPesan->created_at);

        // ubah pesan sudah dibaca
        $result = new Pesan();
        $result->updateStatus($showPesan->id, 'Pesan Sudah Dibaca');

        return view('guru.pesan.show')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('id', $id)
            ->with('jenisGuru', $this->jenisGuru())

            ->with('showPesan', $showPesan)
            ->with('formattedTime', $formattedTime);
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
    }

    public function search(Request $request)
    {

        $id_user = Auth::user()->id;
        $result = new Pesan();
        $pesan = $result->viewPesanSearch('Guru', $id_user, $request->data);

        foreach ($pesan as $p) {
            $p->formattedTime = $result->timeDiff($p->created_at);

            $p->shortenedMessage = Str::limit($p->isi_pesan, 20);
        }
        $this->img = $this->imageHeader();

        return view('guru.pesan.index')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('jenisGuru', $this->jenisGuru())

            ->with('pesan', $pesan);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = new Pesan();
        $result->deletePesan($id);

        return redirect('guru/pesan')->with('message', 'Pesan Berhasil Dihapus');
    }
}
