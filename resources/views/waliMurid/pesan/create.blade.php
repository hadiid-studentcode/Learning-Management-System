@extends("layouts.main")
@section("main")



<section class="container-custom content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ asset('/wali-murid/pesan') }}" class="btn btn-success btn-block mb-3">Kembali</a>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tujuan Penerima Pesan </h3>
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
                        </ul>
                    </div>

                </div>

            </div>
            <div class="col-md-9">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Tuliskan Pesan Baru</h3>
                    </div>
                    <form action="{{ asset('/wali-murid/pesan') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <input class="form-control" placeholder="Perihal:" name="perihal" type="text" required>
                                </div>
                            <div class="form-group">
                                <label for="recipient">To:</label>
                                <select class="form-control" id="recipient" onchange="showOptions()" name="penerima">
                                    <option value="" hidden>Pilih penerima</option>
                                    <option value="Guru">Guru</option>
                                    <option value="Tata Usaha">Tata Usaha (TU)</option>
                                </select>
                            </div>

                            <div class="form-group" id="guruOptions" style="display: none;">
                                <label for="guruSelect">Nama Guru:</label>
                                <select class="form-control" id="guruSelect" name="id_guru">
                                    <option value="" hidden>Pilih guru</option>
                                    @foreach ($guru as $g)
                                    <option value="{{ $g->id_user }}">{{ $g->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <script>
                                function showOptions() {
                                    var recipient = document.getElementById("recipient").value;
                                    var guruOptions = document.getElementById("guruOptions");
                                    var tuOptions = document.getElementById("tuOptions");

                                    // Setelah memilih penerima, tampilkan opsi yang sesuai
                                    if (recipient === "Guru") {
                                        guruOptions.style.display = "block";
                                        tuOptions.style.display = "none";
                                    } else if (recipient === "Tata Usaha") {
                                        guruOptions.style.display = "none";
                                        tuOptions.style.display = "block";
                                    } else {
                                        guruOptions.style.display = "none";
                                        tuOptions.style.display = "none";
                                    }
                                }

                                document.getElementById("Select").addEventListener("change", function() {
                                    var subject = document.getElementById("Select").value;
                                    var suSelect = document.querySelector(".SUSelect");

                                    // Set nilai input subject sesuai dengan pilihan subjek
                                    suSelect.value = subject;
                                });
                            </script>


                            <div class="form-group">
                                <textarea id="compose-textarea" class="form-control" style="height: 300px" name="isi_pesan" required></textarea>
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
