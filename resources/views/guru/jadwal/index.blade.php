@extends('layouts.main')

@section('main')


<div class="">
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <h3 class="mb-2">Halaman Kelas</h3>

            <form action="{{ url('/guru/jadwal/create') }}" method="get">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-xl-12">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-md-0 mb-2">
                                <div class="d-flex align-items-center">
                                    <select name="tahun_ajaran" class="form-control" id='tahun_ajaran'>
                                        <option value="" selected="selected">Pilih Tahun Ajaran
                                        </option>
                                        @foreach ($tahunAjaran as $th)
                                            <option value="{{ $th->tahun_ajaran }}">{{ $th->tahun_ajaran }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 my-md-0">
                                <div class="d-flex align-items-center">
                                    <select class="form-control" name="hari" id='hari'>
                                        <option value="" selected="selected" hidden>Pilih Hari
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

        </form>

        </div>
    </div>
</div>



    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="table-responsive" id="isi_data" >
                            <table class="table table-borderless table-vertical-center">
                                <thead>
                                    <tr>
                                        <th class="" style="width: 5%"></th>
                                        <th class="" style="width: 70%"></th>
                                        <th class="" style="width: 20%"></th>
                                        <th class="" style="width: 5%"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($kelas as $k)
                                        <tr>
                                            <td class="pl-0 py-4 align-middle">
                                                <div class="symbol symbol-45 symbol-light-success mr-2">
                                                    <span class="symbol-label">
                                                        <span class="svg-icon svg-icon-2x svg-icon-success">
                                                            <i class="fas fa-book"></i> 
                                                        </span>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="pl-0 align-middle">
                                                <a href="{{ asset('guru/jadwal/' . $k->kode) }}"
                                                    class="text-dark-75 font-weight-bolder text-hover-success mb-1 font-size-lg">{{ $k->nama }}
                                                    ({{ $k->hari }} | {{ $k->kelas }} {{ $k->rombel }})
                                                </a>
                                                <span class="text-muted font-weight-bold d-block">Kelas {{ $k->kelas }}
                                                    {{ $k->rombel }}</span>
                                                {{-- <div>
                                                <span class="text-muted font-weight-bold">Materi:</span>
                                                <span class="font-weight-bold text-danger ml-1">Pantun</span>
                                            </div> --}}
                                                <span class="text-muted font-weight-bold">{{ $k->hari }} |
                                                    {{ substr($k->waktu_mulai, 0, 5) }} WIB - {{ substr($k->waktu_selesai, 0, 5) }} WIB</span>
                                            </td>
                                            <td class="text-right pr-0 align-middle">
                                                <a href="{{ asset('guru/jadwal/' . $k->kode) }}"
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
            </div>
        </div>
    </div>
@endsection
