@extends('layouts.main')

@section('main')
    <div class="">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    <h2 class="text-dark-75 text-hover-success font-size-h1">Management Siswa Kelas {{ $kelas }}
                        {{ $rombel }}</h2>
                    <p class="text-dark-50 mt-2">Silahkan Atur Data Siswa berupa Mengatur Kelas Siswa</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .modal-header {
            background-color: #f8f9fa;
            border-bottom: none;
        }

        .modal-title {
            color: #343a40;
        }

        .modal-body {
            padding-top: 0;
        }

        .img-fluid {
            width: 150px;
            height: 150px;
        }

        .rounded-circle {
            border-radius: 50%;
        }

        #detailNama {
            font-size: 24px;
            font-weight: bold;
        }

        p {
            margin-bottom: 10px;
        }
    </style>


    <div class="card card-custom gutter-b">
        <div class="card-body">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahSiswaModal">Tambah
                Siswa</button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tambahSiswaModal" tabindex="-1" role="dialog" aria-labelledby="tambahSiswaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahSiswaModalLabel">Formulir Tambah siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <form action="{{ url('/guru/manajemen-siswa') }}" method="POST" id="siswa-form"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Data Siswa</h5>
                                    <div class="form-group">
                                        <label for="nama">Nama:</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="nisn">NISN:</label>
                                        <input type="number" class="form-control" id="nisn" name="nisn" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="kelas">Kelas:</label>
                                        <input type="text" class="form-control" disabled
                                            placeholder="Kelas {{ $kelas }} {{ $rombel }}">
                                        <input type="hidden" name="id_kelas" value="{{ $id_kelas }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="jenis-kelamin">Jenis Kelamin:</label>
                                        <select class="form-control" id="jenis-kelamin" name="jenis_kelamin" required>
                                            <option value="" hidden>pilih</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="agama">Agama:</label>
                                        <select class="form-control" id="agama" name="agama" required>
                                            <option value="" hidden>pilih</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="tempat-lahir">Tempat Lahir:</label>
                                        <input type="text" class="form-control" id="tempat-lahir" name="tempat_lahir"
                                            required>
                                    </div>


                                    <div class="form-group">
                                        <label for="tanggal-lahir">Tanggal Lahir:</label>
                                        <input type="date" class="form-control" id="tanggal-lahir" name="tanggal_lahir"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="kelurahan">Kelurahan:</label>
                                        <input type="text" class="form-control" id="kelurahan" name="kelurahan" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="kecamatan">Kecamatan:</label>
                                        <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="kabupaten-kota">Kabupaten/Kota:</label>
                                        <input type="text" class="form-control" id="kabupaten-kota"
                                            name="kabupaten_kota" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="provinsi">Provinsi:</label>
                                        <input type="text" class="form-control" id="provinsi" name="provinsi"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="alamat">Alamat:</label>
                                        <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="editFoto">Photo:</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" accept="image/*" onchange="showFileName1(event)"
                                                    class="custom-file-input" id="editFotoInput1" name="foto">
                                                <label class="custom-file-label" for="editFotoInput1"
                                                    id="editFotoLabel1"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="editPreviewContainer1" style="display: none;">
                                        <img id="editPreviewImage1" class="img-fluid" src="#" alt="Preview">
                                    </div>

                                    <script>
                                        function showFileName1(event) {
                                            var input = event.target;
                                            var fileName = input.files[0].name;
                                            document.getElementById("editFotoLabel1").textContent = fileName;

                                            var previewContainer = document.getElementById("editPreviewContainer1");
                                            var previewImage = document.getElementById("editPreviewImage1");
                                            if (input.files && input.files[0]) {
                                                var reader = new FileReader();

                                                reader.onload = function(e) {
                                                    previewImage.src = e.target.result;
                                                };

                                                previewContainer.style.display = "block";
                                                reader.readAsDataURL(input.files[0]);
                                            } else {
                                                previewContainer.style.display = "none";
                                            }
                                        }
                                    </script>

                                </div>

                                <div class="col-md-6">
                                    <h5>Data Orang Tua</h5>
                                    <div class="form-group">
                                        <label for="nik">NIK:</label>
                                        <input type="text" class="form-control" id="nik" name="nik"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_ortu">Nama Orang Tua:</label>
                                        <input type="text" class="form-control" id="nama_ortu" name="nama_ortu"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="hubungan">Hubungan:</label>
                                        <select class="form-control" id="hubungan" name="hubungan" required>
                                            <option value="" hidden>pilih</option>
                                            <option value="Orang Tua Kandung">Orang Tua Kandung</option>
                                            <option value="Orang Tua Angkat">Orang Tua Angkat</option>
                                            <option value="Saudara">Saudara</option>
                                            <option value="Keponakan">Keponakan</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="agama">Agama:</label>
                                        <select class="form-control" id="agama" name="agama_ortu" required>
                                            <option value="" hidden>pilih</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="jenis_kelamin_ortu">Jenis Kelamin Orang Tua:</label>
                                        <select class="form-control" id="jenis_kelamin_ortu" name="jenis_kelamin_ortu"
                                            required>
                                            <option value="" hidden>Pilih</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="no_hp_ortu">Nomor HP Orang Tua:</label>
                                        <input type="number" class="form-control" id="no_hp_ortu" name="no_hp_ortu"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="kelurahan_ortu">Kelurahan Orang Tua:</label>
                                        <input type="text" class="form-control" id="kelurahan_ortu"
                                            name="kelurahan_ortu" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="kecamatan_ortu">Kecamatan Orang Tua:</label>
                                        <input type="text" class="form-control" id="kecamatan_ortu"
                                            name="kecamatan_ortu" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="kabupaten_kota_ortu">Kabupaten/Kota Orang Tua:</label>
                                        <input type="text" class="form-control" id="kabupaten_kota_ortu"
                                            name="kabupaten_kota_ortu" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="provinsi_ortu">Provinsi Orang Tua:</label>
                                        <input type="text" class="form-control" id="provinsi_ortu"
                                            name="provinsi_ortu" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email_ortu">Email Orang Tua:</label>
                                        <input type="email" class="form-control" id="email_ortu" name="email_ortu">
                                    </div>

                                    <div class="form-group">
                                        <label for="pekerjaan_ortu">Pekerjaan Orang Tua:</label>
                                        <input type="text" class="form-control" id="pekerjaan_ortu"
                                            name="pekerjaan_ortu" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="alamat_ortu">Alamat Orang Tua:</label>
                                        <textarea class="form-control" id="alamat_ortu" name="alamat_ortu" required></textarea>
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Tambah</button>
                                <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.min.js"></script>

    <div class="">
        <div class="card card-custom gutter-b">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="data_table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    <h5 class="text-center">Tabel Data Siswa</h5>
                                </th>
                            </tr>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NISN</th>
                                <th>Kelas</th>
                                <th>Jenis Kelamin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="siswa-table-body">
                            <!-- Loop through the data and generate rows dynamically -->
                            @foreach ($siswa as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ $s->nisn }}</td>
                                    <td>{{ $s->kelas }} {{ $s->rombel }}</td>
                                    <td>{{ $s->jenis_kelamin }}</td>
                                    <td>
                                        <!-- Action buttons -->
                                        <button type="button" class="btn btn-success btn-sm view-button"
                                            data-toggle="modal" data-target="#detailModal_{{ $s->nisn }}"><i
                                                class="fas fa-eye"></i></button>


                                        <!-- Modal Detail Siswa -->
                                        <div id="detailModal_{{ $s->nisn }}" class="modal fade">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Siswa </h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <img src="{{ asset('storage/siswa/images/' . $s->foto) }}"
                                                                alt="Foto Profil" class="img-fluid">
                                                        </div>
                                                        <table class="table mt-4 table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Nama:</th>
                                                                    <td>{{ $s->nama }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>NISN:</th>
                                                                    <td>{{ $s->nisn }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Kelas:</th>
                                                                    <td>{{ $s->kelas }} {{ $s->rombel }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Jenis Kelamin:</th>
                                                                    <td>{{ $s->jenis_kelamin }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Agama:</th>
                                                                    <td>{{ $s->agama }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Tempat Lahir:</th>
                                                                    <td>{{ $s->tempat_lahir }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Kelurahan:</th>
                                                                    <td>{{ $s->kelurahan }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Kecamatan:</th>
                                                                    <td>{{ $s->kecamatan }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Provinsi:</th>
                                                                    <td>{{ $s->provinsi }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Alamat:</th>
                                                                    <td>{{ $s->alamat }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <button type="button" class="btn btn-warning btn-sm edit-button "
                                            data-toggle="modal" data-target="#editModal_{{ $s->nisn }}"> <i
                                                class="fas fa-edit" style="color: white"></i></button>

                                        <!-- Modal Input Siswa -->
                                        <div id="editModal_{{ $s->nisn }}" class="modal fade">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Siswa </h5>

                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('guru/manajemen-siswa/' . $s->id) }}"
                                                            method="POST" id="siswa-form" enctype="multipart/form-data">

                                                            @csrf
                                                            @method('PUT')


                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="nama">Nama:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="nama" name="nama" required
                                                                            value="{{ $s->nama }}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="nisn">NISN:</label>
                                                                        <input type="number" class="form-control"
                                                                            id="nisn" name="nisn" required
                                                                            value="{{ $s->nisn }}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="kelas">Kelas:</label>
                                                                        <select class="form-control" id="kelas"
                                                                            name="id_kelas" required>
                                                                            <option value="{{ $s->id_kelas }}" hidden>
                                                                                {{ $s->kelas }} {{ $s->rombel }}
                                                                            </option>
                                                                            @foreach ($getKelas as $k)
                                                                                <option value="{{ $k->id }}">
                                                                                    {{ $k->nama }}
                                                                                    {{ $k->rombel }}</option>
                                                                            @endforeach

                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="jenis-kelamin">Jenis Kelamin:</label>
                                                                        <select class="form-control" id="jenis-kelamin"
                                                                            name="jenis_kelamin" required>
                                                                            <option value="{{ $s->jenis_kelamin }}"hidden>
                                                                                {{ $s->jenis_kelamin }}</option>
                                                                            <option value="Laki-laki">Laki-laki</option>
                                                                            <option value="Perempuan">Perempuan</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="agama">Agama:</label>
                                                                        <select class="form-control" id="agama"
                                                                            name="agama" required>
                                                                            <option value="{{ $s->agama }}" hidden>
                                                                                {{ $s->agama }}</option>

                                                                            @php
                                                                                $options = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'];
                                                                            @endphp

                                                                            @foreach ($options as $option)
                                                                                @if ($option !== $s->agama)
                                                                                    <option value="{{ $option }}">
                                                                                        {{ $option }}</option>
                                                                                @endif
                                                                            @endforeach


                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="tempat-lahir">Tempat Lahir:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="tempat-lahir" name="tempat_lahir" required
                                                                            value="{{ $s->tempat_lahir }}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="exampleInputFile">Pilih Foto</label>
                                                                        <div class="input-group">
                                                                            <div class="custom-file">
                                                                                <input type="file" accept="image/*"
                                                                                    onchange="showFileNameAndPreview(event,{{ $s->nisn }})"
                                                                                    class="custom-file-input"
                                                                                    id="lihatfile" name="foto">
                                                                                <label class="custom-file-label"
                                                                                    for="lihatfile"
                                                                                    id="file-label_{{ $s->nisn }}">{{ substr($s->foto, strpos($s->foto, '-') + 1, strlen($s->foto) - strpos($s->foto, '-') + 1) }}</label>
                                                                            </div>
                                                                        </div>
                                                                        <div id="preview-container_{{ $s->nisn }}"
                                                                            style="display: none;">
                                                                            <img id="lihatfoto_{{ $s->nisn }}"
                                                                                class="img-fluid" src="#"
                                                                                alt="Preview">
                                                                        </div>

                                                                        <script>
                                                                            function showFileNameAndPreview(event, nisn) {
                                                                                var input = event.target;
                                                                                var fileName = input.files[0].name;
                                                                                document.getElementById("file-label_" + nisn).textContent = fileName;

                                                                                var previewContainer = document.getElementById("preview-container_" + nisn);
                                                                                var previewImage = document.getElementById("lihatfoto_" + nisn);
                                                                                if (input.files && input.files[0]) {
                                                                                    var reader = new FileReader();

                                                                                    reader.onload = function(e) {
                                                                                        previewImage.src = e.target.result;
                                                                                    };

                                                                                    previewContainer.style.display = "block";
                                                                                    reader.readAsDataURL(input.files[0]);
                                                                                } else {
                                                                                    previewContainer.style.display = "none";
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="tanggal-lahir">Tanggal Lahir:</label>
                                                                        <input type="date" class="form-control"
                                                                            id="tanggal-lahir" name="tanggal_lahir"
                                                                            required value="{{ $s->tanggal_lahir }}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="kelurahan">Kelurahan:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="kelurahan" name="kelurahan" required
                                                                            value="{{ $s->kelurahan }}">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="kecamatan">Kecamatan:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="kecamatan" name="kecamatan" required
                                                                            value="{{ $s->kecamatan }}">

                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="kabupaten-kota">Kabupaten/Kota:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="kabupaten-kota" name="kabupaten_kota"
                                                                            value="{{ $s->kabupatenKota }}" required>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="provinsi">Provinsi:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="provinsi" name="provinsi"
                                                                            value="{{ $s->provinsi }}" required>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="alamat">Alamat:</label>
                                                                        <textarea class="form-control" id="alamat" rows="5" name="alamat" required>{{ $s->alamat }}</textarea>
                                                                    </div>


                                                                    <img id="previewImage" src="#" alt="Preview"
                                                                        style="display: none; max-width: 200px; margin-top: 10px;">
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-success">Tambah</button>
                                                                <button type="button" class="btn btn-success"
                                                                    data-dismiss="modal">Batal</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
@endsection
