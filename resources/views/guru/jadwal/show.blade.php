@extends('layouts.main')

@section('main')
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="d-flex mr-3">
                    <h2 href="#" class="text-dark-75 text-hover-primary font-size-h1 mr-3">{{ $mapel->nama }} | {{ $mapel->hari }}
                    </h2>
                </div>
                <hr>

                <table style="width:100%;">
                    <tbody>
                        <tr>
                            <td style="width: 20%">Kelas</td>
                            <td style="width: 80%">: <b>{{ $mapel->kelas }} {{ $mapel->rombel }}</b></td>
                        </tr>
                        <tr>
                            <td>Kode Mapel</td>
                            <td>: <b> {{ $mapel->kode }} </b></td>
                        </tr>
                        <tr>
                            <td>Hari, Jam Mulai s/d Selesai</td>
                            <td>: <b> {{ substr($mapel->waktu_mulai, 0, 5) }} WIB s/d {{ substr($mapel->waktu_selesai, 0, 5) }} WIB</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-body">

                <table class="table table-borderless table-vertical-center">
                    <tbody>
                        @foreach ($pertemuan as $p)
                            <tr>
                                <td class="pl-0">
                                    <h5 style="color: rgba(20, 103, 236, 0.884)"
                                        class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                        <a href="{{ asset('/guru/jadwal/cek/materi/' . $mapel->kode . '-'.$p->id) }}">MINGGU KE- {{ $loop->iteration }}</a>
                                        
                                    </h5>
                                    <div>
                                        <span class="font-weight-bolder">Materi : </span>
                                        <a class="text-muted font-weight-bold text-hover-primary"
                                            style="color: #F00 !important;">

                                            {{ $p->nama_materi }}

                                        </a>
                                    </div>
                                    <div>
                                        <span class="font-weight-bolder">Tanggal Pertemuan :</span>
                                        <a class="text-muted font-weight-bold text-hover-primary"
                                            style="color: #F00 !important;">
                                            {{ $p->tanggal_materi }}



                                            <!-- Replace this with the correct date variable from $p -->
                                        </a>
                                    </div>
                                </td>
                                <td class="text-right pr-0">
                                    <a href="{{ asset('/guru/jadwal/cek/materi/' . $mapel->kode . '-'.$p->id) }}"
                                        class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                            <i class="fas fa-pen"></i>
                                        </span>
                                    </a>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-xl-14">
            <a href="{{ url('/guru/kelas') }}">
                <button type="button" class="btn btn-primary btn-lg btn-block">Kembali</button>
            </a>
            <br>
        </div>
    </div>
@endsection
