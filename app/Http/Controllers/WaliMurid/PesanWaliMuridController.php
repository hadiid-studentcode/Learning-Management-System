<?php

namespace App\Http\Controllers\WaliMurid;

use App\Models\Guru;
use App\Models\Pegawai;
use App\Models\Pesan;
use App\Models\WaliMurid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PesanWaliMuridController extends WaliMuridController
{
    private $guru;

    private $tatausaha;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->title = 'Pesan';
        $id = auth()->user()->id;
        $result = new WaliMurid();
        $getFoto = $result->getFotoSiswa($id);

        $id_user = Auth::user()->id;
        $result = new Pesan();
        $pesan = $result->viewPesan('Wali Murid', $id_user);

        foreach ($pesan as $p) {
            $p->formattedTime = $result->timeDiff($p->created_at);

            $p->shortenedMessage = Str::limit($p->isi_pesan, 20);
        }
        $this->img = $this->imageHeader();

        return view('waliMurid.pesan.index')
            ->with('title', $this->title)
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
        $id = auth()->user()->id;
        $result = new WaliMurid();
        $getFoto = $result->getFotoSiswa($id);

        // query guru [id,nama]
        $result = new Guru();
        $this->guru = $result->getNameGuru();

        // query pegawai [id,nama] where pegawai
        $result = new Pegawai();
        $this->tatausaha = $result->getTataUsahaIdandName();
        $this->img = $this->imageHeader();

        return view('waliMurid.pesan.create')
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

        return redirect('/wali-murid/pesan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $perihal = $request->input('perihal');
        $penerima = $request->input('penerima');
        $id_guru = $request->input('id_guru');
        $subjek = $request->input('subjek');
        $pesan = $request->input('isi_pesan');
        $id_user = auth()->user()->id;
        $date = date('Y-m-d');

        $result = new Pesan();

        //    kondisi jika kirim ke guru
        if ($penerima == 'Guru') {
            $data = [
                'perihal' => $perihal,
                'id_pengirim' => $id_user,
                'penerima' => $penerima,
                'id_penerima' => $id_guru,
                'subjek' => $subjek,
                'isi_pesan' => $pesan,
                'status' => 'Pesan Belum Dibaca',
                'tanggal' => $date,
            ];
            $result->saveMessage($data);

            return redirect('/wali-murid/pesan');

        } else {
            // tata usaha
            // id user ketua tata usaha
            $result = new Pegawai();
            $id_user_ketuaTataUsaha = $result->getKetuaTataUsaha();

            $data = [
                'perihal' => $perihal,
                'id_pengirim' => $id_user,
                'penerima' => $penerima,
                'id_penerima' => $id_user_ketuaTataUsaha->id,
                'isi_pesan' => $pesan,
                'status' => 'Pesan Belum Dibaca',
                'tanggal' => $date,
            ];

            $result = new Pesan();

            $result->saveMessage($data);

            return redirect('/wali-murid/pesan');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->title = 'Pesan';
        $id_user = auth()->user()->id;
        $result = new WaliMurid();
        $getFoto = $result->getFotoSiswa($id_user);

        $result = new Pesan();
        $showPesan = $result->showPesan('Wali Murid', $id_user, $id);

        $formattedTime = $result->timeDiff($showPesan->created_at);

        // ubah pesan sudah dibaca
        $result = new Pesan();
        $result->updateStatus($showPesan->id, 'Pesan Sudah Dibaca');
        $this->img = $this->imageHeader();

        return view('waliMurid.pesan.show')
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

        return redirect('wali-murid/pesan')->with('message', 'Pesan Berhasil Dihapus');
    }
}
