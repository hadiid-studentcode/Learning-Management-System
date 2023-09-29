@extends('layouts.main')

@section('main')
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    <h2>
                        <span style=" text-align: center; text-transform: uppercase;">
                            Data Raport Siswa
                        </span>
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div id="input" class="page">
        <div class="container" id="input">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <form action="{{ url('/guru/rekap-nilai/create') }}" method="get" id="siswaForm">
                        <div class="form-group row">
                            <label for="kelas" class="col-sm-2 col-form-label">Nama Siswa</label>
                            <div class="col-sm-10">
                                <select id="kelas" name="siswa" class="form-control" required>
                                    <option value="@if (isset($name_siswaSearch)) {{ $name_siswaSearch }} @endif" hidden>
                                        @if (isset($name_siswaSearch))
                                            {{ $name_siswaSearch }}
                                        @else
                                            Pilih Siswa
                                        @endif
                                    </option>
                                    @foreach ($siswa as $s)
                                        <option value="{{ $s->nama }}">{{ $s->nama }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="reportCardContainer">
            <div class="container">
                <div class="card card-custom gutter-b">

                        <div class="card-body" style="display: flex; flex-direction: column; align-items: flex-start;">
                            <div style="flex-grow: 1;"></div>

                            @if (isset($siswaSearch))
                                <table border="0" width="50%">
                                    <tr>
                                        <td>Nama</td>
                                        <td>:&nbsp;{{ $siswaSearch->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>NISN</td>
                                        <td>:&nbsp;{{ $siswaSearch->nisn }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kelas</td>
                                        <td>:&nbsp;{{ $siswaSearch->kelas }} {{ $siswaSearch->rombel }}</td>
                                    </tr>
                                    <tr>
                                        <td>Wali Kelas</td>
                                        <td>:&nbsp;{{ $siswaSearch->waliKelas }}</td>
                                    </tr>
                                </table>
                            @else
                            @endif
                        </div>
                        <div id="resultTable">
                            <div class="container">

                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Mata Pelajaran</th>
                                                <th scope="col">KKM</th>
                                                <th scope="col">Nilai</th>
                                                <th scope="col">Nilai Rata-rata</th>
                                                <th scope="col">Catatan Guru</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($rekapNilai))
                                                @foreach ($rekapNilai as $rk)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td class="subject-name">{{ $rk->mapel }}</td>
                                                        <td class="grade">{{ $rk->KKM }}</td>
                                                        <td>{{ $rk->nilai }}</td>
                                                        <td class="grade">{{ number_format($rk->rata_rata, 1, '.', '') }}
                                                        </td>
    
                                                        @php
                                                            $catatanValue = '';
                                                            foreach ($rekapNilaiAkhir as $rna) {
                                                                foreach ($rna as $rn) {
                                                                    if ($rn->id_siswa == $rk->id_siswa && $rn->id_mapel == $rk->id_mapel) {
                                                                        $catatanValue = $rn->catatan;
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        @endphp
    
    
                                                        <td>
                                                            <form action="{{ url('guru/rekap-nilai/') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="id_mapel"
                                                                    value="{{ $rk->id_mapel }}">
                                                                <input type="hidden" name="id_siswa"
                                                                    value="{{ $rk->id_siswa }}">
                                                                <input type="hidden" name="total_nilai"
                                                                    value="{{ $rk->nilai }}">
                                                                <input type="hidden" name="rata_rata"
                                                                    value="{{ number_format($rk->rata_rata, 1, '.', '') }}">
                                                                @if ($catatanValue)
                                                                 <input type="hidden" name="update"
                                                                    value="update_data">
                                                                    <textarea class="form-control" type="text" name="catatan" rows="3">{{ $catatanValue }}</textarea>
                                                                @else
                                                                    <textarea class="form-control" type="text" name="catatan" rows="3"></textarea>
                                                                @endif
                                                        </td>
                                                        <td>
                                                            <button type="submit" class="btn btn-success">Simpan</button>
                                                        </td>
                                                        </form>
                                                    </tr>
                                                @endforeach
                                            @else
                                            @endif
                                        </tbody>
                                    </table>
                                  </div>
 
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function showReportCard() {
                var selectedClass = document.getElementById("kelas").value;
                if (selectedClass !== "") {
                    var reportCardContainer = document.getElementById("reportCardContainer");
                    reportCardContainer.style.display = "block";
                } else {
                    $('#kelasModal').modal('show');
                }
            }
        </script>
    </div>



@endsection
