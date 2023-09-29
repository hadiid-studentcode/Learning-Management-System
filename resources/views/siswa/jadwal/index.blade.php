@extends('layouts.main')

@section('main')
    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h4 class="card-label text-bold">Halaman Kelas</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/siswa/jadwal/create') }}" method="get">
                            <div class="mb-7">
                                <div class="row align-items-center">
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 my-2 my-md-0">
                                                <div class="d-flex align-items-center">
                                                    <select name="tahun_ajaran" class="form-control" id='tahun_ajaran'>
                                                        <option
                                                            value="@if (isset($searchTahunAjaran)) {{ $searchTahunAjaran }}@else @endif"
                                                            selected="selected">
                                                            @if (isset($searchTahunAjaran))
                                                                {{ $searchTahunAjaran }}
                                                            @else
                                                                Pilih Tahun Ajaran
                                                            @endif
                                                        </option>
                                                        @foreach ($tahunAjaran as $th)
                                                            <option value="{{ $th->tahun_ajaran }}">{{ $th->tahun_ajaran }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 my-2 my-md-0">
                                                <div class="d-flex align-items-center">
                                                    <select class="form-control" name="hari" id='hari'>
                                                        <option
                                                            value="@if (isset($searchHari)) {{ $searchHari }}@else @endif"
                                                            selected="selected" hidden>
                                                            @if (isset($searchHari))
                                                                {{ $searchHari }}
                                                            @else
                                                                Pilih Hari
                                                            @endif
                                                        </option>
                                                        <option value="Senin">Senin</option>
                                                        <option value="Selasa">Selasa</option>
                                                        <option value="Rabu">Rabu</option>
                                                        <option value="Kamis">Kamis</option>
                                                        <option value="Jumat">Jumat</option>
                                                        <option value="Sabtu">Sabtu</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 my-2 my-md-0">
                                                <div class="input-icon">
                                                    <div class="input-group rounded">
                                                        <button type="submit" class="btn btn-success">Search</button>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>




    @if ($kunci == null)

        <div class="">

            <div class="card card-custom">
                <div class="table-responsive" id="isi_data">
                    <table class="table table-borderless table-vertical-center">
                        <thead>
                            <tr>
                                <th class="p-0" style="width: 5%"></th>
                                <th class="p-0" style="width: 70%"></th>
                                <th class="p-0" style="width: 20%"></th>
                                <th class="p-0" style="width: 5%"></th>
                            </tr>
                        </thead>
                        <div style="margin-bottom: 10px"></div>
                        <tbody>
                            @foreach ($mapel as $m)
                                <tr>
                                    <td class="pl-0 py-4 align-middle">
                                        <div class="symbol symbol-45 symbol-light-success mr-2">
                                            <span class="symbol-label">
                                                <span class="svg-icon svg-icon-2x svg-icon-success">
                                                    <i class="fas fa-book" style="margin-left: 15px"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="pl-0 align-middle">
                                        <a href="{{ asset('siswa/jadwal/' . $m->kode) }}"
                                            class="text-dark-75 font-weight-bolder text-hover-success mb-1 font-size-lg">{{ $m->nama }}
                                            ({{ $m->hari }} | {{ $m->kelas }} {{ $m->rombel }})
                                        </a>
                                        <span class="text-muted font-weight-bold d-block">Kelas {{ $m->kelas }}
                                            {{ $m->rombel }}</span>

                                        <span class="text-muted font-weight-bold">{{ $m->hari }} |
                                            {{ substr($m->waktu_mulai, 0, 5) }} WIB -
                                            {{ substr($m->waktu_selesai, 0, 5) }} WIB</span>
                                    </td>
                                    <td class="text-right pr-0 align-middle">
                                        <a href="{{ asset('siswa/jadwal/' . $m->kode) }}"
                                            class="btn btn-icon btn-light btn-hover-success btn-sm">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        @if (empty($kunci[0]))
            {{-- alert segara lakukan pembayaran --}}
            <div class="alert alert-danger d-flex align-items-center container" role="alert">
                <i class="fas fa-lock" style="margin-right: 2%; font-size: 24px;"></i>
                <div>
                    <p class="card-text">
                        Maaf, kami ingin mengingatkan bahwa ada keterlambatan dalam pembayaran SPP bulan
                        {{ $kunci[1] }} tahun ajaran
                        {{ $kunci[2] }}. Kami mohon untuk segera melakukan pembayaran.
                    </p>
                </div>
                
            </div>
            {{-- alert segara lakukan pembayaran --}}
        @elseif($kunci[0]->deskripsi == 'Belum Lunas')
            {{-- alert segara lakukan pembayara --}}
            <div class="alert alert-danger d-flex align-items-center container" role="alert">
                <i class="fas fa-lock" style="margin-right: 2%; font-size: 24px;"></i>
                <div>
                    <p class="card-text">
                        Maaf, kami ingin mengingatkan bahwa ada keterlambatan dalam pembayaran SPP bulan
                        {{ $kunci[1] }} tahun ajaran
                        {{ $kunci[2] }}. Kami mohon untuk segera melakukan pembayaran.
                    </p>
                </div>
                
            </div>
            {{-- alert segara lakukan pembayaran --}}
        @else
            <div class="">

                <div class="card card-custom">
                    <div class="table-responsive" id="isi_data">
                        <table class="table table-borderless table-vertical-center">
                            <thead>
                                <tr>
                                    <th class="p-0" style="width: 5%"></th>
                                    <th class="p-0" style="width: 70%"></th>
                                    <th class="p-0" style="width: 20%"></th>
                                    <th class="p-0" style="width: 5%"></th>
                                </tr>
                            </thead>
                            <div style="margin-bottom: 10px"></div>
                            <tbody>
                                @foreach ($mapel as $m)
                                    <tr>
                                        <td class="pl-0 py-4 align-middle">
                                            <div class="symbol symbol-45 symbol-light-success mr-2">
                                                <span class="symbol-label">
                                                    <span class="svg-icon svg-icon-2x svg-icon-success">
                                                        <i class="fas fa-book" style="margin-left: 15px"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="pl-0 align-middle">
                                            <a href="{{ asset('siswa/jadwal/' . $m->kode) }}"
                                                class="text-dark-75 font-weight-bolder text-hover-success mb-1 font-size-lg">{{ $m->nama }}
                                                ({{ $m->hari }} | {{ $m->kelas }} {{ $m->rombel }})
                                            </a>
                                            <span class="text-muted font-weight-bold d-block">Kelas {{ $m->kelas }}
                                                {{ $m->rombel }}</span>

                                            <span class="text-muted font-weight-bold">{{ $m->hari }} |
                                                {{ substr($m->waktu_mulai, 0, 5) }} WIB -
                                                {{ substr($m->waktu_selesai, 0, 5) }} WIB</span>
                                        </td>
                                        <td class="text-right pr-0 align-middle">
                                            <a href="{{ asset('siswa/jadwal/' . $m->kode) }}"
                                                class="btn btn-icon btn-light btn-hover-success btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif




    @endif
@endsection
