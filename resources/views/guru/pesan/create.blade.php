@extends('layouts.main')

@section('main')

    <section class="content container-custom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ asset('/guru/pesan') }}" class="btn btn-success btn-block mb-3">Back to Inbox</a>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tujuan Penerima</h3>
                        </div>
                        <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">

                                <li class="nav-item">
                                    <a href="#" class="nav-link" style="cursor: default; pointer-events: none;" >
                                        <i class="far fa-envelope"></i> Kepala Sekolah
                                    </a>
                                </li>
                                
                                <li class="nav-item">
                                    <a href="#" class="nav-link" style="cursor: default; pointer-events: none;">
                                        <i class="far fa-envelope"></i> Tata Usaha
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
                <div class="col-md-9">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Tuliskan Pesan Baru</h3>
                        </div>
                        <form action="{{ asset('/guru/pesan') }}" method="post">
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
                                        <option value="Tata Usaha">Tata Usaha (TU)</option>
                                        <option value="Wali Murid">Wali murid</option>
                                    </select>
                                </div>

                                <div class="form-group" id="waliMuridOptions" style="display: none;">
                                    <label for="waliMuridSelect">Wali Murid:</label>
                                    <select class="form-control" id="waliMuridSelect" name="id_walimurid">
                                        <option value="">Pilih wali murid</option>

                                        @foreach ($waliMurid as $w)
                                            <option value="{{ $w->id_user }}">{{ $w->nama }}</option>
                                        @endforeach


                                        <!-- Tambahkan opsi wali murid lainnya di sini -->
                                    </select>
                                </div>

                                <div class="form-group" id="tuOptions" style="display: none;">
                                    <label for="tuSelect">Tata Usaha:</label>
                                    <select class="form-control" id="tuSelect" name="id_tu">
                                        <option value="">Pilih Tata Usaha</option>
                                           @foreach ($tatausaha as $tu)
                                            <option value="{{ $tu->id_user }}">{{ $tu->nama }}</option>
                                        @endforeach

                                        <!-- Tambahkan opsi Tata Usaha lainnya di sini -->
                                    </select>
                                </div>

                                <script>
                                    function showOptions() {
                                        var recipient = document.getElementById("recipient").value;
                                        var waliMuridOptions = document.getElementById("waliMuridOptions");
                                        var tuOptions = document.getElementById("tuOptions");

                                        // Setelah memilih penerima, tampilkan opsi yang sesuai
                                        if (recipient === "Wali Murid") {
                                            waliMuridOptions.style.display = "block";
                                            tuOptions.style.display = "none";
                                        } else if (recipient === "Tata Usaha") {
                                            waliMuridOptions.style.display = "none";
                                            tuOptions.style.display = "block";
                                        } else {
                                            waliMuridOptions.style.display = "none";
                                            tuOptions.style.display = "none";
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
