@extends('layouts.main')

@section('main')
    <div class="">
        <div class="card card-custom">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    <h2 class="text-dark-75 text-center ">Jadwal Mata Pelajaran</h2>
                    <p class="text-dark-50 text-center">Silakan input jadwal mata pelajaran sesuai tahun ajaran dan kelas
                        masing-masing.</p>
                </div>
            </div>
        </div>
    </div>

    <div class=" ">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <button id="tambah-siswa-btn" class="btn btn-success" data-toggle="modal" data-target="#tambahSiswa">Tambah
                    Jadwal</button>
                <div id="tambahSiswa" class="modal fade">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Formulir Tambah Jadwal</h5>

                            </div>
                            <form action="{{ url('tata-usaha/manajemen-mata-pelajaran') }}" id="jadwalForm" method="POST"
                                accept-charset="utf-8">
                                @csrf
                                <div class="modal-body">
                                    <div class="">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="control-label">Hari:</label>
                                                <select class="form-control" name="hari" required>
                                                    <option value="">Pilih Hari</option>
                                                    <option value="Senin">Senin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Kamis">Kamis</option>
                                                    <option value="Jumat">Jumat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Mata Pelajaran:</label>
                                                    <input type="text" name="mata_pelajaran" class="form-control"
                                                        placeholder="Masukkan Mata Pelajaran" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Jam Mulai - Jam Selesai:</label>
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="time" name="jam_mulai" class="form-control"
                                                                placeholder="Jam Mulai" required />
                                                        </div>
                                                        <div class="col">
                                                            <input type="time" name="jam_selesai" class="form-control"
                                                                placeholder="Jam Selesai" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 ml-auto">
                                                <div class="form-group">
                                                    <label class="control-label">Guru Pengajar:</label>
                                                    <select name="id_guru" class="form-control" required>
                                                        <option value="">Pilih Guru Pengajar</option>
                                                        @foreach ($guru as $g)
                                                            <option value="{{ $g->id }}">{{ $g->nama }} ||
                                                                {{ $g->bidang_studi }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Ruang Kelas:</label>
                                                    <select name="id_kelas" class="form-control" required>
                                                        <option value="">Pilih Ruang Kelas</option>
                                                        @foreach ($kelas as $k)
                                                            <option value="{{ $k->id }}">{{ $k->nama }}
                                                                {{ $k->rombel }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Tahun Mulai - Tahun Selesai:</label>
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="number" name="tahun_mulai" class="form-control"
                                                                disabled pattern="^\d{4}$" placeholder="Tahun Mulai"
                                                                value="{{ $tahun_mulai }}" required>

                                                            <input type="hidden" name="tahun_mulai" class="form-control"
                                                                pattern="^\d{4}$" placeholder="Tahun Mulai"
                                                                value="{{ $tahun_mulai }}" required>
                                                        </div>
                                                        -
                                                        <div class="col">
                                                            <input type="number" name="tahun_selesai" class="form-control"
                                                                pattern="^\d{4}$" placeholder="Tahun Selesai" disabled
                                                                value="{{ $tahun_selesai }}" required>


                                                            <input type="hidden" name="tahun_selesai" class="form-control"
                                                                pattern="^\d{4}$" placeholder="Tahun Selesai"
                                                                value="{{ $tahun_selesai }}" required>




                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Jumlah Pertemuan:</label>
                                                    <input type="number" name="jumlah_pertemuan" class="form-control"
                                                        placeholder="Masukkan Jumlah Pertemuan" required>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left"
                                        data-dismiss="modal">TUTUP</button>
                                    <button id="simpanButton" type="submit" class="btn btn-success">SIMPAN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-custom gutter-b">
        <div class="card-body">
            <form>
                <div class="form-group">
                  <label for="selectKelas">Pilih Kelas:</label>
                  <select class="form-control" id="selectKelas">
                    <option hidden>--Pilih Kelas--</option>
                    <option>Kelas A</option>
                    <option>Kelas B</option>
                    <option>Kelas C</option>

                  </select>
                </div>
                <div class="form-group">
                  <label for="selectRuang">Pilih Romble:</label>
                  <select class="form-control" id="selectRuang">
                    <option hidden>--Pilih Romble--</option>
                    <option>Romble 1</option>
                    <option>Romble 2</option>
                    <option>Romble 3</option>

                  </select>
                </div>
                <div class="form-group">
                  <label for="selectHari">Pilih Hari:</label>
                  <select class="form-control" id="selectHari">
                    <option hidden>--Pilih Hari--</option>
                    <option>Senin</option>
                    <option>Selasa</option>
                    <option>Rabu</option>
                    <option>Kamis</option>
                    <option>Jumat</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-success">Lihat Jadwal</button>
              </form>
        </div>
    </div>

    <div class="">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="table-responsive">
                    {{-- alert jadwal bentrok --}}

                    @if (session('error'))
                        <div class="alert alert-warning d-flex justify-content-between align-items-center custom-alert"
                            role="alert">
                            <div class="alert-content">
                                <i class="fas fa-exclamation-circle custom-icon"></i>
                                <strong class="custom-strong">Perhatian!</strong> Ada kesalahan yang perlu Anda ketahui
                                Bahwa Terjadi {{ session('error') }}
                            </div>
                            <button type="button" class="close custom-close" data-dismiss="alert" aria-label="Tutup">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- alert jadwal bentrok --}}



                        <div class="row" style="width: 100%;">
                          <div class="col-md-12">
                            <table class="table table-bordered table-striped" >
                                <thead>
                                    <tr>
                                        <th colspan="9">
                                            <h5 class="text-center">Data Jadwal Kelas</h5>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Hari</th>
                                        <th>Waktu</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Guru Pengajar</th>
                                        <th>Ruang Kelas</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mapel as $m)
                                        <tr>
                                            <td>{{ $m->kode }}</td>
                                            <td>{{ $m->hari }}</td>
                                            <td>{{ substr($m->waktu_mulai, 0, 5) }}-{{ substr($m->waktu_selesai, 0, 5) }}</td>
                                            <td>{{ $m->nama }}</td>
                                            <td>{{ $m->guru }}</td>
                                            <td>{{ $m->kelas }} {{ $m->rombel }}</td>
                                            <td>{{ $m->tahun_ajaran }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm" aria-label="Basic mixed styles example">
                                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                                        data-target="#editmapel{{ $m->id }}" style="margin-right: 5%">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#confirmDeleteModal{{ $m->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>


                                                    {{-- modal edit mapel --}}
                                        <div class="">
                                            <div class="form-group row">
                                                <div id="jadwalPopup">
                                                    <div class="modal fade bd-example-modal-lg"
                                                        id="editmapel{{ $m->id }}">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h2 class="modal-title">Input Jadwal Pelajaran </h2>
                                                                </div>
                                                                <form
                                                                    action="{{ url('tata-usaha/manajemen-mata-pelajaran/' . $m->id) }}"
                                                                    id="jadwalForm" method="POST" accept-charset="utf-8">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class="-fluid">
                                                                            <div class="row">
                                                                                <div class="col-sm-6">
                                                                                    <label class="control-label">Hari:</label>
                                                                                    <select class="form-control" name="hari"
                                                                                        required>
                                                                                        <option value="{{ $m->hari }}">
                                                                                            {{ $m->hari }}</option>
                                                                                        <option value="Senin">Senin</option>
                                                                                        <option value="Selasa">Selasa</option>
                                                                                        <option value="Rabu">Rabu</option>
                                                                                        <option value="Kamis">Kamis</option>
                                                                                        <option value="Jumat">Jumat</option>
                                                                                        <option value="Sabtu">Sabtu</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label">Mata
                                                                                            Pelajaran:</label>
                                                                                        <input type="text"
                                                                                            name="mata_pelajaran"
                                                                                            class="form-control"
                                                                                            placeholder="Masukkan Mata Pelajaran"
                                                                                            required value="{{ $m->nama }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label">Jam Mulai
                                                                                            - Jam
                                                                                            Selesai:</label>
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <input type="time"
                                                                                                    name="jam_mulai"
                                                                                                    class="form-control"
                                                                                                    placeholder="Jam Mulai"
                                                                                                    required
                                                                                                    value="{{ $m->waktu_mulai }}" />
                                                                                            </div>
                                                                                            <div class="col">
                                                                                                <input type="time"
                                                                                                    name="jam_selesai"
                                                                                                    class="form-control"
                                                                                                    placeholder="Jam Selesai"
                                                                                                    value="{{ $m->waktu_selesai }}"
                                                                                                    required />
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6 ml-auto">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label">Guru
                                                                                            Pengajar:</label>
                                                                                        <select name="id_guru"
                                                                                            class="form-control" required>
                                                                                            <option value="{{ $m->id_guru }}">
                                                                                                {{ $m->guru }} ||
                                                                                                {{ $g->bidang_studi }}
                                                                                            </option>
                                                                                            @foreach ($guru as $g)
                                                                                                <option
                                                                                                    value="{{ $g->id }}">
                                                                                                    {{ $g->nama }} ||
                                                                                                    {{ $g->bidang_studi }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label">Ruang
                                                                                            Kelas:</label>
                                                                                        <select name="id_kelas"
                                                                                            class="form-control" required>
                                                                                            <option value="{{ $m->id_kelas }}">
                                                                                                {{ $m->kelas }}
                                                                                                {{ $m->rombel }}
                                                                                            </option>
                                                                                            @foreach ($kelas as $k)
                                                                                                <option
                                                                                                    value="{{ $k->id }}">
                                                                                                    {{ $k->nama }}
                                                                                                    {{ $k->rombel }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                @php

                                                                                    $string = $m->tahun_ajaran;
                                                                                    $parts = explode('-', $string);
                                                                                    $tahunMulai = $parts[0];
                                                                                    $tahunSelesai = $parts[1];

                                                                                @endphp



                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label">Tahun
                                                                                            Mulai -
                                                                                            Tahun
                                                                                            Selesai:</label>
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <input type="number" disabled
                                                                                                    name="tahun_mulai"
                                                                                                    class="form-control"
                                                                                                    pattern="^\d{4}$"
                                                                                                    placeholder="Tahun Mulai"
                                                                                                    value="{{ $tahunMulai }}"
                                                                                                    required />

                                                                                                <input type="hidden"
                                                                                                    name="tahun_mulai"
                                                                                                    class="form-control"
                                                                                                    pattern="^\d{4}$"
                                                                                                    placeholder="Tahun Mulai"
                                                                                                    value="{{ $tahunMulai }}"
                                                                                                    required />
                                                                                            </div>
                                                                                            /
                                                                                            <div class="col">
                                                                                                <input type="number" disabled
                                                                                                    name="tahun_selesai"
                                                                                                    class="form-control"
                                                                                                    pattern="^\d{4}$"
                                                                                                    placeholder="Tahun Selesai"
                                                                                                    value="{{ $tahunSelesai }}"
                                                                                                    required />


                                                                                                <input type="hidden"
                                                                                                    name="tahun_selesai"
                                                                                                    class="form-control"
                                                                                                    pattern="^\d{4}$"
                                                                                                    placeholder="Tahun Selesai"
                                                                                                    value="{{ $tahunSelesai }}"
                                                                                                    required />
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default pull-left"
                                                                            data-dismiss="modal">TUTUP</button>
                                                                        <button id="simpanButton" type="submit"
                                                                            class="btn btn-success">SIMPAN</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- modal konfirmasi hapus --}}
                                        <div class="modal fade" id="confirmDeleteModal{{ $m->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus
                                                            Jadwal
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
                                                        <form action="{{ url('/tata-usaha/manajemen-mata-pelajaran/' . $m->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"
                                                                id="deleteConfirmationButton">Hapus</button>
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
                        <div class="row">
                          <div class="col-md-12">
                           <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                <li class="page-item disabled">
                                <a class="page-link text-success" href="#" tabindex="-1" aria-disabled="true" >Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link text-success" href="#">1</a></li>
                                <li class="page-item"><a class="page-link text-success" href="#">2</a></li>
                                <li class="page-item"><a class="page-link text-success" href="#">3</a></li>
                                <li class="page-item">
                                <a class="page-link text-success" href="#">Next</a>
                                </li>
                            </ul>
                            </nav>
                          </div>
                        </div>


                </div>

            </div>
        </div>
    </div>
@endsection
