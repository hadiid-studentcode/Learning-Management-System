@extends('layouts.main')

@section('main')

<div class="">
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="d-flex flex-column align-items-center">
                <h2 class="text-dark-75 text-hover-success font-size-h1">Data Penerima Peserta Didik Baru</h2>
                <p class="text-dark-50 mt-2 text-center">Silakan anda periksa Data siswa yang berminat masuk ke Yayasan Sekolah Muammadiyah Kampa Boarding School</p>
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
                        <a class="nav-link" href="{{ url('/tata-usaha/kelola-ppdb') }}">
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
                        <a class="nav-link active" href="{{ url('/tata-usaha/kelola-ppdb/create') }}">
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

         

    {{-- Data siswa yang sudah di ACC --}}
            <div id="content_edit">
                <div class="card mt-5 card-custom gutter-b">
                    <div class="table-responsive">
                        <table id="data_table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="8"><h5 class="text-center">Tabel Data Siswa PPDB yang sudah di Terima</h5></th>
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
                                @foreach($peserta as $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $p->nama_siswa }}</td>
                                        <td>{{ $p->nisn_siswa }}</td>
                                        <td>{{ $p->kelas_siswa }}</td> {{-- Tanpa Romble Jika sudah di ACC TU baru pilih romble nya (HANYA MENAMPILKAN DIA DAFTAR DI KELAS BERAPA NB : NGGAK HARUS KELAS 1) --}}
                                        <td>{{ $p->jenis_kelamin_siswa }}</td>
                                        <td>{{ $p->nama_wali_murid }}</td>
                                        <td>
                                            <a href="https://wa.me/62{{ $p->no_hp_wali_murid }}" target="_blank" class="btn btn-success btn-sm">
                                                <i class="fab fa-whatsapp"></i>{{ $p->no_hp_wali_murid }}
                                            </a>
                                        </td>
                                        <td>{{ $p->alamat_siswa }}</td>
                                    </tr>
                                    @endforeach

                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>






@endsection
