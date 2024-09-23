<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensi';

    protected $fillable = [
        'id_guru',
        'status',
        'poin',
        'waktu_datang',
        'waktu_pulang',
        'tanggal',
    ];

    public function getDataAbsensi($data)
    {
       return DB::table('absensi')->insert($data);
    }
}
