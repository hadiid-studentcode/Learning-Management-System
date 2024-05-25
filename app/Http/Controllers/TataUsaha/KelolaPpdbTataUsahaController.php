<?php

namespace App\Http\Controllers\TataUsaha;

use App\Models\Kelas;
use App\Models\PesertaPPDB;
use App\Models\Siswa;
use App\Models\User;
use App\Models\WaliMurid;
use Illuminate\Http\Request;

class KelolaPpdbTataUsahaController extends TataUsahaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resultPPDB = new PesertaPPDB();
        $pesertaPPDB = $resultPPDB->getPesertaPPDB()->where('status_ppdb', 0);

        $resultKelas = new Kelas();
        $kelas = $resultKelas->getkelas();

        return view('tataUsaha.ppdb.index')
            ->with('title', 'Kelola PPDB')
            ->with('role', $this->role)
            ->with('img', $this->imageHeader())
            ->with('route', $this->route)
            ->with('peserta', $pesertaPPDB)
            ->with('kelas', $kelas)
            ->with('folder', $this->folder);
    }

    public function create()
    {
        $resultPPDB = new PesertaPPDB();
        $pesertaPPDB = $resultPPDB->getPesertaPPDB()->where('status_ppdb', 1);

        return view('tataUsaha.ppdb.create')
            ->with('title', 'Kelola PPDB')
            ->with('role', $this->role)
            ->with('peserta', $pesertaPPDB)
            ->with('img', $this->imageHeader())
            ->with('route', $this->route)
            ->with('folder', $this->folder);
    }

    public function destroy($id)
    {
        $resultPesertaPPDB = new PesertaPPDB();

        try {

            // hapus foto
            $resultPesertaPPDB->HapusFotoPeserta($id);
            $resultPesertaPPDB->destroy($id);

            return back();
        } catch (\Throwable $th) {
            return back();
        }
    }

    public function update(Request $request, $id)
    {

        try {

            if ($request->kelas == null) {
                dd('kelas');

                return back()->with('error', 'Kelas harus dipilih');
            }

            // get kelas where id kelas
            $resultKelas = new Kelas();
            $getKelas = $resultKelas->firstKelasWhereIdKelas($request->kelas);

            $dataPesertaPPDB = [
                'kelas_siswa' => $getKelas->kelas.' '.$getKelas->rombel,
                'status_ppdb' => true,
            ];

            $resultPesertaPPDB = new PesertaPPDB();
            $resultPesertaPPDB->updatePesertaPPDB($id, $dataPesertaPPDB);

            $resultSiswa = new Siswa();
            $resultWaliMurid = new WaliMurid();
            $resultUser = new User();

            $id_kelas = $request->kelas;

            $peserta = $resultPesertaPPDB->getPesertaWhereid($id);

            // save user siswa
            $dataUser = [
                'nama_lengkap' => ucwords($peserta->nama_siswa),
                'email' => null,
                'userid' => $peserta->nisn_siswa,
                'password' => bcrypt($peserta->nisn_siswa),
                'foto' => $peserta->foto_siswa,
                'hak_akses' => 'Siswa',
            ];
            $resultUser->saveUsers($dataUser);

            // panggil ide user yang terakhir

            $id = $resultUser->lastIdUser();
            //  save siswa

            $dataSiswa = [
                'nisn' => $peserta->nisn_siswa,
                'nama' => ucwords($peserta->nama_siswa),
                'id_kelas' => $request->kelas,
                'jenis_kelamin' => $peserta->jenis_kelamin_siswa,
                'agama' => ucwords($peserta->jenis_kelamin_siswa),
                'kelurahan' => ucwords($peserta->kelurahan_siswa),
                'kecamatan' => ucwords($peserta->kecamatan_siswa),
                'kabupatenKota' => ucwords($peserta->kabupatenKota_siswa),
                'provinsi' => ucwords($peserta->provinsi_siswa),
                'alamat' => ucwords($peserta->alamat_siswa),
                'tempat_lahir' => ucwords($peserta->tempat_lahir_siswa),
                'tanggal_lahir' => $peserta->tanggal_lahir_siswa,
                'foto' => $peserta->foto_siswa,
                'id_user' => $id,
            ];

            $resultSiswa->saveSiswa($dataSiswa);

            // save user wali murid
            $dataUserWaliMurid = [
                'nama_lengkap' => $peserta->nama_wali_murid,
                'email' => $peserta->email_wali_murid,
                'userid' => $peserta->nama_wali_murid,
                'password' => bcrypt($peserta->nama_wali_murid),
                'foto' => null,
                'hak_akses' => 'Wali Murid',
            ];

            $resultUser->saveUsers($dataUserWaliMurid);

            $id_waliMurid = $resultUser->lastIdUser();
            $id_siswa = $resultSiswa->lastIdSiswa();

            // save wali murid

            $dataWaliMurid = [
                'nik' => $peserta->nik_wali_murid,
                'nama' => ucwords($peserta->nama_wali_murid),
                'hubungan' => ucwords($peserta->hubungan_wali_murid),
                'jenis_kelamin' => $peserta->jenis_kelamin_wali_murid,
                'agama' => ucwords($peserta->agama_wali_murid),
                'no_hp' => $peserta->no_hp_wali_murid,
                'kelurahan' => ucwords($peserta->kelurahan_wali_murid),
                'kecamatan' => ucwords($peserta->kecamatan_wali_murid),
                'kabupatenKota' => ucwords($peserta->kabupatenKota_wali_murid),
                'provinsi' => ucwords($peserta->provinsi_wali_murid),
                'email' => $peserta->email_wali_murid,
                'pekerjaan' => ucwords($peserta->pekerjaan_wali_murid),
                'alamat' => ucwords($peserta->alamat_wali_murid),
                'id_siswa' => $id_siswa,
                'id_user' => $id_waliMurid,
            ];

            $resultWaliMurid->saveWaliMurid($dataWaliMurid);

            return back();
        } catch (\Throwable $th) {
            return back();
        }
    }
}
