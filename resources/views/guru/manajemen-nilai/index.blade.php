@extends('layouts.main')

@section('main')
    <div class="">
        <div class="card card-custom">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    <h2 class="text-dark-75 text-center">Management Nilai Siswa</h2>
                    <p class="text-dark-50 text-center">Silakan cek semua nilai siswa yang ada di kelas mengajar Anda sebelum
                        dikirim ke wali kelas</p>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="card card-custom">
            <div class="card-body">
                <form action="{{ url('/guru/manajemen-nilai/search') }}" method="GET" id="myForm">
                    <div class="form-group">
                        <label for="kelas">Pilih Kelas:</label>
                        <select class="form-control" id="kelas" name="kelas" required>
                            @php
                                if (isset($selectKelas)) {
                                    $resultKelas = explode('-', $selectKelas);
                                }
                            @endphp
                            <option value="@if (isset($selectKelas)) {{ $selectKelas }}@else @endif" hidden>
                                @if (isset($selectKelas))
                                    {{ $resultKelas[0] }} {{ $resultKelas[1] }}
                                @else
                                    Pilih Kelas
                                @endif
                            </option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->kelas }}-{{ $k->rombel }}">{{ $k->kelas }}
                                    {{ $k->rombel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mataPelajaran">Pilih Mata Pelajaran:</label>
                        <select class="form-control" id="mataPelajaran" name="mapel" required>
                            @php
                                if (isset($selectMapel)) {
                                    $resultMapel = explode('-', $selectMapel);
                                }
                            @endphp
                            <option value="@if (isset($selectMapel)) {{ $selectMapel }}@else @endif" hidden>
                                @if (isset($selectMapel))
                                    {{ $resultMapel[0] }} | {{ $resultMapel[1] }}
                                @else
                                    Pilih Mata Pelajaran
                                @endif
                            </option>
                            @foreach ($mapel as $m)
                                <option value="{{ $m->nama }}-{{ $m->hari }}">{{ $m->nama }} |
                                    {{ $m->hari }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="text-align: center">
                        <thead>
                            <tr>
                                <th colspan="5">
                                    <h5 class="text-center">Data Nilai Siswa</h5>
                                </th>
                            </tr>
                            <tr>
                                <th style="width: 5%">Nomor</th>
                                <th>Nama</th>
                                <th>Nisn</th>
                                <th>Kelas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($searchMapel))
                                @foreach ($searchMapel as $sm)
                                    <tr>
                                        <td class="small-column">{{ $loop->iteration }}</td>
                                        <td>{{ $sm->nama }}</td>
                                        <td>{{ $sm->nisn }}</td>
                                        <td>{{ $sm->kelas }} {{ $sm->rombel }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-success" data-toggle="modal"
                                                data-target="#lihatnilai_{{ $sm->id_siswa }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if (isset($searchMapel))
        @foreach ($searchMapel as $sm)
            <div class="modal fade" id="lihatnilai_{{ $sm->id_siswa }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="exampleModalLabel">Data Nilai {{ $sm->nama }}</h5>
                        </div>
                        <div class="modal-body">
                            @if (!empty($nilai))
                                <ul class="list-group">

                                    @php
                                        $total_nilai = 0;
                                        $jumlah_nilai = 0;
                                        $kkm = 0;
                                    @endphp
                                    @foreach ($nilai as $ni)
                                        @foreach ($ni as $n)
                                            @if ($n->id_siswa == $sm->id_siswa)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    Minggu {{ $n->pertemuan_ke }} Nilai: <span>{{ $n->nilai }}</span>

                                                    @php
                                                        $total_nilai += $n->nilai;
                                                        $jumlah_nilai++;
                                                        $kkm = $n->KKM;
                                                    @endphp
                                                </li>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </ul>
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            @if ($jumlah_nilai > 0)
                                                @php
                                                    $rata_rata = $total_nilai / $jumlah_nilai;
                                                    $kkm = $kkm;
                                                @endphp
                                                @if ($rata_rata > $kkm)
                                                    <p class="font-weight-bolder">Rata-rata nilai: <span>
                                                            {{ $rata_rata }}</span>
                                                    </p>
                                                @else
                                                    <p class="font-weight-bolder">Rata-rata nilai: <span
                                                            class=" text-red">{{ $rata_rata }}</span>
                                                    </p>
                                                @endif
                                            @else
                                                <p>Rata-rata nilai:</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editModal = document.getElementById("editModal");
            const saveEditButton = document.getElementById("saveEditButton");

            saveEditButton.addEventListener("click", function() {
                editModal.modal("hide");
            });
        });
    </script>
@endsection
