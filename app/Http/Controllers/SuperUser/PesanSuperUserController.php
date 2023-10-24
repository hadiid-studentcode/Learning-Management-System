<?php

namespace App\Http\Controllers\SuperUser;

use App\Models\Guru;
use App\Models\Pegawai;
use App\Models\Pesan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PesanSuperUserController extends SuperUserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->role = auth()->user()->hak_akses;
        $id_user = Auth::user()->id;

        $result = new Pesan();
        $pesan = $result->viewPesan('Kepala Sekolah', $id_user);

        foreach ($pesan as $p) {
            $p->formattedTime = $result->timeDiff($p->created_at);
            $p->shortenedMessage = Str::limit($p->isi_pesan, 50);
        }

        return view('superuser.pesan.index')
            ->with('title', $this->title = 'Pesan')
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('pesan', $pesan)
            ->with('img', $this->img)
            ->with('folder', $this->folder);
    }

    public function search(Request $request)
    {

        $this->role = auth()->user()->hak_akses;
        $id_user = Auth::user()->id;

        $result = new Pesan();
        $pesan = $result->viewPesanSearch('Kepala Sekolah', $id_user, $request->data);

        foreach ($pesan as $p) {
            $p->formattedTime = $result->timeDiff($p->created_at);
            $p->shortenedMessage = Str::limit($p->isi_pesan, 50);
        }

        return view('superuser.pesan.index')
            ->with('title', $this->title = 'Pesan')
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('pesan', $pesan)
            ->with('img', $this->img)
            ->with('folder', $this->folder);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $this->title = 'Pesan';
        $this->nbm = auth()->user()->userid;
        $this->role = auth()->user()->hak_akses;

        // guru nama dan id_users
        $result = new Guru();
        $guru = $result->getNameGuru();

        // get pegawai dan id Users
        $resultPegawai = new Pegawai();
        $pegawai = $resultPegawai->viewPegawai(['id_user', 'nama']);
        $tataUsaha = $resultPegawai->getTataUsahaIdandName();

        return view('superUser.pesan.create')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('photo', '')
            ->with('guru', $guru)
            ->with('pegawai', $pegawai)
            ->with('tataUsaha', $tataUsaha)

            ->with('img', $this->img)
            ->with('folder', $this->folder);
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
        if ($request->input('penerima') == 'Guru') {
            $penerima = 'Guru';
            $idpenerima = $request->id_guru;
        } elseif ($request->input('penerima') == 'Tata Usaha') {
            $penerima = 'Tata Usaha';
            $idpenerima = $request->id_tu;
        } elseif ($request->input('penerima') == 'Pegawai') {
            $penerima = 'Pegawai';
            $idpenerima = $request->id_pegawai;
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

        return redirect('/super-user/pesan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $this->title = 'Pesan';
        $this->nbm = auth()->user()->userid;
        $id_user = Auth::user()->id;

        $this->role = auth()->user()->hak_akses;

        $result = new Pesan();
        $showPesan = $result->showPesan('Kepala Sekolah', $id_user, $id);

        $formattedTime = $result->timeDiff($showPesan->created_at);

        // ubah pesan sudah dibaca
        $result = new Pesan();
        $result->updateStatus($showPesan->id, 'Pesan Sudah Dibaca');

        return view('superuser.pesan.show')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('showPesan', $showPesan)
            ->with('formattedTime', $formattedTime)

            ->with('photo', '');
    }

    public function balas(Request $request, $id_penerima)
    {

        $id_user = Auth::user()->id;

        $data = [
            'perihal' => $request->input('perihal'),
            'id_pengirim' => $id_user,
            'penerima' => $request->penerima,
            'id_penerima' => $id_penerima,
            'isi_pesan' => htmlspecialchars($request->input('isi_pesan')),
            'status' => 'Pesan Belum Dibaca',
        ];

        $result = new Pesan();
        $result->saveMessage($data);

        return redirect('/super-user/pesan');
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

        return redirect('super-user/pesan')->with('message', 'Pesan Berhasil Dihapus');

    }
}
