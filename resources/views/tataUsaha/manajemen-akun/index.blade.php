@extends('layouts.main')

@section('main')

    <div class="">
        <div class="card card-custom">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    <h2 class="text-dark-75 text-center ">Management Akun</h2>
                    <p class="text-dark-50 text-center">Silahkan Atur Pembuatan akun baru SIMU Kampa Untuk Semua Warga Sekolah Yang
                        Baru.</p>
                </div>
            </div>
        </div>
    </div

    {{-- <div class="">
        <div class="card card-custom gutter-b"> --}}
    {{-- <div class="card-body">
                <button id="tambah-akun-btn" class="btn btn-success" data-toggle="modal" data-target="#tambahAkun">Tambah
                    Akun</button>
            </div> --}}
    {{-- </div>
    </div> --}}
    {{-- tambah akun --}}
    {{-- <div id="tambahAkun" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Formulir Tambah Akun</h5>

                </div>
                <div class="modal-body">
                    <form action="{{ url('/tata-usaha/manajemen-akun') }}" id="akun-form" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control" id="nama" required name="nama_lengkap">
                        </div>

                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" required name="username">
                        </div>

                        <div class="form-group">
                            <label for="edit-password">Password:</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="edit-password" name="password">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i id="password-toggle" class="fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <script>
                            const passwordInput = document.getElementById('edit-password');
                            const passwordToggle = document.getElementById('password-toggle');

                            passwordToggle.addEventListener('click', function() {
                                if (passwordInput.type === 'password') {
                                    passwordInput.type = 'text';
                                    passwordToggle.classList.remove('fa-eye');
                                    passwordToggle.classList.add('fa-eye-slash');
                                } else {
                                    passwordInput.type = 'password';
                                    passwordToggle.classList.remove('fa-eye-slash');
                                    passwordToggle.classList.add('fa-eye');
                                }
                            });
                        </script>


                        <div class="form-group">
                            <label for="posisi">Posisi:</label>
                            <select class="form-control" id="posisi" required name="posisi">
                                <option value="" hidden>Pilih Posisi</option>
                                <option value="Guru">Guru</option>
                                <option value="Pegawai">Pegawai</option>
                                <option value="Siswa">Siswa</option>
                                <option value="Wali Murid">Wali Murid</option>
                                <option value="Tata Usaha">Tata Usaha</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Tambah</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data_table" class="table table-bordered table-striped" style="text-align: center">
                        <thead>
                            <tr>
                                <th colspan="5">
                                    <h5 class="text-center">Data Akun</h5>
                                </th>
                            </tr>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Posisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($akun as $a)
                                {{-- <tr @if ($a->siswa_id_user == null && $a->guru_id_user == null && $a->wali_murid_id_user == null && $a->pegawai_id_user == null) class="d-none" style="background-color: rgba(255, 0, 0, 0.174)"  @endif
                                 @if ($a->hak_akses == 'Super User') class="d-none" @endif       
                                        
                                        > --}}

                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $a->nama_lengkap }}</td>
                                            <td>{{ $a->userid }}</td>
                                            <td>{{ $a->hak_akses }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editAkun{{ $a->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    
                                                    <div style="width: 10px">

                                                    </div>

                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $a->nama_lengkap }}</td>
                                    <td>{{ $a->userid }}</td>
                                    <td>{{ $a->hak_akses }}</td>
                                    <td>

                                        <div class="btn-sm" role="group" aria-label="Basic mixed styles example">
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                data-target="#editAkun{{ $a->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                          
                                        </div>

                                        </form>
                                    </td>
                                </tr>

                                <div id="editAkun{{ $a->id }}" class="modal fade">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Formulir Edit Akun</h5>

                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('/tata-usaha/manajemen-akun/' . $a->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="edit-nama">Nama:</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $a->nama_lengkap }}" name="nama_lengkap" disabled>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="edit-username">Username:</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $a->userid }}" name="username" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit-password">Password:</label>
                                                        <div class="input-group">
                                                            <input type="password" class="form-control"
                                                                id="edit_password_{{ $a->id }}" name="password">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    <i id="password_toggle_{{ $a->id }}"
                                                                        class="fa fa-eye"
                                                                        onclick="eye({{ $a->id }})"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-success">Update</button>
                                                    <button type="button" class="btn btn-success"
                                                        data-dismiss="modal">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Confirmation Delete Modal -->
                           
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function eye(id) {

            const passwordInput = document.getElementById('edit_password_' + id);
            const togglePassword = document.getElementById('password_toggle_' + id);

            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.classList.toggle('fa-eye');
            togglePassword.classList.toggle('fa-eye-slash');
        }
    </script>
@endsection
