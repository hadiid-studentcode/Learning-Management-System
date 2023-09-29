@extends('layouts.main')

@section('main')

    <section class="content container-custom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ asset('/guru/pesan') }}" class="btn btn-success btn-block mb-3">Kembali ke Inbox</a>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pengirim Pesan</h3>
                        </div>
                        <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">

                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-envelope"></i> Kepala Sekolah
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-envelope"></i> Wali Murid
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-envelope"></i> Tata Usaha
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- /.card -->
                </div>
                <!-- /.col -->
                @include('partials.pesan.show')
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
