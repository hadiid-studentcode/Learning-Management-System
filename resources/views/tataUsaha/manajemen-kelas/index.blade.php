@extends('layouts.main')

@section('main')
    <div class="">
        <div class="card card-custom gutter-b">
            <div class="card-body" style="text-align: center;">
                <h2 class="text-dark-75 text-hover-success font-size-h1">Management Kelas</h2>
                <p class="text-dark-50 mt-2 text-center">Silahkan Atur Kelas Baru yang akan disediakan untuk Peserta Didik Baru</p>
            </div>
        </div>
    </div>

    <div class="">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <form action="{{ url('/tata-usaha/manajemen-kelas') }}" method="post">
                    @csrf

                    <div id="kelas-form">
                        <h4 class="mb-3 text-center">Formulir Tambah Kelas</h4>
                        <hr>
                        <div class="form-group">
                            <label for="nama-kelas">Nama Kelas:</label>
                            <select class="form-control" id="kelas" required name="kelas">
                                <option value="">Pilih Kelas</option>
                                @php
                                    $kelas = [1, 2, 3, 4, 5, 6];
                                @endphp

                                @foreach ($kelas as $k)
                                    <option value="{{ $k }}">{{ $k }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama-kelas">Nama Rombel:</label>
                            <input type="text" class="form-control" id="rombel" name="rombel"
                                placeholder="ex: Ahmad Dahlan" required>
                        </div>

                        <div class="form-group">
                            <label for="wali-kelas">Wali Kelas:</label>
                            <select class="form-control" id="wali-kelas" name="id_guru">
                                <option value="">Pilih Wali Kelas</option>
                                @foreach ($guruNonWalas as $gnw)
                                    <option value="{{ $gnw->id }}">{{ $gnw->nama }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="kuota-kelas">Kuota Siswa:</label>
                            <input type="number" class="form-control" id="kouta_siswa" name="kouta_siswa" required>
                        </div>

                        <button type="submit" class="btn btn-success">Tambah Kelas</button>
                    </div>
                </form>

            </div>
        </div>

        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="table-responsive">
             <table id="data_table" class="table display table-bordered table-striped">
                    <thead>
                        <tr>
                            <th colspan="6"><h5 class="text-center">Data Kelas</h5></th>
                        </tr>
                        <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Wali Kelas</th>
                            <th>Kuota Siswa</th>
                            <th>Jumlah Siswa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>


                        @php
                            $kelasGrouped = $getKelas->groupBy('id');
                        @endphp

                        @foreach ($kelasGrouped as $kelas)
                            @php
                                $kls = $kelas->first();
                                $jumlahSiswa = $kls->jumlah_siswa;
                                $koutaSiswa = $kls->kouta_siswa;
                                $isKapasitasPenuh = $jumlahSiswa > $koutaSiswa;
                            @endphp
                            <tr @if ($isKapasitasPenuh) style="background-color: rgba(255, 0, 0, 0.174)" @endif>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kls->nama }} {{ $kls->rombel }}</td>

                                <td>{{ $kls->guru }}</td>
                                <td>{{ $koutaSiswa }}</td>
                                <td>{{ $jumlahSiswa }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editkelas{{ $kls->id }}">
                                            <i class="fas fa-edit"></i> 
                                        </button>
                                        
                                        <div class="mb-2 ml-2 ml-md-0"></div> 
                                        
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal{{ $kls->id }}">
                                            <i class="fas fa-trash"></i> 
                                        </button>
                                    </div>
                                    

                                </td>
                            </tr>

                            {{-- edit kelas --}}
                            <div class="modal fade" id="editkelas{{ $kls->id }}">
                                <div class="modal-dialog">
                                    <form action="{{ url('/tata-usaha/manajemen-kelas/' . $kls->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Kelas</h4>

                                            </div>
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="nama-kelas">Nama Kelas:</label>
                                                    <select class="form-control" id="kelas" required name="kelas">
                                                        <option value="{{ $kls->nama }}">{{ $kls->nama }}</option>
                                                        @php
                                                            $kelas = [1, 2, 3, 4, 5, 6];
                                                        @endphp

                                                        @foreach ($kelas as $k)
                                                            <option value="{{ $k }}">{{ $k }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama-kelas">Nama Rombel:</label>
                                                    <input type="text" class="form-control" id="rombel" name="rombel"
                                                        placeholder="ex: Ahmad Dahlan" required
                                                        value="{{ $kls->rombel }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="wali-kelas">Wali Kelas:</label>
                                                    <select class="form-control" id="wali-kelas" required name="id_guru">
                                                        <option value="{{ $kls->id_guru }}">{{ $kls->guru }}</option>
                                                        @foreach ($guruNonWalas as $gnw)
                                                            <option value="{{ $gnw->id }}">{{ $gnw->nama }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="kuota-kelas">Kuota Siswa:</label>
                                                    <input type="number" class="form-control" id="kouta_siswa"
                                                        name="kouta_siswa" required value="{{ $koutaSiswa }}">
                                                </div>



                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Save changes</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Confirmation Delete Modal -->
                            <div class="modal fade" id="confirmDeleteModal{{ $kls->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus Jadwal
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus jadwal ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                            <form action="{{ url('/tata-usaha/manajemen-kelas/' . $kls->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return showConfirmation('{{ $kls->id }}')">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </tbody>
                </table>
                  </div>
               
            </div>
        </div>
    </div>
@endsection
