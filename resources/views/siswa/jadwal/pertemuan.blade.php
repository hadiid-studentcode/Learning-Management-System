@extends('layouts.main')

@section('main')
    <div class="container">
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
                            <td>Kode Mapel</td>
                            <td>: <b>{{ $mapel->kode }} </b></td>
                        </tr>
                        <tr>
                            <td>Hari, Jam Mulai s/d Selesai</td>
                            <td>: <b>{{ $mapel->hari }}, {{ substr($mapel->waktu_mulai, 0, 5) }} WIB s/d
                                    {{ substr($mapel->waktu_mulai, 0, 5) }} WIB</b></td>
                        </tr>
                        <tr>
                            <td>Minggu Ke</td>
                            <td>: <b>{{ $pertemuan->pertemuan_ke }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="card card-custom" id="data_pertemuan">
            <div class="card-body">
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
                        <li class="nav-item mr-3">
                            <a class="nav-link active" data-toggle="tab" href="#kt_user_edit_tab_1"
                                onclick="showPage('materi')">
                                <span class="nav-icon">
                                    <span class="svg-icon mr-3">
                                         <i class="fas fa-layer-group"></i>
                                    </span>
                                    <span class="nav-text font-size-lg">Materi Pertemuan</span>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_nilai"
                                onclick="showPage('nilai')">
                                <span class="nav-icon">
                                    <span class="svg-icon mr-3">
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

    <div id="materi" class="page">
        <div class="container" id="materi">
            <div class="row">
                <div class="col-md-6">
                    <div class="h-100 p-5 bg-white border rounded-3 shadow">

                        <h2>Materi : {{ $pertemuan->nama_materi }}</h2>
                        <p>

                            @php
                                $htmlString = $pertemuan->deskripsi_materi;
                                $plainString = htmlspecialchars_decode($htmlString);
                                
                                echo $plainString;
                            @endphp



                        </p>

                        @if (!empty($pertemuan->file_materi))
                            <a href="{{ asset('storage/guru/materi/' . $pertemuan->file_materi) }}" target="_blank">
                                <button type="button" class="btn btn-success">Lihat Materi</button>
                            </a>
                        @endif


                    </div>
                </div>

                {{-- jika ada tugas --}}

                @if (($pertemuan->nama_tugas && $pertemuan->deskripsi_tugas) || $pertemuan->file_tugas)
                    <div class="col-md-6">
                        <div class="h-100 p-5 bg-white border rounded-3 shadow">
                            <h2>TUGAS : {{ $pertemuan->nama_tugas }}</h2>
                            <p>



                                @php
                                    $htmlString = $pertemuan->deskripsi_tugas;
                                    $plainString = htmlspecialchars_decode($htmlString);
                                    
                                    echo $plainString;
                                @endphp



                            </p>

                            @if (!$tugas)
                                @if (date('Y-m-d H:i:s') < $pertemuan->tanggal_tugas)
                                @else
                                    <p>Terlambat</p>
                                @endif


                                <p>Waktu Batas Pengumpulan Tugas : {{ $pertemuan->tanggal_tugas }}</p>




                                <form action="{{ url('/siswa/jadwal/cek/tugas/' . $kode) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="tanggal_tugas" value="{{ $pertemuan->tanggal_tugas }}">

                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="fileInput"
                                                accept=".jpg, .png, .pdf" onchange="validateFile(this)" / required
                                                name="file_tugas">
                                            <label class="custom-file-label" for="fileInput">Pilih File</label>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="row">
                                            @if($pertemuan->file_tugas)
                                            <div class="col-md-6">
                                                <a href="{{ asset('storage/guru/tugas/' . $pertemuan->file_tugas) }}"
                                                    target="_blank" class="btn btn-success btn-block">Lihat Tugas</a>
                                            </div>
                                            @endif
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-success btn-block">Submit</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>


                                <script>
                                    document.getElementById('fileInput').addEventListener('change', function() {
                                        validateFile(this);
                                        updateFileName(this);
                                    });

                                    function validateFile(fileInput) {
                                        const maxSize = 5 * 1024 * 1024;
                                        const file = fileInput.files[0];

                                        if (file.size > maxSize) {
                                            alert('Ukuran file terlalu besar. Maksimal 5 MB.');
                                            fileInput.value = '';
                                        }
                                    }

                                    function updateFileName(fileInput) {
                                        const label = fileInput.nextElementSibling;
                                        const fileName = fileInput.value.split('\\').pop();

                                        if (fileName) {
                                            label.textContent = fileName;
                                        } else {
                                            label.textContent = 'Pilih File';
                                        }
                                    }
                                </script>
                            @else
                                <label for="tugas">Tugas Sudah Dikirim ({{ $tugas->status }})</label>
                                @if ($tugas->nilai)
                                    <p>Nilai : <b class="text-danger">{{ $tugas->nilai }}</b></p>
                                @endif
                                <div class="input-group">
                                    <input type="text" class="form-control" id="tugas" readonly
                                        value="{{ substr($tugas->file_tugas, strpos($tugas->file_tugas, "-") + 1) }}">
                                    <div class="input-group-append">
                                        <a href="{{ asset('storage/siswa/tugas/' . $tugas->file_tugas) }}" target="_blank"
                                            class="btn btn-outline-secondary" type="button" id="viewButton">Lihat
                                            Tugas</a>
                                    </div>
                                </div>
                            @endif




                        </div>
                    </div>

                    {{-- jika tidak ada tugas --}}
                @else
                    <div class="col-md-6">
                        <div class="h-100 p-5 bg-white border rounded-3 shadow">
                            <h2>TUGAS : Tidak Ada Tugas </h2>



                        </div>
                    </div>
                @endif
            </div>

            <style>
                .video-container {
                    position: relative;
                    overflow: hidden;
                    padding-top: 56.25%;
                    /* Aspek rasio video 16:9 (9 / 16 * 100) */
                }

                .video-container iframe {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                }
            </style>

            <script>
                // Function to handle comment submission
                function submitComment() {
                    // Get input values
                    var name = document.getElementById("name").value;
                    var comment = document.getElementById("comment").value;

                    // Create comment element
                    var commentElement = document.createElement("div");
                    commentElement.classList.add("comment");
                    commentElement.innerHTML = "<strong>" + name + "</strong>: " + comment;

                    // Add comment to comments list
                    var commentsList = document.getElementById("comments-list");
                    commentsList.appendChild(commentElement);

                    // Reset form fields
                    document.getElementById("name").value = "";
                    document.getElementById("comment").value = "";
                }

                // Add event listener to comment form submission
                document.getElementById("comment-form").addEventListener("submit", function(event) {
                    event.preventDefault();
                    submitComment();
                });
            </script>
        </div>
    </div>

    <div id="nilai" class="page" style="display: none;">
        <div class="container" id="nilai">
            <div class="custom-div border rounded p-4">
                <a href="#" class="text-dark-75 font-weight-bolder text-hover-success mb-1 font-size-lg">
                    Minggu Ke: {{ $pertemuan->pertemuan_ke }}
                </a>
                <hr>
                <div>
                    <span class="font-weight-bolder">Nilai :</span>
                    <a href="#" class="text-muted font-weight-bold text-hover-success"
                        style="color: #F00 !important;">

                        @if ($tugas)
                            {{ $tugas->nilai }}
                        @endif


                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            showPage("materi");
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
@endsection
