@extends('layouts.main')

@section('main')
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="d-flex mr-3">
                    <h2 href="#" class="text-dark-75 text-hover-success font-size-h1 mr-3">
                        {{ $mapel->nama }} | {{ $mapel->hari }}
                    </h2>
                </div>
                <hr>

                <table style="width:100%;">
                    <tbody>
                        <tr>
                            <td style="width: 20%">Kelas</td>
                            <td style="width: 80%">: {{ $mapel->kelas }} {{ $mapel->rombel }} <b></b></td>
                        </tr>
                        <tr>
                            <td>Kode Mapel</td>
                            <td>: {{ $mapel->kode }} <b></b></td>
                        </tr>
                        <tr>
                            <td>Hari, Jam Mulai s/d Selesai</td>
                            <td>: {{ $mapel->hari }}, {{ substr($mapel->waktu_mulai, 0, 5) }} WIB - {{ substr($mapel->waktu_selesai, 0, 5) }} WIB <b></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- menu materi dan Nilai --}}

    <div class="container" style="width:auto;">
        <div class="card card-custom" id="data_pertemuan">
            <div class="card-body">
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
                        <li class="nav-item mr-3">
                            <a href="{{ url('guru/jadwal/cek/materi/' . $kode) }}" class="btn nav-link @if($jenis == 'materi') active @endif">
                                <span class="nav-icon">
                                    <span class="svg-icon mr-3">
                                        <i class="fas fa-layer-group"></i>
                                    </span>
                                </span>
                                <span class="nav-text font-size-lg">Materi</span>
                            </a>
                        </li>
                        <li class="nav-item mr-3">
                            <a href="{{ url('guru/jadwal/cek/absensi/' . $kode) }}" class="btn nav-link @if($jenis == 'absensi') active @endif">
                                <span class="nav-icon">
                                    <span class="svg-icon mr-3">
                                        <i class="fas fa-layer-group"></i>
                                    </span>
                                </span>
                                <span class="nav-text font-size-lg">Absensi</span>
                            </a>
                        </li>
    
                        <li class="nav-item mr-3">
                            <a href="{{ url('guru/jadwal/cek/nilai/' . $kode) }}" class="btn nav-link @if($jenis == 'nilai') active @endif">
                                <span class="nav-icon">
                                    <span class="svg-icon mr-3">
                                        <i class="fas fa-layer-group"></i>
                                    </span>
                                </span>
                                <span class="nav-text font-size-lg">Nilai</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>












    
    
    @switch($jenisPertemuan)
        @case('materi')
            @include('partials.pertemuan.materi')
        @break

        @case('absensi')
            @include('partials.pertemuan.absensi')
        @break

        @case('nilai')
            @include('partials.pertemuan.nilai')
        @break

        @default
    @endswitch
@endsection
