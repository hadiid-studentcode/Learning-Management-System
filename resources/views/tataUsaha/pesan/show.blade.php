@extends('layouts.main')

@section('main')
<style>
    .container-custom{
        width: 85%;
        margin: 0 auto;
    }
  </style>

<section class="content container-custom">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <a href="{{ asset('/tata-usaha/pesan') }}" class="btn btn-success btn-block mb-3">Kembali ke Inbox</a>


          <!-- /.card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pengirim Pesan</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link" style="cursor: default; pointer-events: none;">
                                <i class="far fa-envelope"></i> Kepala Sekolah
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" style="cursor: default; pointer-events: none;">
                                <i class="far fa-envelope"></i> Guru
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" style="cursor: default; pointer-events: none;">
                                <i class="far fa-envelope"></i> Pegawai
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" style="cursor: default; pointer-events: none;">
                                <i class="far fa-envelope"></i> Wali Murid
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>


      @include('partials.pesan.show')


      <!-- /.col -->
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>

@endsection
