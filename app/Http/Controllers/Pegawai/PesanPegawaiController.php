<?php

namespace App\Http\Controllers\Pegawai;

use App\Models\Guru;
use App\Models\Pegawai;
use App\Models\Pesan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PesanPegawaiController extends PegawaiController
{
    private $guru;

    private $tatausaha;

    private $photos;

    private $idUser;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->title = 'Pesan';
        $id = auth()->user()->id;
        $this->role = auth()->user()->hak_akses;
        $id_user = Auth::user()->id;

        $result = new Pegawai();
        $resultPhotos = $result->getPhotosUser($id);
        $this->img = $resultPhotos->foto;

        $result = new Pesan();
        $pesan = $result->viewPesan('Pegawai', $id_user);

        foreach ($pesan as $p) {
            $p->formattedTime = $result->timeDiff($p->created_at);
            $p->shortenedMessage = Str::limit($p->isi_pesan, 50);
        }

        return view('pegawai.pesan.index')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('pesan', $pesan)
            ->with('photo', $this->photos);
    }

    public function search(Request $request)
    {
        $this->title = 'Pesan';
        $id = auth()->user()->id;
        $this->role = auth()->user()->hak_akses;
        $id_user = Auth::user()->id;

        $result = new Pegawai();
        $resultPhotos = $result->getPhotosUser($id);
        $this->img = $resultPhotos->foto;

        $result = new Pesan();
        $pesan = $result->viewPesanSearch('Pegawai', $id_user, $request->data);

        foreach ($pesan as $p) {
            $p->formattedTime = $result->timeDiff($p->created_at);
            $p->shortenedMessage = Str::limit($p->isi_pesan, 50);
        }

        return view('pegawai.pesan.index')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
            ->with('pesan', $pesan)
            ->with('photo', $this->photos);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->title = 'Pesan';
        $id = auth()->user()->id;

        $result = new Pegawai();
        $resultPhotos = $result->getPhotosUser($id);
        $this->img = $resultPhotos->foto;
        $this->role = auth()->user()->hak_akses;

        // query guru [id,nama]
        $result = new Guru();
        $this->guru = $result->getNameGuru();

        // query pegawai [id,nama] where pegawai
        $result = new Pegawai();
        $this->tatausaha = $result->getTataUsahaIdandName();

        return view('pegawai.pesan.create')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('guru', $this->guru)
            ->with('img', $this->img)
            ->with('folder', $this->folder)

            ->with('tataUsaha', $this->tatausaha);
    }

    public function balas(Request $request, $id_penerima)
    {

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

        return redirect('/pegawai/pesan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $perihal = htmlspecialchars($request->input('perihal'));
        // id user pegawai
        $id_pengirim = auth()->user()->id;

        // kondisi jika penerima kepala sekolah, guru dan tata usaha
        if ($request->input('penerima') == 'Kepala Sekolah') {
            $penerima = 'Kepala Sekolah';
            $result = new User();
            $getIdKepalaSekolah = $result->idKepalaSekolahUser();
            $idpenerima = $getIdKepalaSekolah->id;
        } elseif ($request->input('penerima') == 'Guru') {
            $penerima = 'Guru';
            $idpenerima = $request->input('id_guru');
        } elseif ($request->input('penerima') == 'Tata Usaha') {
            $penerima = 'Tata Usaha';
            $idpenerima = $request->input('id_tu');
        }
        $isi_pesan = htmlspecialchars($request->input('isi_pesan'));
        date_default_timezone_set('Asia/Jakarta');

        $data = [
            'perihal' => $perihal,
            'id_pengirim' => $id_pengirim,
            'penerima' => $penerima,
            'id_penerima' => $idpenerima,
            'isi_pesan' => $isi_pesan,
            'status' => 'Pesan Belum Dibaca',
            'tanggal' => date('Y-m-d'),
        ];

        // save message
        $result = new Pesan();
        $result->saveMessage($data);

        return redirect('/pegawai/pesan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->title = 'Pesan';
        $id = auth()->user()->id;
        $id_user = Auth::user()->id;

        $result = new Pegawai();
        $resultPhotos = $result->getPhotosUser($id);
        $this->img = $resultPhotos->foto;
        $this->role = auth()->user()->hak_akses;

        $result = new Pesan();
        $showPesan = $result->showPesan('Pegawai', $id_user, $id);
        $formattedTime = $result->timeDiff($showPesan->created_at);

        // ubah pesan sudah dibaca
        $result = new Pesan();
        $result->updateStatus($showPesan->id, 'Pesan Sudah Dibaca');

        return view('pegawai.pesan.phow')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('img', $this->img)
            ->with('folder', $this->folder)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = new Pesan();
        $result->deletePesan($id);

        return redirect('pegawai/pesan')->with('message', 'Pesan Berhasil Dihapus');
    }
}
