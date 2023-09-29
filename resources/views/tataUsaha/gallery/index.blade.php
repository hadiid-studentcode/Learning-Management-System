@extends('layouts.main')

@section('main')

        <div class="">
            <div class="card card-custo  gutter-b">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center">
                        <h2 class="text-dark-75 text-hover-success font-size-h1">Data Gallery Siswa</h2>
                        <p class="text-dark-50 mt-2" style="text-align: center;">Silakan Masukkan atau edit Gallery Siswa di bawah ini.</p>
                    </div>
                </div>
            </div>
        </div>



        {{-- DONE --}}


        <div class="" style="width:auto;">
            <div class="card card-custom" id="data_pertemuan">
                <div class="card-body">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
                            <li class="nav-item mr-3">
                                <a class="nav-link active" data-toggle="tab" href="#kt_user_edit_tab_1"
                                    onclick="showPage('input')">
                                    <span class="nav-icon">
                                        <span class="svg-icon mr-3"></span>
                                        <svg width="25px" height="25x" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M19.5001 8.27355C19.5035 8.46127 19.4015 8.6351 19.236 8.72365L16.5982 10.1343L19.2196 11.4146C19.3883 11.497 19.4966 11.667 19.5001 11.8547C19.5035 12.0424 19.4015 12.2163 19.236 12.3048L16.598 13.7156L19.2195 14.9959C19.3882 15.0783 19.4966 15.2483 19.5 15.436C19.5035 15.6237 19.4015 15.7976 19.2359 15.8861L12.7074 19.3775C12.2655 19.6139 11.7346 19.6139 11.2927 19.3775L4.7642 15.8861C4.59864 15.7976 4.49663 15.6237 4.50008 15.436C4.50354 15.2483 4.61186 15.0783 4.78057 14.9959L7.40214 13.7156L4.76426 12.3048C4.59869 12.2163 4.49669 12.0424 4.50014 11.8547C4.50359 11.667 4.61192 11.497 4.78063 11.4146L7.40205 10.1343L4.76426 8.72365C4.59869 8.6351 4.49669 8.46127 4.50014 8.27355C4.50359 8.08582 4.61192 7.91586 4.78063 7.83346L11.3418 4.62897C11.7572 4.42609 12.243 4.42609 12.6584 4.62897L19.2196 7.83346C19.3883 7.91586 19.4966 8.08582 19.5001 8.27355ZM8.4898 14.2972L6.09799 15.4654L11.7643 18.4957C11.9116 18.5745 12.0885 18.5745 12.2358 18.4957L17.9021 15.4654L15.5104 14.2973L12.7075 15.7962C12.2655 16.0326 11.7347 16.0326 11.2927 15.7962L8.4898 14.2972ZM12.7075 12.2151L15.5105 10.716L17.9022 11.8841L12.2359 14.9144C12.0886 14.9932 11.9116 14.9932 11.7643 14.9144L6.09804 11.8841L8.48971 10.716L11.2927 12.2151C11.7347 12.4514 12.2655 12.4514 12.7075 12.2151ZM17.9022 8.30293L12.2195 5.52753C12.0811 5.4599 11.9191 5.4599 11.7807 5.52753L6.09804 8.30293L11.7643 11.3332C11.9116 11.412 12.0886 11.412 12.2359 11.3332L17.9022 8.30293Z"
                                                fill="#47495F" />
                                        </svg>
                                        <span class="nav-text font-size-lg">Input Gallery</span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item mr-3">
                                <a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_nilai"
                                    onclick="showPage('gallery')">
                                    <span class="nav-icon">
                                        <span class="svg-icon mr-3"></span>
                                        <svg width="25px" height="25x" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M19.5001 8.27355C19.5035 8.46127 19.4015 8.6351 19.236 8.72365L16.5982 10.1343L19.2196 11.4146C19.3883 11.497 19.4966 11.667 19.5001 11.8547C19.5035 12.0424 19.4015 12.2163 19.236 12.3048L16.598 13.7156L19.2195 14.9959C19.3882 15.0783 19.4966 15.2483 19.5 15.436C19.5035 15.6237 19.4015 15.7976 19.2359 15.8861L12.7074 19.3775C12.2655 19.6139 11.7346 19.6139 11.2927 19.3775L4.7642 15.8861C4.59864 15.7976 4.49663 15.6237 4.50008 15.436C4.50354 15.2483 4.61186 15.0783 4.78057 14.9959L7.40214 13.7156L4.76426 12.3048C4.59869 12.2163 4.49669 12.0424 4.50014 11.8547C4.50359 11.667 4.61192 11.497 4.78063 11.4146L7.40205 10.1343L4.76426 8.72365C4.59869 8.6351 4.49669 8.46127 4.50014 8.27355C4.50359 8.08582 4.61192 7.91586 4.78063 7.83346L11.3418 4.62897C11.7572 4.42609 12.243 4.42609 12.6584 4.62897L19.2196 7.83346C19.3883 7.91586 19.4966 8.08582 19.5001 8.27355ZM8.4898 14.2972L6.09799 15.4654L11.7643 18.4957C11.9116 18.5745 12.0885 18.5745 12.2358 18.4957L17.9021 15.4654L15.5104 14.2973L12.7075 15.7962C12.2655 16.0326 11.7347 16.0326 11.2927 15.7962L8.4898 14.2972ZM12.7075 12.2151L15.5105 10.716L17.9022 11.8841L12.2359 14.9144C12.0886 14.9932 11.9116 14.9932 11.7643 14.9144L6.09804 11.8841L8.48971 10.716L11.2927 12.2151C11.7347 12.4514 12.2655 12.4514 12.7075 12.2151ZM17.9022 8.30293L12.2195 5.52753C12.0811 5.4599 11.9191 5.4599 11.7807 5.52753L6.09804 8.30293L11.7643 11.3332C11.9116 11.412 12.0886 11.412 12.2359 11.3332L17.9022 8.30293Z"
                                                fill="#47495F" />
                                        </svg>
                                        <span class="nav-text font-size-lg">Gallery</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div id="input" class="page">
            <div class="" id="input">

                <div class="card card-success" style="height: ">
                    <div class="card-header">
                        <h3 class="card-title">Input Gallery Siswa</h3>
                    </div>

                    <form id="tata-usaha" action="{{ asset('/tata-usaha/gallery') }}" method="post"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Nama Kegiatan</label>
                                <input type="text" class="form-control" name="nama_kegiatan" value=""
                                    placeholder="Nama Kegiatan" required>
                            </div>

                            <div class="form-group">
                                <label for="agama">Jenis Kegiatan</label>
                                <select class="form-control" id="kegiatan" name="jenis_kegiatan" required>
                                    <option value="" hidden>pilih jenis kegiatan</option>
                                    <option value="Akademik">Akademik</option>
                                    <option value="Non Akademik">Non Akademik</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="keterangan">Deskripsi Kegiatan</label>
                                <textarea class="form-control" cols="10" rows="3" name="deskripsi_kegiatan" placeholder="Keterangan"
                                    required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="tempatlahir">Tempat Kegiatan</label>
                                <input type="text" class="form-control" id="tempatlahir" name="tempat_kegiatan"
                                    placeholder="Tempat" value="" required>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Kegiatan</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_kegiatan"
                                    value="" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Input Foto Kegiatan</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" onchange="showFileName(event)"
                                            class="custom-file-input" id="exampleInputFile" name="foto_kegiatan"
                                            required>
                                        <label class="custom-file-label" for="exampleInputFile" id="file-label">

                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div id="preview-" style="display: none;">
                                <img id="preview-image" class="img-fluid" width="70%" src="#" alt="Preview">
                            </div>

                            <script>
                                function showFileName(event) {
                                    var input = event.target;
                                    var fileName = input.files[0].name;
                                    document.getElementById("file-label").textContent = fileName;

                                    var preview = document.getElementById("preview-");
                                    var previewImage = document.getElementById("preview-image");
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function(e) {
                                            previewImage.src = e.target.result;
                                        };

                                        preview.style.display = "block";
                                        reader.readAsDataURL(input.files[0]);
                                    } else {
                                        preview.style.display = "none";
                                    }
                                }
                            </script>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="button" class="btn btn-secondary" onclick="resetForm()">Batal</button>
                        </div>

                        <script>
                            function resetForm() {
                                document.querySelectorAll('input[type="text"]').forEach(function(input) {
                                    input.value = '';
                                });

                                document.querySelectorAll('input[type="date"]').forEach(function(input) {
                                    input.value = '';
                                });

                                document.querySelectorAll('select').forEach(function(select) {
                                    select.selectedIndex = 0;
                                });

                                var fileInput = document.getElementById('exampleInputFile');
                                fileInput.value = '';
                                var fileLabel = document.getElementById('file-label');
                                fileLabel.textContent = '';

                                var preview = document.getElementById('preview-');
                                preview.style.display = 'none';
                                var previewImage = document.getElementById('preview-image');
                                previewImage.src = '#';
                            }
                        </script>

                    </form>
                </div>

            </div>
        </div>

        <div id="gallery" class="page" style="display: none;">
            <div class=" border rounded p-3">
                <main role="main">
                    <section class="text-center">
                        <div class="">
                            <h4>Foto yang Sudah di Input</h4>
                        </div>
                        <hr>
                    </section>
                    <section class="text-center">
                        <div class="album py-5">
                            <div class="">
                                <div class="row">


                                    @foreach ($gallery as $g)
                                        <div class="col-md-4">
                                            <div class="card mb-4 shadow-sm">
                                                <a href="#" data-toggle="modal"
                                                    data-target="#imageModal_{{ $g->id }}">
                                                    <img style="object-fit: cover; height: 400px; width: 100%;"
                                                        src="{{ asset('storage/gallery/' . $g->foto) }}"
                                                        class="card-img-top img-fluid" alt="Lomba 1">
                                                </a>

                                                <form id="deleteForm{{ $g->id }}"
                                                    action="{{ asset('tata-usaha/gallery/' . $g->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="card-body">
                                                        <p class="card-text">{{ $g->deskripsi }}</p>
                                                        <button type="button" class="btn btn-danger deleteButton"
                                                            data-toggle="modal"
                                                            data-target="#confirmDeleteModal{{ $g->id }}">Hapus</button>
                                                    </div>
                                                </form>


                                            </div>
                                        </div>

                                        {{-- modal hapus --}}
                                        <div class="modal fade" id="confirmDeleteModal{{ $g->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="confirmDeleteModal{{ $g->id }}Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="confirmDeleteModal{{ $g->id }}Label">Konfirmasi
                                                            Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus foto ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="deleteForm({{ $g->id }})">Hapus</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- modal end --}}


                                        <script>
                                            function deleteForm(id) {
                                                var form = document.getElementById('deleteForm' + id);
                                                form.submit();
                                            }
                                        </script>


                                        {{-- Modal Start --}}
                                        <div class="modal fade" id="imageModal_{{ $g->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="imageModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content" style="width: 100%; height: 100%;">
                                                    <div class="modal-body">
                                                        <img src="{{ asset('storage/gallery/' . $g->foto) }}"
                                                            class="img-fluid" alt="Lomba 1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Modal End --}}
                                    @endforeach

                                    <script>
                                        function closePopup() {
                                            var popup = document.querySelector('.popup');
                                            document.body.removeChild(popup);
                                        }
                                    </script>

                                </div>
                            </div>
                        </div>
                    </section>
                </main>
                <footer class="text-muted border-top pt-3 mt-4">
                    <div class="">
                        <p class="float-right">
                            <a href="#" onclick="scrollToTop(); return false;"><i class="fas fa-arrow-up"></i></a>
                        </p>
                        <p>Album Foto SIMU Kampa &copy; 2023</p>
                    </div>
                </footer>
            </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
            <script>
                function scrollToTop() {
                    const duration = 500;
                    const start = window.pageYOffset;
                    const startTime = 'now' in window.performance ? performance.now() : new Date().getTime();

                    const scroll = function() {
                        const currentTime = 'now' in window.performance ? performance.now() : new Date().getTime();
                        const timeElapsed = currentTime - startTime;
                        const run = ease(timeElapsed, start, -start, duration);
                        window.scrollTo(0, run);
                        if (timeElapsed < duration) {
                            requestAnimationFrame(scroll);
                        }
                    };

                    const ease = function(t, b, c, d) {
                        // Fungsi animasi (Easing function)
                        t /= d / 2;
                        if (t < 1) return c / 2 * t * t + b;
                        t--;
                        return -c / 2 * (t * (t - 2) - 1) + b;
                    };

                    requestAnimationFrame(scroll);
                }
            </script>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var currentPage = sessionStorage.getItem("currentPage");
                if (currentPage) {
                    showPage(currentPage);
                } else {
                    showPage("input");
                }
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
                sessionStorage.setItem("currentPage", pageId);
            }
        </script>
    @endsection
