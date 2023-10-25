@extends('layouts.main')

@section('main')

    <div class="custom-container">
        <div class="row align-items-center">
            <div class="card-body box-profile card-outline shadow mb-3"
                style="height: 108vh; margin-left:15px; background-color:white;">


                <div class="text-center">
                    <img src="{{ asset('storage/' . $folder . '/images/' . $img) }}" alt="Profil"
                        style="border-radius: 50%;  " height="160px" width="160px">
                </div>

                <h3 class="profile-username text-center">{{ $user }}</h3>
                <p class="text-muted text-center">{{ $jenis }}</p>

                <li class="list-group-item" style="border: none;">
                    <b>No HP : </b> <a class="float-right text-dark">{{ $nohp }}</a>
                </li>

                 @include('partials.dashboard.absensi')
            </div>
    
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-success" style="height: 53vh;">
                            <div class="card-header">
                                <h3 class="card-title">Absen</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6 offset-sm-3 text-center mt-3">
                                        <span style="font-size: 5rem; color: #28a745; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); display: inline-block; padding: 10px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.1);">{{ $jumlahAbsen['hadir'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-md-12">
                        <div class="card card-warning" style="height: 53vh;">
                            <div class="card-header">
                                <h3 class="card-title">Terlambat</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6 offset-sm-3 text-center mt-3">
                                        <span style="font-size: 5rem; color: #ffc107; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); display: inline-block; padding: 10px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.1);">{{ $jumlahAbsen['terlambat'] }}</span>
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
                                <h3 class="card-title">Izin</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6 offset-sm-3 text-center mt-3">
                                        <span style="font-size: 5rem; color: #6c757d; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); display: inline-block; padding: 10px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.1);">{{ $jumlahAbsen['izin'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-md-12">
                        <div class="card card-danger" style="height: 53vh;">
                            <div class="card-header">
                                <h3 class="card-title">Tidak Absen</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6 offset-sm-3 text-center mt-3">
                                        <span style="font-size: 5rem; color: #dc3545; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); display: inline-block; padding: 10px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.1);">{{ $jumlahAbsen['mangkir'] }}</span>
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
