@extends('layouts.main')

@section('main')

            <div class="">
                <div class="card card-custo  gutter-b">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center">
                            <h2 class="text-dark-75 text-hover-success font-size-h1">Management Guru</h2>
                            <p class="text-dark-50 mt-2 text-center">Silahkan Atur Data Guru berupa Mengatur Bidang Studi Keahlian dan
                                Menambahkan Guru Baru</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="">
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <button id="tambah-guru-btn" class="btn btn-success" data-toggle='modal'
                            data-target="#tambahGuru">Tambah
                            guru</button>
                    </div>

                                <div id="tambahGuru" class="modal fade">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Formulir Tambah Guru</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ url('/tata-usaha/manajemen-guru') }}" method="POST" id="guru-form" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nama">Nama:</label>
                                                                <input type="text" class="form-control" id="nama" name="nama" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="nik">NIK:</label>
                                                                <input type="number" class="form-control" id="nik" name="nik" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="hp">Nomor HP:</label>
                                                                <input type="text" class="form-control" id="hp" name="nohp" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="tempat-lahir">Tempat Lahir:</label>
                                                                <input type="text" class="form-control" id="tempat-lahir" name="tempat_lahir" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="tanggal-lahir">Tanggal Lahir:</label>
                                                                <input type="date" class="form-control" id="tanggal-lahir" name="tanggal_lahir" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="nig">NIG:</label>
                                                                <input type="text" class="form-control" id="nig" name="nig" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="kelamin">Jenis Kelamin:</label>
                                                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                                                    <option value="" hidden>Pilih</option>
                                                                    <option value="Laki-laki">Laki-laki</option>
                                                                    <option value="Perempuan">Perempuan</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="agama">Agama:</label>
                                                                <select class="form-control" id="agama" name="agama" required>
                                                                    <option value="" hidden>Pilih</option>
                                                                    <option value="Islam">Islam</option>
                                                                    <option value="Kristen">Kristen</option>
                                                                    <option value="Katolik">Katolik</option>
                                                                    <option value="Hindu">Hindu</option>
                                                                    <option value="Budha">Budha</option>
                                                                    <option value="Konghucu">Konghucu</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputFile">Pilih Foto</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                        <input type="file" accept="image/*" onchange="showFileNameAndPreview(event)" class="custom-file-input" id="lihatfile" name="foto">
                                                                        <label class="custom-file-label" for="lihatfile" id="file-label">Pilih foto</label>
                                                                    </div>
                                                                </div>
                                                                <div id="preview-container" style="display: none;">
                                                                    <img id="lihatfoto" class="img-fluid mt-2" src="#" alt="Preview" width="50%">
                                                                </div>

                                                                <script>
                                                                    function showFileNameAndPreview(event) {
                                                                        var input = event.target;
                                                                        var fileName = input.files[0].name;
                                                                        document.getElementById("file-label").textContent = fileName;

                                                                        var previewContainer = document.getElementById("preview-container");
                                                                        var previewImage = document.getElementById("lihatfoto");
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
                                                                <label for="status-perkawinan">Status Perkawinan:</label>
                                                                <select class="form-control" id="status-perkawinan" name="status_perkawinan" required>
                                                                    <option value="" hidden>Pilih</option>
                                                                    <option value="Menikah">Menikah</option>
                                                                    <option value="Belum Menikah">Belum Menikah</option>
                                                                    <option value="Cerai">Cerai</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="status-kerja">Status Kerja:</label>
                                                                <select class="form-control" id="status-kerja" name="status" required>
                                                                    <option value="" hidden>Pilih</option>
                                                                    <option value="Tetap">Tetap</option>
                                                                    <option value="Kontrak">Kontrak</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="studi-keahlian">Studi keahlihan</label>
                                                                <input type="text" class="form-control" id="studi-keahlian" name="studi_keahlihan" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="kelurahan">Kelurahan:</label>
                                                                <input type="text" class="form-control" id="kelurahan" name="kelurahan" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="kecamatan">Kecamatan:</label>
                                                                <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="kabupatenKota">Kabupaten/Kota:</label>
                                                                <input type="text" class="form-control" id="kabupatenKota" name="kabupatenKota" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="provinsi">Provinsi:</label>
                                                                <input type="text" class="form-control" id="provinsi" name="provinsi" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="alamat">Alamat:</label>
                                                                <textarea class="form-control" id="alamat" rows="5" name="alamat" required></textarea>
                                                            </div>
                                                </div>
                                            </div>

                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                <div class=" table-responsive card card-custom  gutter-b">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="data_table" >
                            <thead>
                                <tr>
                                    <th colspan="8"><h5 class="text-center">Data Guru</h5></th>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Status Kerja</th>
                                    <th>Studi</th>
                                    <th>Kelamin</th>
                                    <th>HP</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guru as $g)
                                    <tr>
                                        <td>{{ $g->nama }}</td>
                                        <td>{{ $g->nik }}</td>
                                        <td>{{ $g->status }}</td>
                                        <td>{{ $g->studi_keahlihan }}</td>
                                        <td>{{ $g->jenis_kelamin }}</td>
                                        <td>{{ $g->nohp }}</td>
                                        <td>
                                            <div class="btn-sm" role="group" aria-label="Basic mixed styles example">
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#detailGuru{{ $g->id }}"> <i class="fas fa-eye"></i></button>
    
                                                <!--  view Modal -->
                                                <div class="modal fade" id="detailGuru{{ $g->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Detail Guru</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="text-center mb-3">
                                                                    <img src="{{ asset('storage/guru/images/'.$g->foto) }}" alt="Foto Profil"
                                                                        class="img-fluid" style="width: 200px;">

                                                            
                                                                        
                                                                </div>
                                                
                                                                <table class="table table-bordered">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>Nama:</th>
                                                                            <td>{{ $g->nama }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>NIK:</th>
                                                                            <td>{{ $g->nik }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Status Kerja:</th>
                                                                            <td>{{ $g->status }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Studi Keahlian :</th>
                                                                            <td>{{ $g->studi_keahlihan }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Jenis Kelamin :</th>
                                                                            <td>{{ $g->jenis_kelamin }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>NIG : </th>
                                                                            <td>{{ $g->nig }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Jenis Pegawai:</th>
                                                                            <td>{{ $g->jenis }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Nomor HP:</th>
                                                                            <td>{{ $g->nohp }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Tempat Lahir:</th>
                                                                            <td>{{ $g->tempat_lahir }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Tanggal Lahir:</th>
                                                                            <td>{{ $g->tanggal_lahir }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Agama:</th>
                                                                            <td>{{ $g->agama }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Status Perkawinan:</th>
                                                                            <td>{{ $g->status_perkawinan }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Kelurahan:</th>
                                                                            <td>{{ $g->kelurahan }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Kecamatan:</th>
                                                                            <td>{{ $g->kecamatan }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Kabupaten/Kota:</th>
                                                                            <td>{{ $g->kabupatenKota }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Provinsi:</th>
                                                                            <td>{{ $g->provinsi }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Alamat:</th>
                                                                            <td>{{ $g->alamat }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
    
                                    
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#editGuru{{ $g->id }}" style="color:white;"><i class="fas fa-edit"></i></button>
    
                                                {{-- edit modal --}}
                                                <div class="modal fade" id="editGuru{{ $g->id }}">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Formulir Edit guru</h5>
                                                                <button type="button" class="close" data-dismiss="modal">
                                                                    <span>&times;</span>
                                                                </button>
                                                            </div>
    
                                                            <div class="modal-body">
                                                                <form action="{{ url('/tata-usaha/manajemen-guru/' . $g->id) }}"
                                                                    method="POST" id="guru-form"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="nama">Nama:</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="nama" name="nama" required
                                                                                    value="{{ $g->nama }}">
                                                                            </div>
    
                                                                            <div class="form-group">
                                                                                <label for="nik">NIK:</label>
                                                                                <input type="number" class="form-control"
                                                                                    id="nik" name="nik" required
                                                                                    value="{{ $g->nik }}">
                                                                            </div>
    
                                                                            <div class="form-group">
                                                                                <label for="posisi">Jenis Guru:</label>
                                                                                <select class="form-control" id="jenis"
                                                                                    name="jenis" required disabled>
                                                                                    <option value="{{ $g->jenis }}"
                                                                                        hidden>
                                                                                        {{ $g->jenis }}</option>
                                                                                    <option value="Wali Kelas">Wali Kelas
                                                                                    </option>
                                                                                    <option value="Non Wali Kelas">Non Wali
                                                                                        Kelas</option>
                                                                                </select>
                                                                            </div>
    
                                                                            <div class="form-group">
                                                                                <label for="hp">Nomor HP:</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="hp" name="nohp" required
                                                                                    value="{{ $g->nohp }}">
                                                                            </div>
    
                                                                            <div class="form-group">
                                                                                <label for="tempat-lahir">Tempat Lahir:</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="tempat-lahir" name="tempat_lahir"
                                                                                    required value="{{ $g->tempat_lahir }}">
                                                                            </div>
    
                                                                            <div class="form-group">
                                                                                <label for="tanggal-lahir">Tanggal
                                                                                    Lahir:</label>
                                                                                <input type="date" class="form-control"
                                                                                    id="tanggal-lahir" name="tanggal_lahir"
                                                                                    required value="{{ $g->tanggal_lahir }}">
                                                                            </div>
    
                                                                            <div class="form-group">
                                                                                <label for="nig">NIG:</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="nig" name="nig" required
                                                                                    value="{{ $g->nig }}">
                                                                            </div>
    
                                                                            <div class="form-group">
                                                                                <label for="kelamin">Jenis Kelamin:</label>
                                                                                <select class="form-control"
                                                                                    id="jenis_kelamin" name="jenis_kelamin"
                                                                                    required>
                                                                                    <option value="{{ $g->jenis_kelamin }}"
                                                                                        hidden>
                                                                                        {{ $g->jenis_kelamin }}</option>
                                                                                    <option value="Laki-laki">Laki-laki
                                                                                    </option>
                                                                                    <option value="Perempuan">Perempuan
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="exampleInputFile">Input Foto</label>
                                                                                <div class="input-group">
                                                                                    <div class="custom-file">
                                                                                        <input type="file" accept="image/*"
                                                                                            onchange="showFileName(event,{{ $g->id }})"
                                                                                            class="custom-file-input" id="exampleInputFile"
                                                                                            name="foto">
                                                                                        <label class="custom-file-label"
                                                                                            for="exampleInputFile"
                                                                                            id="file-label_{{ $g->id }}">
    
                                                                                            {{ $g->foto }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div id="preview-container_{{ $g->id }}"
                                                                                    style="display: none;">
                                                                                    <img id="preview-image_{{ $g->id }}"
                                                                                        class="img-fluid" src="#" alt="Preview" width="50%">
                                                                                </div>
    
                                                                                <script>
                                                                                    function showFileName(event, id) {
                                                                                        var input = event.target;
                                                                                        var fileName = input.files[0].name;
                                                                                        document.getElementById("file-label_" + id).textContent = fileName;
    
                                                                                        var previewContainer = document.getElementById("preview-container_" + id);
                                                                                        var previewImage = document.getElementById("preview-image_" + id);
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
                                                                                <label for="agama">Agama:</label>
                                                                                <select class="form-control" id="agama"
                                                                                    name="agama" required>
                                                                                    <option value="{{ $g->agama }}"
                                                                                        hidden>
                                                                                        {{ $g->agama }}</option>
                                                                                    <option value="Islam">Islam</option>
                                                                                    <option value="Kristen">Kristen</option>
                                                                                    <option value="Katolik">Katolik</option>
                                                                                    <option value="Hindu">Hindu</option>
                                                                                    <option value="Budha">Budha</option>
                                                                                    <option value="Konghucu">Konghucu</option>
                                                                                </select>
                                                                            </div>
    
                                                                            <div class="form-group">
                                                                                <label for="status-perkawinan">Status
                                                                                    Perkawinan:</label>
                                                                                <select class="form-control"
                                                                                    id="status-perkawinan"
                                                                                    name="status_perkawinan" required>
                                                                                    <option
                                                                                        value="{{ $g->status_perkawinan }}"
                                                                                        hidden>
                                                                                        {{ $g->status_perkawinan }}</option>
                                                                                    <option value="Menikah">Menikah</option>
                                                                                    <option value="Belum Menikah">Belum Menikah
                                                                                    </option>
                                                                                    <option value="Cerai">Cerai</option>
                                                                                </select>
                                                                            </div>
    
                                                                            <div class="form-group">
                                                                                <label for="status-kerja">Status Kerja:</label>
                                                                                <select class="form-control" id="status-kerja"
                                                                                    name="status" required>
                                                                                    <option value="{{ $g->status }}"
                                                                                        hidden>
                                                                                        {{ $g->status }}</option>
                                                                                    <option value="Tetap">Tetap</option>
                                                                                    <option value="Kontrak">Kontrak</option>
                                                                                </select>
                                                                            </div>
    
                                                                            <div class="form-group">
                                                                                <label for="studi-keahlian">Studi
                                                                                    keahlihan</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="studi-keahlian" name="studi_keahlihan"
                                                                                    required
                                                                                    value="{{ $g->studi_keahlihan }}">
                                                                            </div>
    
                                                                            <div class="form-group">
                                                                                <label for="kelurahan">Kelurahan:</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="kelurahan" name="kelurahan" required
                                                                                    value="{{ $g->kelurahan }}">
                                                                            </div>
    
                                                                            <div class="form-group">
                                                                                <label for="kecamatan">Kecamatan:</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="kecamatan" name="kecamatan" required
                                                                                    value="{{ $g->kecamatan }}">
                                                                            </div>
    
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="kabupatenKota">Kabupaten/Kota:</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="kabupatenKota" name="kabupatenKota"
                                                                                    required value="{{ $g->kabupatenKota }}">
                                                                            </div>
    
                                                                            <div class="form-group">
                                                                                <label for="provinsi">Provinsi:</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="provinsi" name="provinsi" required
                                                                                    value="{{ $g->provinsi }}">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="alamat">Alamat:</label>
                                                                                <textarea class="form-control" id="alamat" rows="5" name="alamat" required>{{ $g->alamat }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="form-group">
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
    
                                                <!-- Tombol Hapus -->
                                                {{-- <form action="{{ url('/tata-usaha/manajemen-guru/' . $g->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE') --}}
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#deletePegawai{{ $g->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                {{-- </form> --}}
    
                                                {{-- Modal Hapus --}}
                                                <div class="modal fade" id="deletePegawai{{ $g->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="confirmDeleteModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="confirmDeleteModalLabel">
                                                                    Konfirmasi Hapus</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus Guru ini?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Batal</button>
                                                                <form action="{{ url('/tata-usaha/manajemen-guru/' . $g->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                  <button type="submit"
                                                                        class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
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
@endsection
