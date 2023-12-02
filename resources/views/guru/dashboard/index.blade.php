@extends('layouts.main')

@section('main')

<div class="custom-container">
    <div class="row align-items-center">
        <div class="card-body box-profile card-outline shadow mb-3"
            style="height: 108vh; margin-left:15px; background-color:white;">
            <div class="text-center">
                <img src="{{ asset('/storage/guru/images/' . $img) }}" alt="Profil"
                    style="border-radius: 50%; " height="160px" width="160px">
            </div>


            <h3 class="profile-username text-center">{{ $guru->nama }}</h3>
            <h5 class="text-muted text-center">Guru {{ $guru->bidang_studi }}</h5>
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Wali kelas :</b> <span class="float-right">
                        @if ($wali_kelas)
                            {{ $wali_kelas->kelas }} {{ $wali_kelas->rombel }}
                        @else
                            -
                        @endif
                    </span>
                </li>
                <li class="list-group-item">
                    <b>No hp :</b> <span class="float-right">{{ $guru->nohp }}</span>
                </li>
            </ul>

             @include('partials.dashboard.absensi')
        </div>

        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success" style="height: 52vh;">
                        <div class="card-header">
                            <h3 class="card-title">Jumlah Hadir</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 offset-sm-3 text-center mt-3">
                                    <span style="font-size: 8rem; margin-top:1rem; color: #28a745; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); display: inline-block; padding: 10px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.1);">{{ $jumlahAbsen['hadir'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card card-warning" style="height: 52vh;">
                        <div class="card-header">
                            <h3 class="card-title">Jumlah Terlambat</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 offset-sm-3 text-center mt-3">
                                    <span style="font-size: 8rem; margin-top:1rem; color: #ffc107; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); display: inline-block; padding: 10px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.1);">{{ $jumlahAbsen['terlambat'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="row">
                
              <div class="col-md-12">
                    <div class="card card-secondary" style="height: 52vh;">
                        <div class="card-header">
                            <h3 class="card-title">Jumlah Izin</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 offset-sm-3 text-center mt-3">
                                    <span style="font-size: 8rem; margin-top:1rem; color: #6c757d; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); display: inline-block; padding: 10px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.1);">{{ $jumlahAbsen['izin'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card card-danger" style="height: 52vh;">
                        <div class="card-header">
                            <h3 class="card-title">Jumlah Tidak Hadir</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 offset-sm-3 text-center mt-3">
                                    <span style="font-size: 8rem; margin-top:1rem; color: #dc3545; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); display: inline-block; padding: 10px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.1);">{{ $jumlahAbsen['mangkir'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>





@endsection
