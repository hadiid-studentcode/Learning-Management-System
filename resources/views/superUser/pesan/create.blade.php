@extends('layouts.main')

@section('main')
<style>
    .container-custom {
        width: 85%;
        margin: 0 auto;
    }
</style>

    <section class="content container-custom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ asset('/super-user/pesan') }}" class="btn btn-success btn-block mb-3">Kembali ke Inbox</a>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tujuan Penerima Pesan</h3>
                        </div>
                        <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">

                                <li class="nav-item">
                                    <a href="#" class="nav-link" style="cursor: default; pointer-events: none;">
                                        <i class="far fa-envelope"></i> Guru
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link" style="cursor: default; pointer-events: none;">
                                        <i class="far fa-envelope"></i> Tata Usaha
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link" style="cursor: default; pointer-events: none;">
                                        <i class="far fa-envelope"></i> Pegawai
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Tuliskan Pesan Baru</h3>
                        </div>
                        <form action="{{ asset('/super-user/pesan') }}" method="post">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <input class="form-control" placeholder="Perihal:" name="perihal" type="text">
                                </div>


                                <div class="form-group">
                                    <label for="recipient">Penerima:</label>
                                    <select class="form-control" id="recipient" onchange="showOptions()" name="penerima">
                                        <option value="" hidden>Pilih penerima</option>
                                        <option value="Guru">Guru</option>
                                        <option value="Tata Usaha">Tata Usaha</option>
                                        <option value="Pegawai">Pegawai</option>
                                    </select>
                                </div>

                                <div class="form-group" id="guruOptions" style="display: none;">
                                    <label for="guruSelect">Guru:</label>
                                    <select class="form-control" id="guruSelect" name="id_guru">
                                        <option value="" hidden>Pilih Guru</option>

                                        @foreach ($guru as $g)
                                            <option value="{{ $g->id_user }}">{{ $g->nama }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group" id="tuOptions" style="display: none;">
                                    <label for="tuSelect">Tata Usaha:</label>
                                    <select class="form-control" id="tuSelect" name="id_tu">
                                        <option value="" hidden>Pilih Tata Usaha</option>
                                        @foreach ($tataUsaha as $tu)
                                            <option value="{{ $tu->id_user }}">{{ $tu->nama }}</option>
                                        @endforeach


                                    </select>
                                </div>

                                <div class="form-group" id="pegawaiOptions" style="display: none;">
                                    <label for="pegawaiSelect">Pegawai:</label>
                                    <select class="form-control" id="pegawaiSelect" name="id_pegawai">
                                        <option value="" hidden>Pilih Pegawai</option>
                                          @foreach ($pegawai as $p)
                                            <option value="{{ $p->id_user }}">{{ $p->nama }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <script>
                                    function showOptions() {
                                        var recipient = document.getElementById("recipient").value;
                                        var guruOptions = document.getElementById("guruOptions");
                                        var tuOptions = document.getElementById("tuOptions");
                                        var pegawaiOptions = document.getElementById("pegawaiOptions");

                                        if (recipient === "Guru") {
                                            guruOptions.style.display = "block";
                                            tuOptions.style.display = "none";
                                            pegawaiOptions.style.display = "none";
                                        } else if (recipient === "Tata Usaha") {
                                            guruOptions.style.display = "none";
                                            tuOptions.style.display = "block";
                                            pegawaiOptions.style.display = "none";
                                        } else if (recipient === "Pegawai") {
                                            guruOptions.style.display = "none";
                                            tuOptions.style.display = "none";
                                            pegawaiOptions.style.display = "block";
                                        } else {
                                            guruOptions.style.display = "none";
                                            tuOptions.style.display = "none";
                                            pegawaiOptions.style.display = "none";
                                        }
                                    }
                                </script>
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
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
