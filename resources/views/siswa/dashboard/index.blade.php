@extends('layouts.main')

@section('main')


<div class="custom-container">
    <div class="row align-items-center">
        <div class="card-body box-profile card-outline shadow mb-3"
            style="height: 80vh; margin-left:15px; background-color:white;">
            <div class="text-center">
                <img src="{{ asset('storage/siswa/images/' . $siswa->foto) }}" alt="Profil"
                    style="border-radius: 50%; " height="160px" width="160px">
            </div>

            <h3 class="profile-username text-center">{{ $siswa->nama }}</h3>
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Kelas :</b> <span class="float-right">{{ $siswa->kelas }} {{ $siswa->rombel }}</span>
                </li>
                <li class="list-group-item">
                    <b>Wali kelas :</b> <span class="float-right">{{ $siswa->nama_guru }}</span>
                </li>
                <li class="list-group-item">
                    <b>NISN :</b> <span class="float-right">{{ $siswa->nisn }}</span>
                </li>
                <li class="list-group-item">
                    <b>No Wali kelas :</b> <span class="float-right">{{ $siswa->nohp_guru }}</span>
                </li>
            </ul>
        </div>

        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success" style="height: 39vh;">
                        <div class="card-header">
                            <h3 class="card-title">Absen</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 offset-sm-3 text-center mt-3">
                                    <span style="font-size: 5rem; color: #28a745; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); display: inline-block; padding: 10px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.1);">70%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card card-warning" style="height: 39vh;">
                        <div class="card-header">
                            <h3 class="card-title">Terlambat</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 offset-sm-3 text-center mt-3">
                                    <span style="font-size: 5rem; color: #ffc107; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); display: inline-block; padding: 10px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.1);">45%</span>
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
                    <div class="card card-secondary" style="height: 39vh;">
                        <div class="card-header">
                            <h3 class="card-title">Izin</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 offset-sm-3 text-center mt-3">
                                    <span style="font-size: 5rem; color: #6c757d; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); display: inline-block; padding: 10px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.1);">90%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card card-danger" style="height: 39vh;">
                        <div class="card-header">
                            <h3 class="card-title">Tidak Absen</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 offset-sm-3 text-center mt-3">
                                    <span style="font-size: 5rem; color: #dc3545; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); display: inline-block; padding: 10px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.1);">25%</span>
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
