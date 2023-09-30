<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pesan extends Model
{
    use HasFactory;

    protected $table = 'pesan';

    protected $fillable = [
        'perihal',
        'id_pengirim',
        'penerima',
        'id_penerima',
        'isi_pesan',
        'status',
    ];

    protected $primaryKey = 'id';

    private $statusPesan = 'Pesan Belum Dibaca';

    public function saveMessage($data)
    {
        $result = Pesan::create($data);

        return $result;
    }

    public function viewPesan($penerima, $id_penerima)
    {
        return
            DB::table('pesan')
                ->select('pesan.id', 'pesan.perihal', 'pesan.created_at', 'pesan.isi_pesan', 'users.nama_lengkap as namaPengirim', 'pesan.status')
                ->join('users', 'pesan.id_pengirim', '=', 'users.id')
                ->where('penerima', $penerima)
                ->where('id_penerima', $id_penerima)
                ->latest()
                ->paginate(10);
    }

    public function viewPesanSearch($penerima, $id_penerima, $keyword)
    {
        return DB::table('pesan')
            ->select('pesan.id', 'pesan.perihal', 'pesan.created_at', 'pesan.isi_pesan', 'users.nama_lengkap as namaPengirim', 'pesan.status')
            ->join('users', 'pesan.id_pengirim', '=', 'users.id')
            ->where(function ($query) use ($penerima, $id_penerima, $keyword) {
                $query->where('penerima', $penerima)
                    ->where('id_penerima', $id_penerima)
                    ->where(function ($query) use ($keyword) {
                        $query->where('pesan.perihal', 'LIKE', '%'.$keyword.'%')
                            ->orWhere('pesan.isi_pesan', 'LIKE', '%'.$keyword.'%');
                    });
            })
            ->latest()
            ->paginate(10);
    }

    public function showPesan($penerima, $id_penerima, $id_pesan)
    {
        return
            DB::table('pesan')
                ->select('pesan.id', 'pesan.perihal', 'pesan.created_at', 'pesan.isi_pesan', 'pesan.id_pengirim', 'users.nama_lengkap as namaPengirim', 'users.hak_akses as role')
                ->join('users', 'pesan.id_pengirim', '=', 'users.id')
                ->where('penerima', $penerima)
                ->where('id_penerima', $id_penerima)
                ->where('pesan.id', $id_pesan)
                ->first();
    }

    public function deletePesan($id)
    {

        return DB::table('pesan')->where('id', $id)->delete();
    }

    public function timeDiff($date)
    {
        $dbDate = Carbon::parse($date);

        $diff = $dbDate->diffInMinutes(Carbon::now());

        if ($diff < 1) {
            return 'Baru Saja';
        } elseif ($diff < 60) {
            return $diff.' Menit Yang Lalu';
        } elseif ($diff < 1440) {
            $hours = floor($diff / 60);

            return $hours.' Jam Yang Lalu';
        } elseif ($diff < 43200) {
            $days = floor($diff / 1440);

            return $days.' Hari Yang Lalu';
        } elseif ($diff < 86400) {
            $days = floor($diff / 43200);

            return $days.' Minggu Yang Lalu';
        } elseif ($diff < 604800) {
            $days = floor($diff / 86400);

            return $days.' Bulan Yang Lalu';
        } elseif ($diff < 2592000) {
            $days = floor($diff / 604800);

            return $days.' Tahun Yang Lalu';
        } else {
            return $diff.' Hari yang Lalu';
        }
    }

    public function updateStatus($id, $status)
    {
        return DB::table('pesan')->where('id', $id)->update(['status' => $status]);
    }

    public function jumlahPesanBelumDibaca($id_user)
    {
        $result = DB::table('pesan')
            ->where('id_penerima', $id_user)
            ->where('status', 'Pesan Belum Dibaca')
            ->count();

        return $result;
    }
}
