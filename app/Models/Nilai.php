<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';

    protected $fillable = [
        'id_siswa',
        'id_mapel',
        'semester',
        'nilai_uh',
        'nilai_tugas',
        'nilai_uts',
        'nilai_uas',
        'nilai_akhir',

    ];

    protected $primaryKey = 'id';
}
