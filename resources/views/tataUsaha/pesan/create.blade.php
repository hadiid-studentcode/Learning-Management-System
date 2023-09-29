@extends('layouts.main')

@section('main')

    <section class="content container-custom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ asset('/tata-usaha/pesan') }}" class="btn btn-success btn-block mb-3">Kembali ke Inbox</a>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tujuan Penerima Pesan</h3>
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
                <!-- /.col -->

                {{-- <div class="col-md-9">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Tuliskan Pesan Baru</h3>
                        </div>
                        <form action="{{ asset('/tata-usaha/pesan') }}" method="post">
                            @csrf
                
                            <div class="card-body">
                                <div class="form-group">
                                    <input class="form-control" placeholder="Perihal:" name="perihal" type="text">
                                </div>
                
                                <div class="form-group">
                                    <label for="recipient">Penerima:</label>
                                    <select class="form-control" id="recipient" onchange="showOptions()" name="penerima">
                                        <option value="" hidden>Pilih penerima</option>
                                        <option value="Kepala Sekolah">Kepala Sekolah (Kepsek)</option>
                                        <option value="Guru">Guru</option>
                                        <option value="pegawai">Pegawai</option>
                                        <option value="Wali Murid">Wali Murid</option>
                                    </select>
                                </div>
                
                                <div class="form-group" id="waliMuridOptions" style="display: none;">
                                    <label for="waliMuridSelect">Wali Murid:</label>
                                    <div class="input-group">
                                        <select class="form-control" id="waliMuridSelect" name="id_walimurid" onchange="selectWaliMurid()">
                                            @foreach ($waliMurid as $w)
                                            <option value="{{ $w->id_user }}">{{ $w->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                
                                <div class="form-group" id="guruOptions" style="display: none;">
                                    <label for="guruSelect">Guru:</label>
                                    <select class="form-control" id="guruSelect" name="id_guru">
                                        @foreach ($guru as $g)
                                            <option value="{{ $g->id_user }}">{{ $g->nama }}</option>
                                        @endforeach

                                    </select>
                                </div>
                
                                <div class="form-group" id="pegawaiOptions" style="display: none;">
                                    <label for="pegawaiSelect">Pegawai:</label>
                                    <select class="form-control" id="pegawaiSelect" name="id_pegawai">
                                            <option value="pegawai1">Pegawai 1</option>
                                            <option value="pegawai2"> Pegawai 2</option>
                                            <option value="pegawai3"> Pegawai 3</option>
                                            <option value="pegawai4"> Pegawai 4</option>
                                    </select>
                                </div>
                
                                <div class="form-group">
                                    <textarea id="compose-textarea" class="form-control" style="height: 300px" name="isi_pesan"></textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-success"><i class="far fa-envelope"></i> Kirim</button>
                                    <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Batal</button>
                                </div>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                
                <script>
                    function showOptions() {
                        var recipient = document.getElementById("recipient").value;
                        var waliMuridOptions = document.getElementById("waliMuridOptions");
                        var guruOptions = document.getElementById("guruOptions");
                        var pegawaiOptions = document.getElementById("pegawaiOptions");

                        if (recipient === "Wali Murid") {
                            waliMuridOptions.style.display = "block";
                            guruOptions.style.display = "none";
                            pegawaiOptions.style.display = "none";
                        } else if (recipient === "Guru") {
                            waliMuridOptions.style.display = "none";
                            guruOptions.style.display = "block";
                            pegawaiOptions.style.display = "none";
                        } else if (recipient === "Pegawai") {
                            waliMuridOptions.style.display = "none";
                            guruOptions.style.display = "none";
                            pegawaiOptions.style.display = "block";
                        } else {
                            waliMuridOptions.style.display = "none";
                            guruOptions.style.display = "none";
                            pegawaiOptions.style.display = "none";
                        }
                    }
                </script> --}}


                <div class="col-md-9">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Tuliskan Pesan Baru</h3>
                        </div>
                        <form action="{{ asset('/tata-usaha/pesan') }}" method="post">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <input class="form-control" placeholder="Perihal:" name="perihal" type="text">
                                </div>

                                <div class="form-group">
                                    <label for="recipient">Penerima:</label>
                                    <select class="form-control" id="recipient" onchange="showOptions()" name="penerima">
                                        <option value="" hidden>Pilih penerima</option>
                                        <option value="Kepala Sekolah">Kepala Sekolah (Kepsek)</option>
                                        <option value="Guru">Guru</option>
                                        <option value="Pegawai">Pegawai</option>
                                        <option value="Wali Murid">Wali Murid</option>
                                    </select>
                                </div>

                                <div class="form-group" id="waliMuridOptions" style="display: none;">
                                    <label for="waliMuridSelect">Wali Murid:</label>
                                    <div class="input-group">
                                        <select class="form-control" id="waliMuridSelect" name="id_walimurid"
                                            onchange="selectWaliMurid()">
                                            @foreach ($waliMurid as $w)
                                                <option value="{{ $w->id_user }}">{{ $w->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" id="guruOptions" style="display: none;">
                                    <label for="guruSelect">Guru:</label>
                                    <select class="form-control" id="guruSelect" name="id_guru">
                                        @foreach ($guru as $g)
                                            <option value="{{ $g->id_user }}">{{ $g->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group" id="pegawaiOptions" style="display: none;">
                                    <label for="pegawaiSelect">Pegawai:</label>
                                    <select class="form-control" id="pegawaiSelect" name="id_pegawai">
                                        <option value="" hidden>Pilih pegawai</option>
                                        @foreach ($pegawai as $p)
                                            <option value="{{ $p->id_user }}">{{ $p->nama }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <textarea id="compose-textarea" class="form-control" style="height: 300px" name="isi_pesan"></textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-success"><i class="far fa-envelope"></i>
                                        Kirim</button>
                                    <button type="reset" class="btn btn-default"><i class="fas fa-times"></i>
                                        Batal</button>
                                </div>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>

                <script>
                    function showOptions() {
                        var recipient = document.getElementById("recipient").value;
                        var waliMuridOptions = document.getElementById("waliMuridOptions");
                        var guruOptions = document.getElementById("guruOptions");
                        var pegawaiOptions = document.getElementById("pegawaiOptions");

                        if (recipient === "Wali Murid") {
                            waliMuridOptions.style.display = "block";
                            guruOptions.style.display = "none";
                            pegawaiOptions.style.display = "none";
                        } else if (recipient === "Guru") {
                            waliMuridOptions.style.display = "none";
                            guruOptions.style.display = "block";
                            pegawaiOptions.style.display = "none";
                        } else if (recipient === "Pegawai") {
                            waliMuridOptions.style.display = "none";
                            guruOptions.style.display = "none";
                            pegawaiOptions.style.display = "block"; // Menampilkan opsi pegawai
                        } else {
                            waliMuridOptions.style.display = "none";
                            guruOptions.style.display = "none";
                            pegawaiOptions.style.display = "none";
                        }
                    }
                </script>



                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
