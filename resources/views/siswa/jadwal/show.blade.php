@extends('layouts.main')

@section('main')
    <div class="">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="d-flex mr-3">
                    <h2 href="#" class="text-dark-75 text-hover-success font-size-h1 mr-3">{{ $mapel->nama }} |
                        {{ $mapel->hari }}
                    </h2>
                </div>
                <hr>

                <table style="width:100%;">
                    <tbody>
                        <tr>
                            <td style="width: 20%">Kelas</td>
                            <td style="width: 80%">: <b>{{ $mapel->kelas }} {{ $mapel->rombel }}</b></td>
                        </tr>
                        <tr>
                            <td>Kode </td>
                            <td>: <b>{{ $mapel->kode }} </b></td>
                        </tr>
                        <tr>
                            <td>Jadwal</td>
                            <td>: <b>{{ $mapel->hari }}, {{ substr($mapel->waktu_mulai, 0, 5) }} WIB s/d {{ substr($mapel->waktu_selesai, 0, 5)}} WIB</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="">
        <div class="card card-custom" id="data_pertemuan">
            <div class="card-body">
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_user_edit_tab_1"
                                onclick="showPage('pertemuan')">
                                <span class="nav-icon">
                                    <span class="svg-icon">
                                        <i class="fas fa-layer-group"></i>
                                    </span>
                                    <span class="nav-text font-size-lg">Pertemuan</span>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_nilai"
                                onclick="showPage('nilai')">
                                <span class="nav-icon">
                                    <span class="svg-icon">
                                        <i class="fas fa-layer-group"></i>
                                    </span>
                                    <span class="nav-text font-size-lg">Data Nilai</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="pertemuan" class="page">
        <div class="">
            <div class="card card-custom gutter-b">
                <div class="card-body">

                    <table class="table table-borderless table-vertical-center">
                        <tbody>
                            @foreach ($pertemuan as $p)
                                @if ($p->nama_materi == true && $p->tanggal_materi == true)
                                    <tr>
                                        <td class="pl-0">
                                            <h5 style="color: rgba(20, 103, 236, 0.884)"
                                                class="text-dark-75 font-weight-bolder text-hover-success mb-1 font-size-lg">
                                                MINGGU KE-{{ $loop->iteration }}
                                            </h5>
                                            <div>
                                                <span class="font-weight-bolder">Materi :</span>
                                                <a class="text-muted font-weight-bold text-hover-success"
                                                    style="color: #F00 !important;">{{ $p->nama_materi }}</a>
                                            </div>
                                            <div>
                                                <span class="font-weight-bolder">Tanggal Pertemuan :</span>
                                                <a class="text-muted font-weight-bold text-hover-success"
                                                    style="color: #F00 !important;">{{ $tanggal }}
                                            </div>
                                        </td>
                                        <td class="text-right pr-0">
                                            <a href="{{ url('/siswa/jadwal/cek/' . $mapel->kode . '-' . $p->id) }}"
                                                class="btn btn-icon btn-light btn-hover-success btn-sm mx-3">
                                                <span class="svg-icon svg-icon-md svg-icon-success">
                                                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24"
                                                                height="24">
                                                            </rect>
                                                            <path
                                                                d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)">
                                                            </path>
                                                            <path
                                                                d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                                fill="#000000" fill-rule="nonzero" opacity="0.3">
                                                            </path>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                @else
                                @endif
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    </div>

    <div id="nilai" class="page" style="display: none;">
        <div class="">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show px-7 active" id="kt_user_edit_tab_1" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-borderless  table-vertical-center">
                                    <tbody>
                                        @foreach ($tugas as $t)
                                            <tr>
                                                <td class="pl-0"><a href="#"
                                                        class="text-dark-75 font-weight-bolder text-hover-success mb-1 font-size-lg">
                                                        Minggu Ke: {{ $t->pertemuan_ke }}</a>
                                                    <hr>
                                                    <div>
                                                        <span class="font-weight-bolder">Nilai :</span>
                                                        <a class="text-muted font-weight-bold text-hover-success"
                                                            href="#" style="color: #F00 !important;">{{ $t->nilai }}</a>
                                                    </div>
                                                    <hr>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            showPage("pertemuan");
        });

        function showPage(pageId) {
            var pages = document.getElementsByClassName("page");
            for (var i = 0; i < pages.length; i++) {
                if (pages[i].id === pageId) {
                    pages[i].style.display = "block";
                } else {
                    pages[i].style.display = "none";
                }
            }
        }
    </script>

    <div class=" d-flex justify-content-center mt-3">
        <a href="{{ url('/siswa/jadwal') }}" class="btn btn-success w-100">Kembali</a>
    </div>
@endsection
