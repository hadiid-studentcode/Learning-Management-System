@extends('layouts.main')

@section('main')


    <section class="content container-custom">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary" style="height: ">
                        <div class="card-header">
                            <h3 class="card-title">Update Profile</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ asset('/guru/setting/' . $guru->id) }}" method="post"
                            enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" value=" {{ $guru->nama }}"
                                        placeholder="Nama">
                                </div>

                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="form-control" id="nik" placeholder="NIK"
                                        value="{{ $guru->nik }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="nbm">nbm</label>
                                    <input type="text" class="form-control" id="nbm" placeholder="NIK"
                                        name="nbm" value="{{ $guru->nbm }}" disabled>

                                </div>

                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <select class="form-control" id="agama" name="agama">
                                        <option value="Islam" {{ $guru->agama === 'Islam' ? 'selected' : '' }}>Islam
                                        </option>
                                        <option value="Kristen">
                                            Kristen</option>
                                        <option value="Katolik" {{ $guru->agama === 'Katolik' ? 'selected' : '' }}>
                                            Katolik</option>
                                        <option value="Hindu" {{ $guru->agama === 'Hindu' ? 'selected' : '' }}>Hindu
                                        </option>
                                        <option value="Buddha" {{ $guru->agama === 'Buddha' ? 'selected' : '' }}>Buddha
                                        </option>
                                        <option value="Konghucu" {{ $guru->agama === 'Konghucu' ? 'selected' : '' }}>
                                            Konghucu</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="nohp">No Hp/Wa</label>
                                    <input type="text" class="form-control" id="nohp" name="nohp"
                                        placeholder="No Hp/Wa" value=" {{ $guru->nohp }}">
                                </div>

                                <div class="form-group">
                                    <label for="tempatlahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempatlahir" name="tempatlahir"
                                        placeholder="Tempat Lahir" value=" {{ $guru->tempat_lahir }}">
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                        value="{{ $guru->tanggal_lahir }}">
                                </div>

                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">

                                        @switch($guru->jenis_kelamin)
                                            @case('Laki-laki')

                                                <option selected value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            @break

                                            @case('Perempuan')
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option selected value="Perempuan">Perempuan</option>
                                            @break

                                            @default
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                        @endswitch


                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="status_perkawinan">Status Perkawinan</label>
                                    <select class="form-control" id="status_perkawinan" name="status_perkawinan">

                                        @switch($guru->status_perkawinan)
                                        @case('Belum Menikah')
                                            <option selected value="Belum Menikah">Belum Menikah</option>
                                            <option value="Menikah">Menikah</option>
                                            <option value="Cerai">Cerai</option>
                                        @break

                                        @case('Menikah')
                                            <option value="Belum Menikah">Belum Menikah</option>
                                            <option selected value="Menikah">Menikah</option>
                                            <option value="Cerai">Cerai</option>
                                        @break

                                        @case('Cerai')
                                            <option value="Belum Menikah">Belum Menikah</option>
                                            <option value="Menikah">Menikah</option>
                                            <option selected value="Cerai">Cerai</option>
                                        @break

                                        @default
                                            <option value="Belum Menikah">Belum Menikah</option>
                                            <option value="menikah">Menikah</option>
                                            <option selected value="cerai">Cerai</option>
                                    @endswitch


                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="StatusGuru">Status Guru</label>
                                    <select class="form-control" id="StatusGuru" name="StatusGuru" disabled>
                                        <option value="" hidden>Pilih Status Guru</option>
                                        <option value="Tetap">Tetap</option>
                                        <option value="Kontrak">Kontrak</option>
                                        <option value="Magang">Magang</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="kelurahan">Kelurahan</label>
                                    <input type="text" class="form-control" id="kelurahan" placeholder="Kelurahan"
                                        name="kelurahan" value="{{ $guru->kelurahan }}">
                                </div>

                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                        placeholder="Kecamatan" value="{{ $guru->kecamatan }} ">
                                </div>

                                <div class="form-group">
                                    <label for="kabupaten">Kabupaten/Kota</label>
                                    <input type="text" class="form-control" id="kabupaten" name="kabupatenKota"
                                        placeholder="Kabupaten" value="{{ $guru->kabupatenKota }} ">
                                </div>

                                <div class="form-group">
                                    <label for="provinsi">Provinsi</label>
                                    <input type="text" class="form-control" id="provinsi" name="provinsi"
                                        placeholder="Provinsi" value=" {{ $guru->provinsi }} ">
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat Lengkap</label>
                                    <textarea class="form-control" id="alamat" rows="5" name="alamat" placeholder="Alamat lengkap">{{ $guru->alamat }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Input Foto Profil</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" accept="image/*" onchange="showFileName(event)" class="custom-file-input" id="exampleInputFile" name="foto">
                                            <label class="custom-file-label" for="exampleInputFile" id="file-label">{{ $guru->foto }}</label>
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

                                    document.querySelectorAll('input[type="text"]').forEach(function(input) {
                                        input.value = '';
                                    });


                                    document.querySelectorAll('input[type="date"]').forEach(function(input) {
                                        input.value = '';
                                    });

                                    document.querySelectorAll('select').forEach(function(select) {
                                        select.selectedIndex = 0;
                                    });

                                    var fileInput = document.getElementById('exampleInputFile');
                                    fileInput.value = '';
                                    var fileLabel = document.getElementById('file-label');
                                    fileLabel.textContent = '{{ $filename }}';


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
                    <form action="{{ url('/guru/setting/' . $guruUser->id) }}" method="POST">
                        @csrf
                     

                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Update Account</h3>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ $guruUser->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="text">Username</label>
                                    <input type="text" class="form-control" id="nbm" placeholder="nbm" name="username" disabled value="{{ $guruUser->userid }}">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-eye" id="togglePassword"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-eye" id="toggleConfirmPassword"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
                                <script>
                                    const togglePassword = document.querySelector('#togglePassword');
                                    const password = document.querySelector('#password');

                                    togglePassword.addEventListener('click', function () {
                                        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                                        password.setAttribute('type', type);
                                        this.classList.toggle('fa-eye-slash');
                                    });

                                    const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
                                    const confirmPassword = document.querySelector('#confirmPassword');

                                    toggleConfirmPassword.addEventListener('click', function () {
                                        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                                        confirmPassword.setAttribute('type', type);
                                        this.classList.toggle('fa-eye-slash');
                                    });
                                </script>

                                <div class="form-group">
                                    <input type="checkbox" id="passwordRequirementCheckbox" disabled>
                                    <label for="passwordRequirementCheckbox">Password memenuhi persyaratan</label>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </form>
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
                            passwordRequirementCheckbox.checked = false;
                        } else {
                            passwordInput.setCustomValidity("");
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
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
