@extends('layouts.main')

@section('main')
    <div class=" ">
        <div class="card card-custom">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    <h2 class="text-dark-75 text-center">Data Prestasi Siswa</h2>
                    <p class="text-dark-50 text-center">Silakan Masukkan Prestasi Siswa di bawah ini.</p>
                </div>
            </div>
        </div>

     
    </div>

    <div class="gutter-b">
        <div class="card card-custom">
            <div class="card-body">
                <div class="table-responsive">
                   <table class="table table-striped table-bordered" id="data_table">
                    <thead>
                        <tr>
                            <th colspan="5"><h5 class="text-center">Data Prestasi Siswa</h5></th>
                        </tr>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 45%;">Nama</th>
                            <th style="width: 20%;">NISN</th>
                            <th style="width: 20%;">Kelas</th>
                            <th style="width: 10%;">Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                  
                            @foreach ($siswa as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ $s->nisn }}</td>
                                    <td>{{ $s->kelas }} {{ $s->rombel }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <button type="button" class="btn btn-success btn-sm mr-1" data-toggle="modal" data-target="#prestasiModal{{ $s->id }}">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewModal{{ $s->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        

                    </tbody>
                </table> 
                  </div>
               
            </div>
        </div>
    </div>

 
        @foreach ($siswa as $s)
            <div class="modal fade" id="prestasiModal{{ $s->id }}">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Prestasi</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('/guru/prestasi-siswa') }}" class="form-horizontal" method="POST"
                            enctype="multipart/form-data" accept-charset="utf-8">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="id_siswa" value="{{ $s->id }}">
                                <div class="form-group">
                                    <label>Status Prestasi</label>
                                    <select class="form-control" name="status" required>
                                        <option value="">Pilih Status Prestasi</option>
                                        <option value="Akademik">Akademik</option>
                                        <option value="Non Akademik">Non Akademik</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama Prestasi</label>
                                    <input type="text" name="nama_prestasi" class="form-control"
                                        placeholder="Nama Prestasi" required />
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Perolehan</label>
                                    <input type="date" id="tanggalPerolehan" class="form-control" name="tanggal"
                                        placeholder="Tanggal Perolehan" required />
                                </div>
                                <div class="form-group">
                                    <label>Prediket</label>
                                    <select class="form-control" name="prediket" required>
                                        <option value="">Pilih Prediket</option>
                                        <option value="Juara 1">Juara 1</option>
                                        <option value="Juara 2">Juara 2</option>
                                        <option value="Juara 3">Juara 3</option>
                                        <option value="Tanpa Peringkat">Tanpa Peringkat</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Input Foto</label>
                                    <div class="custom-file">
                                        <input type="file" accept="image/*"
                                            onchange="showFileNameAndPreview(event, {{ $s->id }})"
                                            class="custom-file-input" id="exampleInputFile" name="foto" required>
                                        <label class="custom-file-label" for="exampleInputFile"
                                            id="file-label_{{ $s->id }}">Pilih File</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <img id="previewImage_{{ $s->id }}" src="#" alt="Preview"
                                        style="display: none; max-width: 200px; margin-top: 10px;">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <style>
                .modal-body {
                    line-height: 1.4;
                }

                .modal-body p {
                    margin-bottom: 5px;
                }
            </style>


            <div class="modal fade" id="viewModal{{ $s->id }}">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detail Prestasi Siswa</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @foreach ($prestasi as $p)
                                @if ($s->id == $p->id_siswa)
                                    <div class="row border border-1 ">
                                        <div class="col-md-4 text-center">

                                            <img src="{{ asset('storage/siswa/prestasi/' . $p->prestasi_foto) }}"
                                                class="img-fluid modal-photo" width="97%" style="padding: 3%">

                                        </div>
                                        <div class="col-md-8">
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <table style="margin: 0px;">
                                                        <tr>
                                                            <td style="padding: 5px;">Status Prestasi</td>
                                                            <td style="padding: 5px;">: Akademik</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px;">Nama Prestasi</td>
                                                            <td style="padding: 5px;">: {{ $p->prestasi }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px;">Waktu Peroleh</td>
                                                            <td style="padding: 5px;">: {{ $p->tanggal }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px;">Prediket</td>
                                                            <td style="padding: 5px;">: {{ $p->prediket }}</td>
                                                        </tr>
                                                    </table>
                                                    
                                                    
                                                    <form
                                                        action="{{ url('/guru/prestasi-siswa/' . $p->id_prestasi) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#deleteModal" style="margin: 1%">Delete</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    



    <script>
        function showFileNameAndPreview(event, id) {
            const input = event.target;
            const fileName = input.files[0].name;
            const fileLabel = document.getElementById('file-label_' + id);
            fileLabel.textContent = fileName;

            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImage = document.getElementById('previewImage_' + id);
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    </script>



    {{-- Status Prestasi --}}

    {{-- <script>
        function updateStatusPrestasi(button) {
            // Ambil elemen status prestasi
            var statusPrestasi = button.parentNode.nextElementSibling;

            // Ubah teks status prestasi
            statusPrestasi.innerText = "Menampilkan data prestasi";
        }
    </script> --}}

    {{-- Status Prestai --}}





    {{-- <script>
        function showPopup(row) {
            // Menampilkan pop-up
            document.getElementById("prestasiPopup").style.display = "block";

            // Menyimpan nomor baris siswa yang diklik
            document.getElementById("rowNumber").value = row;
        }

        function hidePopup() {
            // Menyembunyikan pop-up
            document.getElementById("prestasiPopup").style.display = "none";

            // Menghapus nilai inputan pada pop-up
            document.getElementById("namaKejuaraan").value = "";
            document.getElementById("predikat").value = "";
            document.getElementById("tanggalPerolehan").value = "";
            document.getElementById("gambar").value = "";
        }
    </script> --}}

    {{-- Tambah Prestasi --}}

    {{-- <script>
        // Mendapatkan referensi elemen-elemen yang diperlukan
        const form = document.getElementById('siswaForm');
        const table = document.getElementById('siswaTable');

        // Menambahkan event listener untuk peristiwa pengiriman formulir
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir dan pembaruan halaman

            // Mengubah properti tampilan tabel
            table.style.display = 'table';
        });
    </script> --}}
@endsection
