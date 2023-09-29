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
                <!-- left column -->
                <div class="col-md-6">

                    <div class="card card-primary" style="height: ">
                        <div class="card-header">
                            <h3 class="card-title">Update Profile</h3>
                        </div>

                        <form id="pegawai" action="{{ asset('/pegawai/setting/' . $pegawai->id) }}" method="post"
                            enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" value="{{ $pegawai->nama }}"
                                        placeholder="Nama">
                                </div>

                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="form-control" id="nik" placeholder="NIK" value="1234567890" disabled>
                                  </div>

                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <select class="form-control" id="agama" name="agama">
                                        <option value="Islam" {{ $pegawai->agama === 'Islam' ? 'selected' : '' }}>Islam
                                        </option>
                                        <option value="Kristen" {{ $pegawai->agama === 'Kristen' ? 'selected' : '' }}>
                                            Kristen</option>
                                        <option value="Katolik" {{ $pegawai->agama === 'Katolik' ? 'selected' : '' }}>
                                            Katolik</option>
                                        <option value="Hindu" {{ $pegawai->agama === 'Hindu' ? 'selected' : '' }}>Hindu
                                        </option>
                                        <option value="Buddha" {{ $pegawai->agama === 'Buddha' ? 'selected' : '' }}>Buddha
                                        </option>
                                        <option value="Konghucu" {{ $pegawai->agama === 'Konghucu' ? 'selected' : '' }}>
                                            Konghucu</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="nohp">No Hp/Wa</label>
                                    <input type="text" class="form-control" id="nohp" name="nohp"
                                        placeholder="No Hp/Wa" value="{{ $pegawai->no_hp }}">
                                </div>

                                <div class="form-group">
                                    <label for="tempatlahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempatlahir" name="tempatlahir"
                                        placeholder="Tempat Lahir" value="{{ $pegawai->tempat_lahir }}">
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                        value="{{ $pegawai->tanggal_lahir }}">
                                </div>

                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">

                                        @switch($pegawai->jenis_kelamin)
                                            @case('Laki-laki')
                                                <option>Pilih Kelamin</option>
                                                <option selected value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            @break

                                            @case('Perempuan')
                                                <option>Pilih Kelamin</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option selected value="Perempuan">Perempuan</option>
                                            @break

                                            @default
                                                <option>Pilih Kelamin</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                        @endswitch

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="status_perkawinan">Status Perkawinan</label>
                                    <select class="form-control" id="status_perkawinan" name="status_perkawinan">

                                        @switch($pegawai->status_perkawinan)
                                            @case('Belum Menikah')
                                                <option>Pilih status</option>
                                                <option selected value="Belum Menikah">Belum Menikah</option>
                                                <option value="Menikah">Menikah</option>
                                                <option value="Cerai">Cerai</option>
                                            @break

                                            @case('Menikah')
                                                <option>Pilih status</option>
                                                <option value="Belum Menikah">Belum Menikah</option>
                                                <option selected value="Menikah">Menikah</option>
                                                <option value="Cerai">Cerai</option>
                                            @break

                                            @case('Cerai')
                                                <option>Pilih status</option>
                                                <option value="Belum Menikah">Belum Menikah</option>
                                                <option value="Menikah">Menikah</option>
                                                <option selected value="Cerai">Cerai</option>
                                            @break

                                            @default
                                                <option>Pilih status</option>
                                                <option value="Belum Menikah">Belum Menikah</option>
                                                <option value="menikah">Menikah</option>
                                                <option selected value="cerai">Cerai</option>
                                        @endswitch

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="kelurahan">Kelurahan</label>
                                    <input type="text" class="form-control" id="kelurahan" placeholder="Kelurahan"
                                        name="kelurahan" value="{{ $pegawai->kelurahan }}">
                                </div>

                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                        placeholder="Kecamatan" value="{{ $pegawai->kecamatan }}">
                                </div>

                                <div class="form-group">
                                    <label for="kabupaten">Kabupaten/Kota</label>
                                    <input type="text" class="form-control" id="kabupaten" name="kabupatenKota"
                                        placeholder="Kabupaten" value="{{ $pegawai->kabupatenKota }}">
                                </div>

                                <div class="form-group">
                                    <label for="provinsi">Provinsi</label>
                                    <input type="text" class="form-control" id="provinsi" name="provinsi"
                                        placeholder="Provinsi" value="{{ $pegawai->provinsi }}">
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat Lengkap</label>
                                    <textarea class="form-control" id="alamat" rows="5" name="alamat" placeholder="Alamat lengkap">{{ $pegawai->alamat }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Input Foto Profil</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" accept="image/*" onchange="showFileName(event)" class="custom-file-input" id="exampleInputFile" name="foto">
                                            <label class="custom-file-label" for="exampleInputFile" id="file-label">
                                                {{ $filename }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="preview-container" style="display: none;">
                                    <img id="preview-image" style="width: 300px" class="img-fluid" src="#" alt="Preview">
                                </div>

                                <script>
                                    function showFileName(event) {
                                        var input = event.target;
                                        var fileName = input.files[0].name;
                                        document.getElementById("file-label").textContent = fileName;

                                        var previewContainer = document.getElementById("preview-container");
                                        var previewImage = document.getElementById("preview-image");
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();

                                            reader.onload = function (e) {
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
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" onclick="resetForm()">Batal</button>
                            </div>

                            <script>
                                function resetForm() {
                                    // Hapus nilai input teks
                                    document.querySelectorAll('input[type="text"]').forEach(function(input) {
                                        input.value = '';
                                    });

                                    // Hapus nilai input tanggal
                                    document.querySelectorAll('input[type="date"]').forEach(function(input) {
                                        input.value = '';
                                    });

                                    // Atur pilihan default untuk elemen <select>
                                    document.querySelectorAll('select').forEach(function(select) {
                                        select.selectedIndex = 0;
                                    });

                                    // Hapus file yang dipilih dan atur kembali label file
                                    var fileInput = document.getElementById('exampleInputFile');
                                    fileInput.value = '';
                                    var fileLabel = document.getElementById('file-label');
                                    fileLabel.textContent = '{{ $filename }}';

                                    // Sembunyikan elemen priview gambar
                                    var previewContainer = document.getElementById('preview-container');
                                    previewContainer.style.display = 'none';
                                    var previewImage = document.getElementById('preview-image');
                                    previewImage.src = '#';
                                }
                            </script>

                        </form>
                    </div>

                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">
                    <!-- Form Element sizes -->
                    <form action="{{ asset('/pegawai/setting/' . $pegawai->nama . '/'.$pegawai->id) }}"
                        method="POST">
                        @csrf

                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Update Acount</h3>
                            </div>
                            <div class="card-body">
                                @if (session()->has('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if (session()->has('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email"
                                        name="email" value="{{ $emailUser }}">

                                </div>
                                <div class="form-group">
                                    <label for="text">Username</label>
                                    <input type="text" class="form-control" id="username" placeholder="Username" name="username"
                                        value="{{ $username }}" >
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    var togglePassword = document.getElementById("togglePassword");
                                    var toggleConfirmPassword = document.getElementById("toggleConfirmPassword");
                                    var passwordInput = document.getElementById("password");
                                    var confirmPasswordInput = document.getElementById("confirmPassword");

                                    togglePassword.addEventListener("click", function() {
                                        var type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
                                        passwordInput.setAttribute("type", type);
                                        this.classList.toggle("fa-eye");
                                        this.classList.toggle("fa-eye-slash");
                                    });

                                    toggleConfirmPassword.addEventListener("click", function() {
                                        var type = confirmPasswordInput.getAttribute("type") === "password" ? "text" : "password";
                                        confirmPasswordInput.setAttribute("type", type);
                                        this.classList.toggle("fa-eye");
                                        this.classList.toggle("fa-eye-slash");
                                    });
                                </script>


                                <div class="form-group">
                                    <input type="checkbox" id="passwordRequirementCheckbox" disabled>
                                    <label for="passwordRequirementCheckbox">Password memenuhi persyaratan</label>
                                </div>

                                <script>
                                    var passwordInput = document.getElementById("password");
                                    var confirmPasswordInput = document.getElementById("confirmPassword");
                                    var passwordRequirementCheckbox = document.getElementById("passwordRequirementCheckbox");

                                    function validatePassword() {
                                        var password = passwordInput.value;
                                        var confirmPassword = confirmPasswordInput.value;

                                        if (password.length < 8 || !/[A-Z]/.test(password)) {
                                            passwordInput.setCustomValidity("Password harus memiliki minimal 8 karakter dan setidaknya satu huruf besar.");
                                            passwordRequirementCheckbox.disabled = true;
                                            passwordRequirementCheckbox.checked = false;
                                        } else {
                                            passwordInput.setCustomValidity("");
                                            passwordRequirementCheckbox.disabled = false;
                                            passwordRequirementCheckbox.checked = true;
                                        }

                                        if (password !== confirmPassword) {
                                            confirmPasswordInput.setCustomValidity("Konfirmasi password tidak sesuai.");
                                        } else {
                                            confirmPasswordInput.setCustomValidity("");
                                        }
                                    }

                                    passwordInput.addEventListener("input", validatePassword);
                                    confirmPasswordInput.addEventListener("input", validatePassword);

                                    validatePassword();
                                </script>


                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </form>


                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
