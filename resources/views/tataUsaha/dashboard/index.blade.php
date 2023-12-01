@extends('layouts.main')

@section('main')


<div class="">
    <div class="row align-items-center">
        <div class="card-body box-profile card-outline shadow mb-3"
            style="height: 108vh; margin-left:15px; background-color:white;">
            <div class="text-center">

                <img src="{{ asset('/storage/pegawai/images/' . $img) }} " alt="Profil"
                    class="rounded-circle" height="160px" width="170px">
            </div>


            <h3 class="profile-username text-center">{{ $tatauUsaha->nama }}</h3>
            <p class="text-muted text-center">{{ $tatauUsaha->jenis }}</p>
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>No hp :</b> <span class="float-right">{{ $tatauUsaha->no_hp }}</span>
                </li>
            </ul>


            @include('partials.dashboard.absensi')

        </div>

            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-success" style="height: 53vh;">
                            <div class="card-header">
                                <h3 class="card-title">Jumlah Siswa</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6 offset-sm-3 text-center mt-3">
                                        <span style="font-size: 8rem; color: #28a745; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); display: inline-block; padding: 10px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.1);">{{$jumlahSiswa}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card card-warning" style="height: 53vh;">
                            <div class="card-header">
                                <h3 class="card-title">Jumlah Pegawai</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6 offset-sm-3 text-center mt-3">
                                        <span style="font-size: 8rem; color: #ffc107; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); display: inline-block; padding: 10px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.1);">{{$jumlahPegawai}}</span>
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
                        <div class="card card-secondary" style="height: 53vh;">
                            <div class="card-header">
                                <h3 class="card-title">Jumlah Guru</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6 offset-sm-3 text-center mt-3">
                                        <span style="font-size: 8rem; color: #6c757d; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); display: inline-block; padding: 10px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.1);">{{$jumlahGuru}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card card-danger" style="height: 53vh;">
                            <div class="card-header">
                                <h3 class="card-title">Jumlah kelas</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6 offset-sm-3 text-center mt-3">
                                        <span style="font-size: 8rem; color: #dc3545; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); display: inline-block; padding: 10px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.1);">{{$jumlahKelas}}</span>
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
