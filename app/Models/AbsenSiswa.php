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
}
