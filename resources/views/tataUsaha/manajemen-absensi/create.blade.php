@extends('layouts.main')

@section('main')
    {{-- @include('partials.alert') --}}
    <div class="">

        <div class="card card-custom">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    <h2 class="text-dark-75 text-center ">Jadwal Absensi Guru dan Karyawan</h2>
                    <p class="text-dark-50 text-center">Silakan Atur Jam Absensi dan atur keterangan Absensi Karyawan dan
                        guru.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="" style="width:auto;">
        <div class="card card-custom" id="data_pertemuan">
            <div class="card-body">
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
                        <li class="nav-item mr-3">
                            <a class="nav-link" href="{{ url('tata-usaha/manajemen-absensi') }}">
                                <span class="nav-icon">
                                    <span class="svg-icon mr-3"></span>
                                    <svg width="25px" height="25x" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M19.5001 8.27355C19.5035 8.46127 19.4015 8.6351 19.236 8.72365L16.5982 10.1343L19.2196 11.4146C19.3883 11.497 19.4966 11.667 19.5001 11.8547C19.5035 12.0424 19.4015 12.2163 19.236 12.3048L16.598 13.7156L19.2195 14.9959C19.3882 15.0783 19.4966 15.2483 19.5 15.436C19.5035 15.6237 19.4015 15.7976 19.2359 15.8861L12.7074 19.3775C12.2655 19.6139 11.7346 19.6139 11.2927 19.3775L4.7642 15.8861C4.59864 15.7976 4.49663 15.6237 4.50008 15.436C4.50354 15.2483 4.61186 15.0783 4.78057 14.9959L7.40214 13.7156L4.76426 12.3048C4.59869 12.2163 4.49669 12.0424 4.50014 11.8547C4.50359 11.667 4.61192 11.497 4.78063 11.4146L7.40205 10.1343L4.76426 8.72365C4.59869 8.6351 4.49669 8.46127 4.50014 8.27355C4.50359 8.08582 4.61192 7.91586 4.78063 7.83346L11.3418 4.62897C11.7572 4.42609 12.243 4.42609 12.6584 4.62897L19.2196 7.83346C19.3883 7.91586 19.4966 8.08582 19.5001 8.27355ZM8.4898 14.2972L6.09799 15.4654L11.7643 18.4957C11.9116 18.5745 12.0885 18.5745 12.2358 18.4957L17.9021 15.4654L15.5104 14.2973L12.7075 15.7962C12.2655 16.0326 11.7347 16.0326 11.2927 15.7962L8.4898 14.2972ZM12.7075 12.2151L15.5105 10.716L17.9022 11.8841L12.2359 14.9144C12.0886 14.9932 11.9116 14.9932 11.7643 14.9144L6.09804 11.8841L8.48971 10.716L11.2927 12.2151C11.7347 12.4514 12.2655 12.4514 12.7075 12.2151ZM17.9022 8.30293L12.2195 5.52753C12.0811 5.4599 11.9191 5.4599 11.7807 5.52753L6.09804 8.30293L11.7643 11.3332C11.9116 11.412 12.0886 11.412 12.2359 11.3332L17.9022 8.30293Z"
                                            fill="#47495F" />
                                    </svg>
                                    <span class="nav-text font-size-lg">Buka</span>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link active" href="{{ url('tata-usaha/manajemen-absensi/create') }}">
                                <span class="nav-icon">
                                    <span class="svg-icon mr-3"></span>
                                    <svg width="25px" height="25x" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M19.5001 8.27355C19.5035 8.46127 19.4015 8.6351 19.236 8.72365L16.5982 10.1343L19.2196 11.4146C19.3883 11.497 19.4966 11.667 19.5001 11.8547C19.5035 12.0424 19.4015 12.2163 19.236 12.3048L16.598 13.7156L19.2195 14.9959C19.3882 15.0783 19.4966 15.2483 19.5 15.436C19.5035 15.6237 19.4015 15.7976 19.2359 15.8861L12.7074 19.3775C12.2655 19.6139 11.7346 19.6139 11.2927 19.3775L4.7642 15.8861C4.59864 15.7976 4.49663 15.6237 4.50008 15.436C4.50354 15.2483 4.61186 15.0783 4.78057 14.9959L7.40214 13.7156L4.76426 12.3048C4.59869 12.2163 4.49669 12.0424 4.50014 11.8547C4.50359 11.667 4.61192 11.497 4.78063 11.4146L7.40205 10.1343L4.76426 8.72365C4.59869 8.6351 4.49669 8.46127 4.50014 8.27355C4.50359 8.08582 4.61192 7.91586 4.78063 7.83346L11.3418 4.62897C11.7572 4.42609 12.243 4.42609 12.6584 4.62897L19.2196 7.83346C19.3883 7.91586 19.4966 8.08582 19.5001 8.27355ZM8.4898 14.2972L6.09799 15.4654L11.7643 18.4957C11.9116 18.5745 12.0885 18.5745 12.2358 18.4957L17.9021 15.4654L15.5104 14.2973L12.7075 15.7962C12.2655 16.0326 11.7347 16.0326 11.2927 15.7962L8.4898 14.2972ZM12.7075 12.2151L15.5105 10.716L17.9022 11.8841L12.2359 14.9144C12.0886 14.9932 11.9116 14.9932 11.7643 14.9144L6.09804 11.8841L8.48971 10.716L11.2927 12.2151C11.7347 12.4514 12.2655 12.4514 12.7075 12.2151ZM17.9022 8.30293L12.2195 5.52753C12.0811 5.4599 11.9191 5.4599 11.7807 5.52753L6.09804 8.30293L11.7643 11.3332C11.9116 11.412 12.0886 11.412 12.2359 11.3332L17.9022 8.30293Z"
                                            fill="#47495F" />
                                    </svg>
                                    <span class="nav-text font-size-lg">Edit</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-body p-0">
                        <h3 class="text-center mt-2">Edit Absensi</h3>
                        <hr>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <h5 class="text-center mb-4">Pilih Range Waktu Absensi Untuk Melihat Data Absensi</h5>
                                <form action="{{ url('tata-usaha/manajemen-absensi/Search') }}" method="GET" class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="start_date">Waktu Mulai :</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ isset($start_date) ? $start_date : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="end_date">Waktu Selesai:</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ isset($end_date) ? $end_date : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success mt-3 mb-4">Tampilkan Absensi</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="row gutetr-b">
            <div class="col-md-6">
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        @php
                            use Carbon\Carbon;
                            if (isset($tanggal)) {
                                $tanggal = $tanggal;
                                $tanggalSearch = Carbon::createFromFormat('Y-m-d', $tanggal)->format('d F Y');
                            }

                        @endphp
                        <h5 class="text-center text-uppercase">Data Absensi Guru
                            {{ isset($tanggal) ? $tanggalSearch : 'DD-MM-YYY' }}</h5>
                        <hr>
                        <div class="table-responsive">
                            <table id="data_table" class="table table-striped table-bordered "
                                style="text-align: center; font-size:90%;">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Waktu</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (isset($getGuruSearch))
                                        @foreach ($getGuruSearch as $gs)
                                            <tr>
                                                <td>{{ $gs->nama }}</td>
                                                <td>{{ $gs->waktu }}</td>
                                                <td>{{ $gs->status }}</td>

                                                <form action="{{ url('tata-usaha/manajemen-absensi/' . $gs->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('put')

                                                    <input type="hidden" name="jenis" value="guru">
                                                    @if (isset($tanggal))
                                                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                                                    @else
                                                    @endif

                                                    <td>
                                                        <select class="form-control" name="status">
                                                            <option value="" hidden>Pilih</option>
                                                            <option value="Hadir">Hadir</option>
                                                            <option value="Izin">Izin</option>
                                                            <option value="Sakit">Sakit</option>
                                                            <option value="Terlambat">Terlambat</option>
                                                            <option value="Mangkir">Mangkir</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-sm btn-success"
                                                            data-toggle="modal" data-target="#myModal"><i
                                                                class="fas fa-check"></i> </button>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            data-toggle="modal"
                                                            data-target="#hapusabsensigurusearch_{{ $gs->id }}"><i
                                                                class="fas fa-trash"></i> </button>
                                                    </td>
                                                </form>

                                                <!-- Modal untuk konfirmasi hapus -->
                                                <div class="modal fade" id="hapusabsensigurusearch_{{ $gs->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteConfirmationModalLabel">
                                                                    Konfirmasi Hapus
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data ini?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Batal</button>
                                                                <form
                                                                    action="{{ url('/tata-usaha/manajemen-absensi/data-absen-guru/delete/' . $gs->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </tr>
                                        @endforeach
                                    @else
                                        @foreach ($guru as $g)
                                            <tr>
                                                <td>{{ $g->nama }}</td>
                                                <td>{{ $g->waktu }}</td>
                                                <td>{{ $g->status }}</td>

                                                <form action="{{ url('tata-usaha/manajemen-absensi/' . $g->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('put')

                                                    <input type="hidden" name="jenis" value="guru">
                                                    @if (isset($tanggal))
                                                        <input type="hidden" name="tanggal"
                                                            value="{{ $tanggal }}">
                                                    @else
                                                    @endif

                                                    <td>
                                                        <select class="form-control" name="status">
                                                            <option value="" hidden>Pilih</option>
                                                            <option value="Hadir">Hadir</option>
                                                            <option value="Izin">Izin</option>
                                                            <option value="Sakit">Sakit</option>
                                                            <option value="Terlambat">Terlambat</option>
                                                            <option value="Mangkir">Mangkir</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-sm btn-success"
                                                            data-toggle="modal" data-target="#myModal"><i
                                                                class="fas fa-check"></i> </button>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            data-toggle="modal"
                                                            data-target="#hapusabsensiguru_{{ $g->id }}"><i
                                                                class="fas fa-trash"></i> </button>


                                                    </td>
                                                </form>

                                                <!-- Modal untuk konfirmasi hapus -->
                                                <div class="modal fade" id="hapusabsensiguru_{{ $g->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteConfirmationModalLabel">
                                                                    Konfirmasi Hapus
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data ini?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Batal</button>


                                                                <form
                                                                    action="{{ url('/tata-usaha/manajemen-absensi/data-absen-guru/delete/' . $g->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Hapus</button>
                                                                </form>





                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <h5 class="text-center text-uppercase">Data Absensi Pegawai
                            {{ isset($tanggal) ? $tanggalSearch : 'DD-MM-YYY' }}</h5>
                        <hr>
                        <div class="table-responsive">
                            <table id="data_table1" class="table table-striped table-bordered "
                                style="text-align: center; font-size:90%;">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Waktu</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (isset($pegawaiSearch))
                                        @foreach ($pegawaiSearch as $ps)
                                            <tr>
                                                <td>{{ $ps->nama }}</td>
                                                <td>{{ $ps->waktu }}</td>
                                                <td>{{ $ps->status }}</td>

                                                <form action="{{ url('tata-usaha/manajemen-absensi/' . $ps->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('put')

                                                    <input type="hidden" name="jenis" value="pegawai">
                                                    @if (isset($tanggal))
                                                        <input type="hidden" name="tanggal"
                                                            value="{{ $tanggal }}">
                                                    @else
                                                    @endif
                                                    <td>
                                                        <select class="form-control" name="status">
                                                            <option value="" hidden>Pilih</option>
                                                            <option value="Hadir">Hadir</option>
                                                            <option value="Izin">Izin</option>
                                                            <option value="Sakit">Sakit</option>
                                                            <option value="Terlambat">Terlambat</option>
                                                            <option value="Mangkir">Mangkir</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-sm btn-success"
                                                            data-toggle="modal" data-target="#myModal"><i
                                                                class="fas fa-check"></i> </button>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            data-toggle="modal" data-target="#deleteModal"><i
                                                                class="fas fa-trash"></i> </button>
                                                    </td>
                                                </form>

                                                <!-- Modal untuk konfirmasi hapus -->
                                                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteConfirmationModalLabel">
                                                                    Konfirmasi Hapus
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data ini?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Batal</button>
                                                                <form
                                                                    action="{{ url('/tata-usaha/manajemen-absensi/data-absen-pegawai/delete/' . $ps->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Hapus</button>
                                                                </form>


                                                            </div>
                                                        </div>
                                                    </div>


                                            </tr>
                                        @endforeach
                                    @else
                                        @foreach ($pegawai as $p)
                                            <tr>
                                                <td>{{ $p->nama }}</td>
                                                <td>{{ $p->waktu }}</td>
                                                <td>{{ $p->status }}</td>

                                                <form action="{{ url('tata-usaha/manajemen-absensi/' . $p->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('put')

                                                    <input type="hidden" name="jenis" value="pegawai">
                                                    @if (isset($tanggal))
                                                        <input type="hidden" name="tanggal"
                                                            value="{{ $tanggal }}">
                                                    @else
                                                    @endif
                                                    <td>
                                                        <select class="form-control" name="status">
                                                            <option value="" hidden>Pilih</option>
                                                            <option value="Hadir">Hadir</option>
                                                            <option value="Izin">Izin</option>
                                                            <option value="Sakit">Sakit</option>
                                                            <option value="Terlambat">Terlambat</option>
                                                            <option value="Mangkir">Mangkir</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-sm btn-success"
                                                            data-toggle="modal" data-target="#myModal"><i
                                                                class="fas fa-check"></i> </button>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            data-toggle="modal" data-target="#deleteModal"><i
                                                                class="fas fa-trash"></i> </button>
                                                    </td>
                                                </form>


                                                <!-- Modal untuk konfirmasi hapus -->
                                                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteConfirmationModalLabel">
                                                                    Konfirmasi Hapus
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data ini?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Batal</button>
                                                                <form
                                                                    action="{{ url('/tata-usaha/manajemen-absensi/data-absen-pegawai/delete/' . $p->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                            </tr>
                                        @endforeach
                                    @endif



                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

       @php
       if(isset($tanggal)){
           $url = url('/tata-usaha/manajemen-absensi/cetak/absensi/'.$tanggal);
       }else{
           $url = url('/tata-usaha/manajemen-absensi/cetak/absensi/all');
       }    
       @endphp

            <a href="javascript:void(0);" class="btn btn-success container mb-3"
                style="width: 20%; backround-color:#7ED7C1;"  onclick="window.open('{{ $url }}', '_blank', 'width=800,height=auto,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');">
                <i class="fas fa-print"></i> Print
            </a>

        </div>

    </div>
@endsection
