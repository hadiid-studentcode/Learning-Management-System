@extends('layouts.main')

@section('main')
    <div class="">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    <h2 class="text-dark-75 text-hover-success font-size-h1">Data Penerima Peserta Didik Baru</h2>
                    <p class="text-dark-50 mt-2 text-center">Silakan anda periksa Data siswa yang berminat masuk ke Yayasan
                        Sekolah Muammadiyah Kampa Boarding School</p>
                </div>
            </div>
        </div>
    </div>


    <style>
        /* Tambahkan gaya CSS yang diperlukan di sini */
        .hidden {
            display: none;
        }

        .visible {
            display: block;
        }
    </style>


    <div class="" style="width:auto;">
        <div class="card card-custom" id="data_pertemuan">
            <div class="card-body">
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
                        <li class="nav-item mr-3">
                            <a class="nav-link active" href="{{ url('/tata-usaha/kelola-ppdb') }}">
                                <span class="nav-icon">
                                    <span class="svg-icon mr-3"></span>
                                    <svg width="25px" height="25x" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M19.5001 8.27355C19.5035 8.46127 19.4015 8.6351 19.236 8.72365L16.5982 10.1343L19.2196 11.4146C19.3883 11.497 19.4966 11.667 19.5001 11.8547C19.5035 12.0424 19.4015 12.2163 19.236 12.3048L16.598 13.7156L19.2195 14.9959C19.3882 15.0783 19.4966 15.2483 19.5 15.436C19.5035 15.6237 19.4015 15.7976 19.2359 15.8861L12.7074 19.3775C12.2655 19.6139 11.7346 19.6139 11.2927 19.3775L4.7642 15.8861C4.59864 15.7976 4.49663 15.6237 4.50008 15.436C4.50354 15.2483 4.61186 15.0783 4.78057 14.9959L7.40214 13.7156L4.76426 12.3048C4.59869 12.2163 4.49669 12.0424 4.50014 11.8547C4.50359 11.667 4.61192 11.497 4.78063 11.4146L7.40205 10.1343L4.76426 8.72365C4.59869 8.6351 4.49669 8.46127 4.50014 8.27355C4.50359 8.08582 4.61192 7.91586 4.78063 7.83346L11.3418 4.62897C11.7572 4.42609 12.243 4.42609 12.6584 4.62897L19.2196 7.83346C19.3883 7.91586 19.4966 8.08582 19.5001 8.27355ZM8.4898 14.2972L6.09799 15.4654L11.7643 18.4957C11.9116 18.5745 12.0885 18.5745 12.2358 18.4957L17.9021 15.4654L15.5104 14.2973L12.7075 15.7962C12.2655 16.0326 11.7347 16.0326 11.2927 15.7962L8.4898 14.2972ZM12.7075 12.2151L15.5105 10.716L17.9022 11.8841L12.2359 14.9144C12.0886 14.9932 11.9116 14.9932 11.7643 14.9144L6.09804 11.8841L8.48971 10.716L11.2927 12.2151C11.7347 12.4514 12.2655 12.4514 12.7075 12.2151ZM17.9022 8.30293L12.2195 5.52753C12.0811 5.4599 11.9191 5.4599 11.7807 5.52753L6.09804 8.30293L11.7643 11.3332C11.9116 11.412 12.0886 11.412 12.2359 11.3332L17.9022 8.30293Z"
                                            fill="#47495F" />
                                    </svg>
                                    <span class="nav-text font-size-lg">Pengajuan</span>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link" href="{{ url('/tata-usaha/kelola-ppdb/create') }}">
                                <span class="nav-icon">
                                    <span class="svg-icon mr-3"></span>
                                    <svg width="25px" height="25x" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M19.5001 8.27355C19.5035 8.46127 19.4015 8.6351 19.236 8.72365L16.5982 10.1343L19.2196 11.4146C19.3883 11.497 19.4966 11.667 19.5001 11.8547C19.5035 12.0424 19.4015 12.2163 19.236 12.3048L16.598 13.7156L19.2195 14.9959C19.3882 15.0783 19.4966 15.2483 19.5 15.436C19.5035 15.6237 19.4015 15.7976 19.2359 15.8861L12.7074 19.3775C12.2655 19.6139 11.7346 19.6139 11.2927 19.3775L4.7642 15.8861C4.59864 15.7976 4.49663 15.6237 4.50008 15.436C4.50354 15.2483 4.61186 15.0783 4.78057 14.9959L7.40214 13.7156L4.76426 12.3048C4.59869 12.2163 4.49669 12.0424 4.50014 11.8547C4.50359 11.667 4.61192 11.497 4.78063 11.4146L7.40205 10.1343L4.76426 8.72365C4.59869 8.6351 4.49669 8.46127 4.50014 8.27355C4.50359 8.08582 4.61192 7.91586 4.78063 7.83346L11.3418 4.62897C11.7572 4.42609 12.243 4.42609 12.6584 4.62897L19.2196 7.83346C19.3883 7.91586 19.4966 8.08582 19.5001 8.27355ZM8.4898 14.2972L6.09799 15.4654L11.7643 18.4957C11.9116 18.5745 12.0885 18.5745 12.2358 18.4957L17.9021 15.4654L15.5104 14.2973L12.7075 15.7962C12.2655 16.0326 11.7347 16.0326 11.2927 15.7962L8.4898 14.2972ZM12.7075 12.2151L15.5105 10.716L17.9022 11.8841L12.2359 14.9144C12.0886 14.9932 11.9116 14.9932 11.7643 14.9144L6.09804 11.8841L8.48971 10.716L11.2927 12.2151C11.7347 12.4514 12.2655 12.4514 12.7075 12.2151ZM17.9022 8.30293L12.2195 5.52753C12.0811 5.4599 11.9191 5.4599 11.7807 5.52753L6.09804 8.30293L11.7643 11.3332C11.9116 11.412 12.0886 11.412 12.2359 11.3332L17.9022 8.30293Z"
                                            fill="#47495F" />
                                    </svg>
                                    <span class="nav-text font-size-lg">Diterima</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Konten yang akan ditampilkan -->

                {{-- Data PPDB --}}
                <div id="content_buka" class="hidden">
                    <div class="card mt-5 card-custom gutter-b">
                        <div class="card-body">
                            {{-- Tabel Data Siswa Yang akan mendaftar --}}
                            <div class="table-responsive">
                                <table id="data_table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="7">
                                                <h5 class="text-center">Tabel Data Siswa PPDB</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="width: 5%">No</th>
                                            <th>Nama</th>
                                            <th>NISN</th>
                                            <th>Kelas</th>
                                            <th>Kelamin</th>
                                            <th>Kontak Orang Tua</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="siswa-table-body">
                                        @foreach ($peserta as $p)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $p->nama_siswa }}</td>
                                                <td>{{ $p->nisn_siswa }}</td>
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-control" name="kelas" id="kelas_input">
                                                            <option value="" hidden>--Pilih Romble Kelas
                                                                {{ $p->kelas_siswa }} --</option>
                                                            @foreach ($kelas as $k)
                                                                @if ($p->kelas_siswa == $k->nama)
                                                                    @if ($k->jumlah_siswa < $k->kouta_siswa)
                                                                        <option value="{{ $k->id }}">
                                                                           {{$p->kelas_siswa}} {{ $k->rombel }}</option>
                                                                    @endif
                                                                @endif
                                                            @endforeach

                                                        </select>

                                                    </div>
                                                </td>
                                                {{-- Tanpa Romble Jika sudah di ACC TU baru pilih romble nya (HANYA MENAMPILKAN DIA DAFTAR DI KELAS BERAPA NB : NGGAK HARUS KELAS 1) --}}
                                                <td>{{ $p->jenis_kelamin_siswa }}</td>
                                                <td>
                                                    <a href="https://wa.me/62{{ $p->no_hp_wali_murid }}" target="_blank"
                                                        class="btn btn-success btn-sm">
                                                        <i class="fab fa-whatsapp"></i> {{ $p->no_hp_wali_murid }}
                                                    </a>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm view-button"
                                                        data-toggle="modal" data-target="#detailModal_{{ $p->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="detailModal_{{ $p->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-xl"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Detail Siswa</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal">
                                                                        <span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="container-fluid">
                                                                        <div class="row">
                                                                            <!-- Foto Profil -->
                                                                            <div class="col-md-12 text-center mt-4 mb-4">

                                                                            
                                                                                <img src="{{ asset('/storage/siswa/images/' . $p->foto_siswa) }}"
                                                                                    alt="Foto Profil" class="img-fluid"
                                                                                    style="max-width: 300px;">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <table class="table">
                                                                                    <tbody>

                                                                                        <tr>
                                                                                            <td colspan="2">
                                                                                                <h4 class="text-center">Data
                                                                                                    Siswa</h4>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Nama</th>
                                                                                            <td>{{ $p->nama_siswa }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>NISN</th>
                                                                                            <td>{{ $p->nisn_siswa }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Kelas</th>
                                                                                            <td>{{ $p->kelas_siswa }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Jenis Kelamin</th>
                                                                                            <td>{{ $p->jenis_kelamin_siswa }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Agama</th>
                                                                                            <td>{{ $p->agama_siswa }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Tempat Lahir</th>
                                                                                            <td>{{ $p->tempat_lahir_siswa }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Kelurahan</th>
                                                                                            <td>{{ $p->kelurahan_siswa }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Kecamatan</th>
                                                                                            <td>{{ $p->kecamatan_siswa }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Provinsi</th>
                                                                                            <td>{{ $p->provinsi_siswa }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Alamat</th>
                                                                                            <td>{{ $p->alamat_siswa }}</td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <th>NIK Orang Tua</th>
                                                                                            <td>{{ $p->nik_wali_murid }}
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td colspan="2">
                                                                                                <h4 class="text-center">Data
                                                                                                    Wali Murid</h4>
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <th>Nama Orang Tua</th>
                                                                                            <td>{{ $p->nama_wali_murid }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Hubungan dengan siswa</th>
                                                                                            <td>{{ $p->hubungan_wali_murid }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Agama</th>
                                                                                            <td>{{ $p->agama_wali_murid }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Jenis Kelamin</th>
                                                                                            <td>{{ $p->jenis_kelamin_wali_murid }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Nomor HP</th>
                                                                                            <td>{{ $p->no_hp_wali_murid }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Kelurahan</th>
                                                                                            <td>{{ $p->kelurahan_wali_murid }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Kecamatan</th>
                                                                                            <td>{{ $p->kecamatan_wali_murid }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Kabupaten/Kota</th>
                                                                                            <td>{{ $p->kabupatenKota_wali_murid }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Provinsi</th>
                                                                                            <td>{{ $p->provinsi_wali_murid }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Email</th>
                                                                                            <td>{{ $p->email_wali_murid }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Pekerjaan</th>
                                                                                            <td>{{ $p->pekerjaan_wali_murid }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>Alamat</th>
                                                                                            <td>{{ $p->alamat_wali_murid }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <button type="button" class="btn btn-danger btn-sm delete-button"
                                                        data-toggle="modal"
                                                        data-target="#deleteSiswa_{{ $p->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>

                                                    <div class="modal fade" id="deleteSiswa_{{ $p->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="deleteSiswaLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteSiswaLabel">
                                                                        Konfirmasi Hapus</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah kamu yakin ingin menghapus data siswa ini?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form
                                                                        action="{{ url('/tata-usaha/kelola-ppdb/' . $p->id) }}"
                                                                        method="post">

                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Tutup</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Hapus</button>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <button type="button" class="btn btn-success btn-sm delete-button"
                                                        data-toggle="modal" data-target="#acceptSiswa">
                                                        <i class="fas fa-check"></i>
                                                    </button>


                                                    <div class="modal fade" id="acceptSiswa" tabindex="-1"
                                                        role="dialog" aria-labelledby="acceptSiswaLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="acceptSiswaLabel">
                                                                        Konfirmasi Penerimaan Siswa</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah kamu yakin ingin menerima siswa ini?
                                                                </div>



                                                                <div class="modal-footer">
                                                                    <form action="{{ url('/tata-usaha/kelola-ppdb/' . $p->id) }}" method="post">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="text" name="kelas"
                                                                            id="kelas_query" hidden>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Tutup</button>
                                                                        <button type="submit" class="btn btn-success"
                                                                           >Terima</button>
                                                                    </form>

                                                                </div>

                                                                <script>
                                                                    let kelasid = document.getElementById('kelas_input');
                                                                    let id_kelas = document.getElementById('kelas_query');

                                                                    kelasid.addEventListener('change', function() {
                                                                        id_kelas.value = kelasid.value;
                                                                    })
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                {{-- modal --}}

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                {{-- Data siswa yang sudah di ACC --}}
                <div id="content_edit" class="hidden">
                    <div class="card mt-5 card-custom gutter-b">
                        <div class="table-responsive">
                            <table id="data_table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="8">
                                            <h5 class="text-center">Tabel Data Siswa PPDB yang suda di Terima</h5>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Nama</th>
                                        <th>NISN</th>
                                        <th>Kelas</th>
                                        <th>Kelamin</th>
                                        <th>Nama Orang Tua</th>
                                        <th>Kontak Orang Tua</th>
                                        <th>Alamat</th>
                                    </tr>
                                </thead>
                                <tbody id="siswa-table-body">
                                    <tr>
                                        <td>1</td>
                                        <td>Ucok</td>
                                        <td>21390812390821</td>
                                        <td>1 </td> {{-- Tanpa Romble Jika sudah di ACC TU baru pilih romble nya (HANYA MENAMPILKAN DIA DAFTAR DI KELAS BERAPA NB : NGGAK HARUS KELAS 1) --}}
                                        <td>Laki Laki</td>
                                        <td>Ucok Saepudin</td>
                                        <td>
                                            <a href="https://wa.me/62932389232130" target="_blank"
                                                class="btn btn-success btn-sm">
                                                <i class="fab fa-whatsapp"></i> 0239480238402
                                            </a>
                                        </td>
                                        <td>pekanbaru</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script>
            // Fungsi untuk menampilkan konten yang sesuai dengan tombol yang ditekan
            function showContent(content) {
                var contentBuka = document.getElementById('content_buka');
                var contentEdit = document.getElementById('content_edit');

                // Sembunyikan kedua konten terlebih dahulu
                contentBuka.classList.add('hidden');
                contentEdit.classList.add('hidden');

                // Tampilkan konten yang sesuai dengan tombol yang ditekan
                if (content === 'buka') {
                    contentBuka.classList.remove('hidden');
                } else if (content === 'edit') {
                    contentEdit.classList.remove('hidden');
                }
            }

            showContent('buka');
        </script>
    @endsection
