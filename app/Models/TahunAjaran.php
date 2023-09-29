<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $table = 'tahun_ajaran';

    protected $fillable = [
        'tahun_ajaran',
    ];

    protected $primaryKey = 'id';

    public function getTahunAjaran()
    {
        $result = DB::table('tahun_ajaran')
            ->select('id', 'tahun_ajaran')
            ->latest()
            ->first();

        return $result;
    }

    public function getTahunAjaranAll()
    {
        $result = DB::table('tahun_ajaran')
            ->select('*')
            ->get();

        return $result;
    }

    public function createTahunAjaranNow()
    {
        // tahun ajaran
        $tahun_mulai = date('Y');
        $tahun_selesai = date('Y') + 1;

        $tahun_ajaran = $tahun_mulai.'/'.$tahun_selesai;

        dd($tahun_ajaran);

        return $tahun_ajaran;
    }

    public function saveTahunAjaran($data)
    {
        return TahunAjaran::create($data);
    }

    public function updateAutoTahunAjaran()
    {
        // input tahun araran
        // tahun ajaran
        $tahunMulai = date('Y');
        $tahunSelesai = date('Y') + 1;
        if (! TahunAjaran::where('tahun_ajaran', $tahunMulai.'-'.$tahunSelesai)->exists()) {
            // return redirect('/tata-usaha/manajemen-mata-pelajaran')->with('error', 'Tahun Ajaran Sudah Ada');
            // save tahun ajaran
            $tahunAjaran = $tahunMulai.'-'.$tahunSelesai;

            $dataTahunAjaran = [
                'tahun_ajaran' => $tahunAjaran,
            ];

            $result = new TahunAjaran();

            return $result->saveTahunAjaran($dataTahunAjaran);
        }
    }

    public function getTahunAjaranWhereId($id)
    {
        $result = DB::table('tahun_ajaran')
            ->select('id', 'tahun_ajaran')
            ->where('id', $id)
            ->first();

        return $result;
    }
}
