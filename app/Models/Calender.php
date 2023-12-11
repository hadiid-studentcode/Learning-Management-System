<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calender extends Model
{
    use HasFactory;

    public function TanggalBahasaIndonesia($tanggal)
    {
        $nama_bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        // Tanggal yang ingin ditampilkan
        // $tanggal = $dataPembayaranSiswa->tanggal;

        // Mendapatkan angka bulan dari tanggal
        $angka_bulan = date('n', strtotime($tanggal));

        // Mendapatkan nama bulan dari array
        $nama_bulan_indonesia = $nama_bulan[$angka_bulan];

        // Format tanggal sesuai keinginan
        $tanggal_bahasaIndonesia = date('d', strtotime($tanggal)).' '.$nama_bulan_indonesia.' '.date('Y', strtotime($tanggal));

        // Menampilkan tanggal dalam format yang diinginkan

        // Tanggal yang ingin ditampilkan
        $tanggal_sekarang = date('Y-m-d');

        // Mendapatkan angka bulan dari tanggal
        $angka_bulan = date('n', strtotime($tanggal_sekarang));

        // Mendapatkan nama bulan dari array
        $nama_bulan_indonesia = $nama_bulan[$angka_bulan];

        // Format tanggal sesuai keinginan
        $tanggal_bahasaIndonesiaNow = date('d', strtotime($tanggal_sekarang)).' '.$nama_bulan_indonesia.' '.date('Y', strtotime($tanggal_sekarang));

        $tanggal_bahasaIndonesia = [
            'tanggal' => $tanggal_bahasaIndonesia,
            'tanggal_sekarang' => $tanggal_bahasaIndonesiaNow,
        ];

        return $tanggal_bahasaIndonesia;

    }

    public function convertDateToBahasaIndonesia($data)
    {

        if (empty($data)) {
            $tanggal = '';
        }

        foreach ($data as $d) {

            $result = new Calender();

            $tanggal = $result->TanggalBahasaIndonesia($d->tanggal_materi);

            return $tanggal;

        }

    }

    public function convertBulanBahasaIndonesia($bulan_english)
    {
        switch ($bulan_english) {
            case 'January':
                $bulan = 'Januari';
                break;

            case 'February':
                $bulan = 'Februari';
                break;

            case 'March':
                $bulan = 'Maret';
                break;

            case 'April':
                $bulan = 'April';
                break;

            case 'May':
                $bulan = 'Mei';
                break;

            case 'June':
                $bulan = 'Juni';
                break;

            case 'July':
                $bulan = 'Juli';
                break;

            case 'August':
                $bulan = 'Agustus';
                break;

            case 'September':
                $bulan = 'September';
                break;

            case 'October':
                $bulan = 'Oktober';
                break;

            case 'November':
                $bulan = 'November';
                break;

            case 'December':
                $bulan = 'Desember';
                break;

            default:

                break;
        }

        return $bulan;
    }
}
