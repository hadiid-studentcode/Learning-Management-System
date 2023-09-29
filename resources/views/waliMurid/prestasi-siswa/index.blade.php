@extends('layouts.main')

@section('main')
    <div class="row-fluid">
        <div style="position: relative;" class="widget span12">
            <div class="widget-body">
                <div class="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="widget">
                                <div class="">
                          
                                            <div class="widget-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="4" class="text-center bg-success text-white">
                                                                    <h5>Data Siswa</h5>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th>Nama</th>
                                                                <td colspan="3">{{ $siswa->nama }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>NISN</th>
                                                                <td>{{ $siswa->nisn }}</td>
                                                                <th>Wali Kelas</th>
                                                                <td>{{ $siswa->guru }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Kelas</th>
                                                                <td>{{ $siswa->kelas }}</td>
                                                                <th>Rombel</th>
                                                                <td>{{ $siswa->rombel }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                   
                                </div>
                                

                                  <div class="">
                                    <div class="card card-custom gutter-b">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <table id="data_table" class="table table-nomargin table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="6">
                                                                   <h5 class="text-center">Prestasi Siswa</h5>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th style="width: 5%">Nomor</th>
                                                                <th>Nama Prestasi</th>
                                                                <th>Waktu Perolehan</th>
                                                                <th>Prediket</th>
                                                                <th>Tahun Ajaran</th>
                                                                <th style="width: 15%; text-align:center;">Foto</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($prestasi as $p)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $p->nama_prestasi }}</td>
                                                                    <td>{{ $tanggal }}</td>
                                                                    <td>{{ $p->prediket }}</td>
                                                                    <td>{{ $p->tahun_ajaran }}</td>
                                                                    <td style="text-align: center;">
                                                                        <div>
                                                                            <button type="button" class="btn btn-success"
                                                                                data-toggle="modal"
                                                                                data-target="#buktiModal_{{ $p->id }}">
                                                                                <i class="fas fa-eye"></i></a> 
                                                                            </button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <div class="modal fade" id="buktiModal_{{ $p->id }}"
                                                                    tabindex="-1" role="dialog" aria-labelledby="buktiModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="buktiModalLabel">
                                                                                    Prestasi Siswa
                                                                                </h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-12 text-center">
                                                                                        <a href="{{ asset('storage/siswa/prestasi/' . $p->foto) }}"
                                                                                            target="_blank">
                                                                                            <img src="{{ asset('storage/siswa/prestasi/' . $p->foto) }}"
                                                                                                class="img-fluid modal-photo">
                                                                                        </a>
                                                                                    </div>
        
                                                                                </div>
                                                                              
                                                                            </div>

                                                                            
                                                                            <div class="modal-footer">
                                                                                <a href="{{ asset('storage/siswa/prestasi/' . $p->foto) }}" class="btn btn-success"
                                                                                    download>Download</a>
                                                                                <button type="button" class="btn btn-secondary"
                                                                                    data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
        
        
                                                        </tbody>
                                                    </table>
        
        
        
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                  </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        </div>
    </div>
    </div>
@endsection
