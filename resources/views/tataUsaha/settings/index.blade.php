@extends('layouts.main')

@section('main')


    <section class="content container-custom">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">

                    <div class="card card-success" style="height: ">
                        <div class="card-header">
                            <h3 class="card-title">Update Profile</h3>
                        </div>

                        <form id="tata-usaha" action="{{ asset('/tata-usaha/setting/' . $tataUsaha->user_id) }}" method="post"
                            enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" value="{{ $tataUsaha->nama }}"
                                        placeholder="Nama">
                                </div>

                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="form-control" id="nik" placeholder="NIK" name="nik"
                                        value="{{ $tataUsaha->nik }}" @if($tataUsaha->jenis !== 'Ketua Tata Usaha') disabled @endif>
                                </div>


                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <select class="form-control" id="agama" name="agama">
                                        <option selected value="{{ $tataUsaha->agama }}">{{ $tataUsaha->agama }}</option>
                                        @php
                                            $options = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
                                        @endphp
                                        @foreach ($options as $option)
                                            @if ($option !== $tataUsaha->agama)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="nohp">No Hp/Wa</label>
                                    <input type="text" class="form-control" id="nohp" name="nohp"
                                        placeholder="No Hp/Wa" value="{{ $tataUsaha->no_hp }}">
                                </div>

                                <div class="form-group">
                                    <label for="tempatlahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempatlahir" name="tempat_lahir"
                                        placeholder="Tempat Lahir" value="{{ $tataUsaha->tempat_lahir }}">
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                        value="{{ $tataUsaha->tanggal_lahir }}">
                                </div>

                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                        <option selected value="{{ $tataUsaha->jenis_kelamin }}">
                                            {{ $tataUsaha->jenis_kelamin }}</option>

                                        @php
                                            $options = ['Laki-laki', 'Perempuan'];
                                        @endphp

                                        @foreach ($options as $option)
                                            @if ($option !== $tataUsaha->jenis_kelamin)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endif
                                        @endforeach


                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="status_perkawinan">Status Perkawinan</label>
                                    <select class="form-control" id="status_perkawinan" name="status_perkawinan">
                                        <option selected value="{{ $tataUsaha->status_perkawinan }}">
                                            {{ $tataUsaha->status_perkawinan }}</option>

                                        @php
                                            $options = ['Belum Menikah', 'Menikah', 'Cerai'];
                                        @endphp

                                        @foreach ($options as $option)
                                            @if ($option !== $tataUsaha->status_perkawinan)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endif
                                        @endforeach


                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="kelurahan">Kelurahan</label>
                                    <input type="text" class="form-control" id="kelurahan" placeholder="Kelurahan"
                                        name="kelurahan" value="{{ $tataUsaha->kelurahan }}">
                                </div>

                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                        placeholder="Kecamatan" value="{{ $tataUsaha->kecamatan }}">
                                </div>

                                <div class="form-group">
                                    <label for="kabupaten">Kabupaten/Kota</label>
                                    <input type="text" class="form-control" id="kabupaten" name="kabupatenKota"
                                        placeholder="Kabupaten" value="{{ $tataUsaha->kabupatenKota }}">
                                </div>

                                <div class="form-group">
                                    <label for="provinsi">Provinsi</label>
                                    <input type="text" class="form-control" id="provinsi" name="provinsi"
                                        placeholder="Provinsi" value="{{ $tataUsaha->provinsi }}">
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat Lengkap</label>
                                    <textarea class="form-control" id="alamat" rows="5" name="alamat" placeholder="Alamat lengkap">{{ $tataUsaha->alamat }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Input Foto Profil</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" accept="image/*" onchange="showFileName(event)"
                                                class="custom-file-input" id="exampleInputFile" name="foto">
                                            <label class="custom-file-label" for="exampleInputFile" id="file-label">
                                                {{ $filename }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="preview-container" style="display: none;">
                                    <img id="preview-image" class="img-fluid" style="width: 300px" src="#"
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
                                <button type="submit" class="btn btn-success">Submit</button>
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
                                    fileLabel.textContent = '';

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
                    <form action="{{ asset('/tata-usaha/setting/' . $tataUsaha->nama . '/' . $tataUsaha->id_user) }}"
                        method="POST">
                        @csrf

                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Update Acount</h3>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email"
                                        name="email" value="{{ $tataUsaha->user_email }}">

                                </div>
                                <div class="form-group">
                                    <label for="text">Username</label>
                                    <input type="text" class="form-control" id="username" placeholder="Username" name="username"
                                        value="{{ $tataUsaha->user_username }}">
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
                                        var eyeIcon = this.querySelector("i");
                                        eyeIcon.classList.toggle("fa-eye");
                                        eyeIcon.classList.toggle("fa-eye-slash");
                                    });

                                    toggleConfirmPassword.addEventListener("click", function() {
                                        var type = confirmPasswordInput.getAttribute("type") === "password" ? "text" : "password";
                                        confirmPasswordInput.setAttribute("type", type);
                                        var eyeIcon = this.querySelector("i");
                                        eyeIcon.classList.toggle("fa-eye");
                                        eyeIcon.classList.toggle("fa-eye-slash");
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
                                            passwordInput.setCustomValidity(
                                                "Password harus memiliki minimal 8 karakter dan setidaknya satu huruf besar.");
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
