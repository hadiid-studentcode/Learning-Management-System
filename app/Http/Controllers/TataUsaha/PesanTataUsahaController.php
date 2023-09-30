<?php

namespace App\Http\Controllers\TataUsaha;

use App\Models\Guru;
use App\Models\Pegawai;
use App\Models\Pesan;
use App\Models\User;
use App\Models\WaliMurid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PesanTataUsahaController extends TataUsahaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->role = auth()->user()->hak_akses;
        $id_user = Auth::user()->id;

        $result = new Pesan();
        $pesan = $result->viewPesan('Tata Usaha', $id_user);
        $this->img = $this->imageHeader();

        foreach ($pesan as $p) {
            $p->formattedTime = $result->timeDiff($p->created_at);
            $p->shortenedMessage = Str::limit($p->isi_pesan, 50);
        }

        return view('tataUsaha.pesan.index')
            ->with('title', 'Pesan')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('pesan', $pesan)
            ->with('route', $this->route);
    }

    public function search(Request $request)
    {

        $this->role = auth()->user()->hak_akses;
        $id_user = Auth::user()->id;

        $result = new Pesan();
        $pesan = $result->viewPesanSearch('Tata Usaha', $id_user, $request->data);
        $this->img = $this->imageHeader();

        foreach ($pesan as $p) {
            $p->formattedTime = $result->timeDiff($p->created_at);
            $p->shortenedMessage = Str::limit($p->isi_pesan, 50);
        }

        return view('tataUsaha.pesan.index')
            ->with('title', 'Pesan')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('pesan', $pesan)
            ->with('route', $this->route);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $this->img = $this->imageHeader();
        //  kepala sekolah nama dan id_users
        // guru nama dan id_users
        $result = new Guru();
        $guru = $result->getNameGuru();
        // Wali murid nama dan id users
        $result = new WaliMurid();
        $waliMurid = $result->viewWaliMurid(['id_user', 'nama']);

        // get pegawai dan id Users
        $resultPegawai = new Pegawai();
        $pegawai = $resultPegawai->viewPegawai(['id_user', 'nama']);

        return view('tataUsaha.pesan.create')
            ->with('title', 'Pesan')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('route', $this->route)
            ->with('guru', $guru)
            ->with('pegawai', $pegawai)
            ->with('waliMurid', $waliMurid);
    }

    public function balas(Request $request, $id_penerima)
    {

        $id_user = Auth::user()->id;

        if ($request->penerima == 'Super User') {
            $penerima = 'Kepala Sekolah';
        } else {
            $penerima = $request->penerima;
        }

        $data = [
            'perihal' => $request->input('perihal'),
            'id_pengirim' => $id_user,
            'penerima' => $penerima,
            'id_penerima' => $id_penerima,
            'isi_pesan' => htmlspecialchars($request->input('isi_pesan')),
            'status' => 'Pesan Belum Dibaca',
        ];

        $result = new Pesan();
        $result->saveMessage($data);

        return redirect('/tata-usaha/pesan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $perihal = htmlspecialchars($request->input('perihal'));
        // id user pegawai
        $id_pengirim = auth()->user()->id;

        // kondisi jika penerima kepala sekolah, guru dan Wali Murid
        if ($request->input('penerima') == 'Kepala Sekolah') {
            $penerima = 'Kepala Sekolah';
            $result = new User();
            $getIdKepalaSekolah = $result->idKepalaSekolahUser();
            $idpenerima = $getIdKepalaSekolah->id;
        } elseif ($request->input('penerima') == 'Guru') {
            $penerima = 'Guru';
            $idpenerima = $request->input('id_guru');
        } elseif ($request->input('penerima') == 'Wali Murid') {
            $penerima = 'Wali Murid';
            $idpenerima = $request->input('id_walimurid');
        } elseif ($request->input('penerima') == 'Pegawai') {
            $penerima = 'Pegawai';
            $idpenerima = $request->input('id_pegawai');
        }
        $isi_pesan = htmlspecialchars($request->input('isi_pesan'));

        $data = [
            'perihal' => $perihal,
            'id_pengirim' => $id_pengirim,
            'penerima' => $penerima,
            'id_penerima' => $idpenerima,
            'isi_pesan' => $isi_pesan,
            'status' => 'Pesan Belum Dibaca',

        ];

        // save message
        $result = new Pesan();
        $result->saveMessage($data);

        return redirect('/tata-usaha/pesan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $this->title = 'Pesan';
        $id_user = Auth::user()->id;

        $this->role = auth()->user()->hak_akses;

        $result = new Pesan();
        $showPesan = $result->showPesan('Tata Usaha', $id_user, $id);
        $formattedTime = $result->timeDiff($showPesan->created_at);

        // ubah pesan sudah dibaca
        $result = new Pesan();
        $result->updateStatus($showPesan->id, 'Pesan Sudah Dibaca');
        $this->img = $this->imageHeader();

        return view('tataUsaha.pesan.show')
            ->with('title', 'Pesan')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('showPesan', $showPesan)
            ->with('formattedTime', $formattedTime)
            ->with('route', $this->route);
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
        $result = new Pesan();
        $result->deletePesan($id);

        return redirect('tata-usaha/pesan')->with('message', 'Pesan Berhasil Dihapus');
    }
}
