<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenSiswa extends Model
{
    use HasFactory;

    protected $table = 'absen_siswa';

    protected $fillable = [
        'id_siswa',
        'id_pertemuan',
        'waktu',
        'status',

    ];

    protected $primaryKey = 'id';

    public function saveAbsenSiswa($data)
    {
        return AbsenSiswa::create($data);
    }

    public function getAbsenSiswaWhereIdPertemuan($id_pertemuan)
    {
        return AbsenSiswa::where('id_pertemuan', $id_pertemuan)->get();
    }

    public function UpdateAbsenSiswa($data, $id_siswa, $id_pertemuan)
    {
        return AbsenSiswa::where('id_siswa', $id_siswa)->where('id_pertemuan', $id_pertemuan)->update($data);
    }

    public function getPoinAbsen()
    {

        $hadir =  AbsenSiswa::where('status', 'Hadir')->count();
        $sakit =  AbsenSiswa::where('status', 'Sakit')->count();
        $izin =  AbsenSiswa::where('status', 'Izin')->count();
        $tidak_hadir =  AbsenSiswa::where('status', 'Tidak Hadir')->count();



        $data = [
            'hadir' => $hadir,
            'sakit' => $sakit,
            'izin' => $izin,
            'tidak_hadir' => $tidak_hadir
        ];

        return $data;
    }
}
