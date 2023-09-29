@extends('layouts.main')

@section('main')
    <div class="">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    <h2 class="text-dark-75 text-hover-success font-size-h1">Management pegawai</h2>
                    <p class="text-dark-50 mt-2 text-center">Silahkan Atur Data pegawai berupa Mengatur Bidang Studi Keahlian dan
                        Menambahkan pegawai Baru</p>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <button class="btn btn-success" data-toggle="modal" data-target="#tambahPegawai">Tambah pegawai</button>

                <div id="tambahPegawai" class="modal fade">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Formulir Tambah Pegawai</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form action="{{ url('/tata-usaha/manajemen-pegawai') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama">Nama:</label>
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <label for="nik">NIK:</label>
                                                <input type="number" class="form-control" id="nik" name="nik"
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <label for="Jenis">Jenis:</label>
                                                <select class="form-control" name="jenis" id="jenis"
                                                    onchange="toggleOtherInput()">
                                                    <option value="" hidden>Pilih Posisi</option>
                                                    <option value="Tata Usaha">Tata Usaha</option>
                                                    <option value="Pegawai">Pegawai</option>
                                                </select>
                                            </div>

                                            <div class="form-group" id="otherInputContainer" style="display: none;">
                                                <label for="OtherJenis">Masukan Posisi:</label>
                                                <input type="text" class="form-control" name="posisi"
                                                    id="other_jenis">
                                            </div>

                                            <script>
                                                function toggleOtherInput() {
                                                    const selectElement = document.getElementById("jenis");
                                                    const otherInputContainer = document.getElementById("otherInputContainer");
                                                    const otherInput = document.getElementById("other_jenis");

                                                    if (selectElement.value === "Pegawai") {
                                                        otherInputContainer.style.display = "block";
                                                        otherInput.setAttribute("required", "true");
                                                    } else {
                                                        otherInputContainer.style.display = "none";
                                                        otherInput.removeAttribute("required");
                                                    }
                                                }
                                            </script>


                                            <div class="form-group">
                                                <label for="hp">Nomor HP:</label>
                                                <input type="number" class="form-control" name="hp" id="hp"
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <label for="tempat-lahir">Tempat Lahir:</label>
                                                <input type="text" class="form-control" name="tempat_lahir"
                                                    id="tempat-lahir" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="tanggal-lahir">Tanggal Lahir:</label>
                                                <input type="date" class="form-control" name="tanggal_lahir"
                                                    id="tanggal-lahir" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="kelamin">Jenis Kelamin:</label>
                                                <select class="form-control" id="kelamin" name="jenis_kelamin" required>
                                                    <option value="" hidden>Pilih</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
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
                                                    <img id="lihatfoto" class="img-fluid" src="#" alt="Preview">
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
                                                <label for="status-perkawinan">Status Perkawinan:</label>
                                                <select class="form-control" id="status-perkawinan" name="status_perkawinan"
                                                    required>
                                                    <option value="" hidden>pilih</option>
                                                    <option value="Belum Menikah">Belum Menikah</option>
                                                    <option value="Menikah">Menikah</option>
                                                    <option value="Cerai">Cerai</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="kelurahan">Kelurahan:</label>
                                                <input type="text" class="form-control" id="kelurahan"
                                                    name="kelurahan" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="kecamatan">Kecamatan:</label>
                                                <input type="text" class="form-control" id="kecamatan"
                                                    name="kecamatan" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="kabupaten_kota">Kabupaten/Kota:</label>
                                                <input type="text" class="form-control" id="kabupaten_kota"
                                                    name="kabupaten_kota" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="provinsi">Provinsi:</label>
                                                <input type="textarea" class="form-control" id="provinsi"
                                                    name="provinsi" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat Lengkap</label>
                                                <textarea class="form-control" id="alamat" rows="5" name="alamat" placeholder="Alamat lengkap"></textarea>
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
        </div>


        <div class=" table-responsive card card-custom gutter-b">
            <div class="table-responsive">
                <table class="table table-bordered table-striped " id="data_table">
                    <thead>
                        <tr>
                            <th colspan="7"><h5 class="text-center">Tabel Data Pegawai</h5></th>
                        </tr>
                        <tr>
                            <th style="width: 2%">No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Jenis Kelamin</th>
                            <th>Jenis</th>
                            <th>Nomor HP</th>
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->nik }}</td>
                                <td>{{ $p->jenis_kelamin }}</td>
                                <td>{{ $p->jenis }}</td>
                                <td>{{ $p->no_hp }}</td>
                                <td>
                                    <div class="btn-sm" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                            data-target="#viewpegawai{{ $p->id }}"><i class="fa fa-eye"></i></button>
    
    
                                        {{-- modal view --}}
                                        <div id="viewpegawai{{ $p->id }}" class="modal fade">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Pegawai</h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <img src="{{ asset('storage/pegawai/images/' . $p->foto) }}"
                                                                alt="Foto Profil" class="img-fluid" style="width: 20%;">
                                                        </div>
    
                                                        <table class="table mt-4 table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Nama:</th>
                                                                    <td>{{ $p->nama }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>NIK:</th>
                                                                    <td>{{ $p->nik }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Jenis Kelamin:</th>
                                                                    <td>{{ $p->jenis_kelamin }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Jenis Pegawai:</th>
                                                                    <td>{{ $p->jenis }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Nomor HP:</th>
                                                                    <td>{{ $p->no_hp }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Tempat Lahir:</th>
                                                                    <td>{{ $p->tempat_lahir }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Tanggal Lahir:</th>
                                                                    <td>{{ $p->tanggal_lahir }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Agama:</th>
                                                                    <td>{{ $p->agama }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Status Perkawinan:</th>
                                                                    <td>{{ $p->status_perkawinan }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Kelurahan:</th>
                                                                    <td>{{ $p->kelurahan }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Kecamatan:</th>
                                                                    <td>{{ $p->kecamatan }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Kabupaten/Kota:</th>
                                                                    <td>{{ $p->kabupatenKota }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Provinsi:</th>
                                                                    <td>{{ $p->provinsi }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Alamat:</th>
                                                                    <td>{{ $p->alamat }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
                                        @if($p->jenis !== 'Ketua Tata Usaha')
    
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editpegawai{{ $p->id }}">
                                            <i class="fas fa-edit" style="color: white;"></i>
                                        </button>
                                        
    
                                        {{-- modal edit pegawai --}}
                                        <div id="editpegawai{{ $p->id }}" class="modal fade">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Pegawai</h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
    
                                                    {{-- modal edit pegawai --}}
                                                    <div class="modal-body">
                                                        <form action="{{ url('/tata-usaha/manajemen-pegawai/' . $p->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="nama">Nama:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="nama" name="nama" required
                                                                            value="{{ $p->nama }}">
                                                                    </div>
    
                                                                    <div class="form-group">
                                                                        <label for="nik">NIK:</label>
                                                                        <input type="number" class="form-control"
                                                                            id="nik" name="nik" required
                                                                            value="{{ $p->nik }}">
                                                                    </div>
    
                                                                    <div class="form-group">
                                                                        <label for="Jenis">Jenis:</label>
                                                                        <input type="text" class="form-control"
                                                                            name="jenis" id="jenis" disabled
                                                                            value="{{ $p->jenis }}">
    
                                                                    </div>
    
                                                                    <div class="form-group">
                                                                        <label for="hp">Nomor HP:</label>
                                                                        <input type="text" class="form-control"
                                                                            name="hp" id="hp" required
                                                                            value="{{ $p->no_hp }}">
                                                                    </div>
    
                                                                    <div class="form-group">
                                                                        <label for="tempat-lahir">Tempat Lahir:</label>
                                                                        <input type="text" class="form-control"
                                                                            name="tempat_lahir" id="tempat-lahir" required
                                                                            value="{{ $p->tempat_lahir }}">
                                                                    </div>
    
                                                                    <div class="form-group">
                                                                        <label for="tanggal-lahir">Tanggal
                                                                            Lahir:</label>
                                                                        <input type="date" class="form-control"
                                                                            name="tanggal_lahir" id="tanggal-lahir"
                                                                            value="{{ $p->tanggal_lahir }}" required>
                                                                    </div>
    
                                                                    <div class="form-group">
                                                                        <label for="kelamin">Jenis Kelamin:</label>
                                                                        <select class="form-control" id="kelamin"
                                                                            name="jenis_kelamin" required>
                                                                            <option value="{{ $p->jenis_kelamin }}" hidden>
                                                                                {{ $p->jenis_kelamin }}</option>
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
                                                                                    onchange="showFileName(event,{{ $p->id }})"
                                                                                    class="custom-file-input" id="exampleInputFile"
                                                                                    name="foto">
                                                                                <label class="custom-file-label"
                                                                                    for="exampleInputFile"
                                                                                    id="file-label_{{ $p->id }}">
    
                                                                                    {{ $p->foto }}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div id="preview-container_{{ $p->id }}"
                                                                            style="display: none;">
                                                                            <img id="preview-image_{{ $p->id }}"
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
                                                                            <option value="{{ $p->agama }}" hidden>
                                                                                {{ $p->agama }}</option>
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
                                                                        <select class="form-control" id="status-perkawinan"
                                                                            name="status_perkawinan" required>
                                                                            <option value="{{ $p->status_perkawinan }}"
                                                                                hidden>
                                                                                {{ $p->status_perkawinan }}</option>
                                                                            <option value="Belum Menikah">Belum Menikah
                                                                            </option>
                                                                            <option value="Menikah">Menikah</option>
                                                                            <option value="Cerai">Cerai</option>
                                                                        </select>
                                                                    </div>
    
                                                                    <div class="form-group">
                                                                        <label for="kelurahan">Kelurahan:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="kelurahan" name="kelurahan" required
                                                                            value="{{ $p->kelurahan }}">
                                                                    </div>
    
                                                                    <div class="form-group">
                                                                        <label for="kecamatan">Kecamatan:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="kecamatan" name="kecamatan" required
                                                                            value="{{ $p->kecamatan }}">
                                                                    </div>
    
                                                                    <div class="form-group">
                                                                        <label for="kabupaten_kota">Kabupaten/Kota:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="kabupaten_kota" name="kabupaten_kota" required
                                                                            value="{{ $p->kabupatenKota }}">
                                                                    </div>
    
                                                                    <div class="form-group">
                                                                        <label for="provinsi">Provinsi:</label>
                                                                        <input type="textarea" class="form-control"
                                                                            id="provinsi" name="provinsi" required
                                                                            value="{{ $p->provinsi }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="alamat">Alamat Lengkap</label>
                                                                        <textarea class="form-control" id="alamat" rows="5" name="alamat" placeholder="Alamat lengkap">{{ $p->alamat }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-success">Tambah</button>
                                                                <button type="button"
                                                                    class="btn btn-success"data-dismiss="modal">Batal</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#deletePegawai{{ $p->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    
    
    
                                        {{-- delete modal --}}
                                        <div class="modal fade" id="deletePegawai{{ $p->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmDeleteModalLabel">
                                                            Konfirmasi Hapus
                                                            Pegawai</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus pegawai ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Batal</button>
                                                        <form action="{{ url('/tata-usaha/manajemen-pegawai/' . $p->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
                                      
    
                                        @endif
    
    
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
