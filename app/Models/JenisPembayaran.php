<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class JenisPembayaran extends Model
{
    use HasFactory;

    protected $table = 'jenis_pembayaran';

    protected $fillable = [
        'jenis',
        'nominal',

    ];

    protected $primaryKey = 'id';

    public function getJenisPembayaranAll($select)
    {
        return JenisPembayaran::select($select)->get();

    }

    public function getSppSiswa($select)
    {
        return
        DB::table('jenis_pembayaran')
            ->select('jenis', 'nominal')
            ->where('jenis', 'Uang SPP Kelas 1')
            ->orWhere('jenis', 'Uang SPP Kelas 2-6')
            ->get();

    }
}
