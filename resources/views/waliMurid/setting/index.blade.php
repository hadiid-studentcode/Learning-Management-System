@extends('layouts.main')

@section('main')

    <section class="container-custom content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary" style="height: ">
                        <div class="card-header">
                            <h3 class="card-title">Update Profile Siswa</h3>
                        </div>


                        <form action="{{ asset('wali-murid/setting/' . $siswa->nisn . '/update') }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" placeholder="Nama"
                                        value="{{ $siswa->nama }}" name="nama">
                                </div>

                                <div class="form-group">
                                    <label for="nip">NISN</label>
                                    <input type="text" class="form-control" id="nisn" placeholder="NISN"
                                        value="{{ $siswa->nisn }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="tempatlahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempatlahir" name="tempat_lahir"
                                        placeholder="Tempat Lahir" value="{{ $siswa->tempat_lahir }}">
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                        value="{{ $siswa->tanggal_lahir }}">
                                </div>

                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">

                                        <option selected value="{{ $siswa->jenis_kelamin }}">{{ $siswa->jenis_kelamin }}
                                        </option>

                                        @php
                                            $options = ['Laki-laki', 'Perempuan'];
                                        @endphp

                                        @foreach ($options as $option)
                                            @if ($option !== $siswa->jenis_kelamin)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endif
                                        @endforeach


                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="jenis_agama">Agama</label>

                                    <select class="form-control" id="jenis_agama" name="agama">
                                        <option selected value="{{ $siswa->agama }}">{{ $siswa->agama }}
                                        </option>
                                        @php
                                            $options = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
                                        @endphp
                                        @foreach ($options as $option)
                                            @if ($option !== $siswa->agama)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="kelurahan">Kelurahan</label>
                                    <input type="text" class="form-control" id="kelurahan" placeholder="Kelurahan"
                                        name="kelurahan" value="{{ $siswa->kelurahan }}">
                                </div>

                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" class="form-control" id="kecamatan" placeholder="Kecamatan"
                                        name="kecamatan" value="{{ $siswa->kecamatan }}">
                                </div>

                                <div class="form-group">
                                    <label for="kabupaten">Kabupaten/Kota</label>
                                    <input type="text" class="form-control" id="kabupaten" placeholder="Kabupaten/Kota"
                                        name="kabupatenKota" value="{{ $siswa->kabupatenKota }}">
                                </div>

                                <div class="form-group">
                                    <label for="provinsi">Provinsi</label>
                                    <input type="text" class="form-control" id="provinsi" placeholder="Provinsi"
                                        name="provinsi" value="{{ $siswa->provinsi }}">
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat Lengkap</label>
                                    <textarea class="form-control" id="alamat" rows="5" name="alamat" placeholder="Alamat lengkap">{{ $siswa->alamat }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Input Foto Profil</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" accept="image/*" onchange="showFileName(event)"
                                                class="custom-file-input" id="exampleInputFile" name="foto">
                                            <label class="custom-file-label" for="exampleInputFile"
                                                id="file-label">{{ $siswa->foto }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div id="preview-container" style="display: none;">
                                    <img id="preview-image" style="width: 300px" class="img-fluid" src="#"
                                        alt="Preview">
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


                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" onclick="resetForm()">Batal</button>
                            </div>

                            <script>
                                function resetForm() {

                                    var input = document.getElementById("exampleInputFile");
                                    input.value = null;
                                    document.getElementById("file-label").textContent = "{{ $siswa->foto }}";

                                    var previewContainer = document.getElementById("preview-container");
                                    var previewImage = document.getElementById("preview-image");
                                    previewContainer.style.display = "none";
                                    previewImage.src = "#";
                                }
                            </script>

                        </form>
                    </div>

                </div>

                <div class="col-md-6">
                    <form action="{{ asset('/wali-murid/setting') }}" method="post">
                        @csrf

                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Informasi orang tua/wali</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap"
                                        name="nama" value="{{ $waliMurid->nama }}">
                                </div>

                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="form-control" id="nik" placeholder="NIK"
                                        value="{{ $waliMurid->nik }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="jenis_agama">Agama</label>

                                    <select class="form-control" id="jenis_agamaOrtu" name="agama">
                                        <option value="{{ $waliMurid->agama }}" hidden>{{ $waliMurid->agama }}</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">



                                        <option selected value="{{ $waliMurid->jenis_kelamin }}">
                                            {{ $waliMurid->jenis_kelamin }}
                                        </option>

                                        @php
                                            $options = ['Laki-laki', 'Perempuan'];
                                        @endphp

                                        @foreach ($options as $option)
                                            @if ($option !== $waliMurid->jenis_kelamin)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endif
                                        @endforeach


                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="hubungan">Hubungan:</label>
                                    <select class="form-control" id="hubungan" name="hubungan" required>
                                        <option value="{{ $waliMurid->hubungan }}" hidden>{{ $waliMurid->hubungan }}</option>
                                        <option value="Orang Tua Kandung">Orang Tua Kandung</option>
                                        <option value="Orang Tua Angkat">Orang Tua Angkat</option>
                                        <option value="Saudara">Saudara</option>
                                        <option value="Keponakan">Keponakan</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="kelurahan">Kelurahan</label>
                                    <input type="text" class="form-control" id="kelurahan" placeholder="Kelurahan"
                                        value="{{ $waliMurid->kelurahan }}" name="kelurahan">
                                </div>

                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" class="form-control" id="kecamatan" placeholder="Kecamatan"
                                        value="{{ $waliMurid->kecamatan }}" name="kecamatan">
                                </div>

                                <div class="form-group">
                                    <label for="kabupaten">Kabupaten/Kota</label>
                                    <input type="text" class="form-control" id="kabupaten"
                                        placeholder="Kabupaten/Kota" value="{{ $waliMurid->kabupatenKota }}"
                                        name="kabupatenKota">
                                </div>

                                <div class="form-group">
                                    <label for="provinsi">Provinsi</label>
                                    <input type="text" class="form-control" id="provinsi" placeholder="Provinsi"
                                        value="{{ $waliMurid->provinsi }}" name="provinsi">
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat Lengkap</label>
                                    <textarea class="form-control" id="alamat" rows="5" name="alamat" placeholder="Alamat lengkap">{{ $waliMurid->alamat }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="telepon">Nomor Telepon</label>
                                    <input type="tel" class="form-control" id="telepon"
                                        placeholder="Nomor Telepon" value="{{ $waliMurid->no_hp }}" name="nohp">
                                </div>

                                <div class="form-group">
                                    <label for="email">Alamat Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Alamat Email"
                                        value="{{ $waliMurid->email }}" name="email">
                                </div>

                                <div class="form-group">
                                    <label for="pekerjaan">Pekerjaan</label>
                                    <input type="text" class="form-control" id="pekerjaan" placeholder="Pekerjaan"
                                        value="{{ $waliMurid->pekerjaan }}" name="pekerjaan">
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </form>
                    <!-- Form Element sizes -->

                </div>

                <script>
                    function showAdditionalOptions() {
                        var hubungan = document.getElementById("hubungan");
                        var additionalOptions = document.getElementById("additionalOptions");

                        if (hubungan.value === "Orang Tua") {
                            additionalOptions.style.display = "block";
                        } else {
                            additionalOptions.style.display = "none";
                        }
                    }
                </script>

            </div>

            <div class="row">
                <div class="col-md-6">
                    {{-- Akun Wali Murid --}}
                    <form action="{{ asset('/wali-murid/setting/waliMurid/' . $waliMurid->id_userwaliMurid) }}" method="post">
                        @csrf
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Akun Wali Murid</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Username</label>
                                    <input type="text" class="form-control" id="nama" value="{{ $waliMurid->usernameWaliMurid }}" name="username" placeholder="Nama Lengkap">
                                </div>
                                <div class="form-group">
                                    <label for="password1">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="passwordWaliMurid" placeholder="Password" name="password" onchange="validatePasswordWaliMurid()">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i id="passwordWaliMuridToggle" class="fa fa-eye" onclick="togglePasswordVisibility('passwordWaliMurid', 'passwordWaliMuridToggle')"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small id="passwordWaliMuridError" class="text-danger"></small>
                                    <small class="password-requirement">Password minimal 8 karakter dan harus ada huruf besar.</small>
                                </div>
                                <div class="form-group">
                                    <label for="password2">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirmPasswordWaliMurid" name="confirmPassword" placeholder="Konfirmasi Password" onchange="validatePasswordWaliMurid()">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i id="confirmPasswordWaliMuridToggle" class="fa fa-eye" onclick="togglePasswordVisibility('confirmPasswordWaliMurid', 'confirmPasswordWaliMuridToggle')"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small id="confirmPasswordWaliMuridError" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Submit</button>
                            </div>
                        </div>
                    </form>
                    {{-- Akun Wali Murid --}}
                </div>

                <div class="col-md-6">
                    {{-- Akun Siswa  --}}
                    <form action="{{ asset('/wali-murid/setting/siswa/' . $waliMurid->id_usersiswa) }}" method="post">
                        @csrf
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Akun Siswa</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nik">Username</label>
                                    <input type="text" class="form-control" id="nisn" placeholder="Username" name="username" value="{{ $waliMurid->usernameSiswa }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="password3">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="passwordSiswa" placeholder="Password" name="password" onchange="validatePasswordSiswa()">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i id="passwordSiswaToggle" class="fa fa-eye" onclick="togglePasswordVisibility('passwordSiswa', 'passwordSiswaToggle')"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small id="passwordSiswaError" class="text-danger"></small>
                                    <small class="password-requirement">Password minimal 8 karakter dan harus ada huruf besar.</small>
                                </div>
                                <div class="form-group">
                                    <label for="password4">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirmPasswordSiswa" name="confirmPassword" placeholder="Konfirmasi Password" onchange="validatePasswordSiswa()">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i id="confirmPasswordSiswaToggle" class="fa fa-eye" onclick="togglePasswordVisibility('confirmPasswordSiswa', 'confirmPasswordSiswaToggle')"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small id="confirmPasswordSiswaError" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Submit</button>
                            </div>
                        </div>
                    </form>
                    {{-- Akun Siswa --}}
                </div>
            </div>

            <script>
                function togglePasswordVisibility(passwordId, toggleId) {
                    var passwordField = document.getElementById(passwordId);
                    var toggleElement = document.getElementById(toggleId);

                    if (passwordField.type === "password") {
                        passwordField.type = "text";
                        toggleElement.classList.remove("fa-eye");
                        toggleElement.classList.add("fa-eye-slash");
                    } else {
                        passwordField.type = "password";
                        toggleElement.classList.remove("fa-eye-slash");
                        toggleElement.classList.add("fa-eye");
                    }
                }

                function validatePasswordWaliMurid() {
                    var passwordField = document.getElementById("passwordWaliMurid").value;
                    var confirmPasswordField = document.getElementById("confirmPasswordWaliMurid").value;
                    var uppercaseRegex = /[A-Z]/;

                    if (passwordField.length < 8 || !uppercaseRegex.test(passwordField)) {
                        document.getElementById("passwordWaliMuridError").textContent =
                            "Password harus memiliki minimal 8 karakter dan setidaknya satu huruf besar.";
                    } else {
                        document.getElementById("passwordWaliMuridError").textContent = "";
                    }

                    if (passwordField !== confirmPasswordField) {
                        document.getElementById("confirmPasswordWaliMuridError").textContent =
                            "Konfirmasi Password tidak cocok.";
                    } else {
                        document.getElementById("confirmPasswordWaliMuridError").textContent = "";
                    }
                }

                function validatePasswordSiswa() {
                    var passwordField = document.getElementById("passwordSiswa").value;
                    var confirmPasswordField = document.getElementById("confirmPasswordSiswa").value;
                    varuppercaseRegex = /[A-Z]/;

                    if (passwordField.length < 8 || !uppercaseRegex.test(passwordField)) {
                        document.getElementById("passwordSiswaError").textContent =
                            "Password harus memiliki minimal 8 karakter dan setidaknya satu huruf besar.";
                    } else {
                        document.getElementById("passwordSiswaError").textContent = "";
                    }

                    if (passwordField !== confirmPasswordField) {
                        document.getElementById("confirmPasswordSiswaError").textContent =
                            "Konfirmasi Password tidak cocok.";
                    } else {
                        document.getElementById("confirmPasswordSiswaError").textContent = "";
                    }
                }
            </script>


    </section>
@endsection
