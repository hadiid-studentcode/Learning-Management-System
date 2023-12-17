<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sistem HAMKA BS</title>
    <link rel="stylesheet" href="{{ asset('Assets/dist/bootstrap/css/home.bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('Assets/dist/bootstrap/fonts/font-awesome.min.css') }}">
    <link rel="icon" href="{{ asset('Assets/images/iconfile.png') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="54">

    <style>
        body {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
            font-family: 'Inter', sans-serif;
        }

        section {
            min-height: 100vh;
        }

        .masthead {
            position: relative;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .overlay {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .navbar {
            transition: background-color 0.3s ease;
        }

        .navbar-shrink {
            background-color: rgba(0, 0, 0, 0.9) !important;
        }

        .intro-text {
            position: relative;
            z-index: 2;
        }

        .intro-lead-in,
        .intro-heading {
            color: #fff;
        }

        .btn.btn-xl {
            color: #fff;
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        @media (max-width: 992px) {
            .navbar-expand-lg .navbar-nav .nav-link {
                padding-right: 0.5rem;
                padding-left: 0.5rem;
            }
        }
    </style>


    <!-- Halaman Awal Start -->
    <nav class="navbar  navbar-expand-lg fixed-top" id="mainNav" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="container">
            <style>
                .navbar-brand:hover {
                    color: green;
                }
            </style>

            <a class="navbar-brand" href="#page-top" style="color: white">HAMKA BS</a>

            <button data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                class="navbar-toggler navbar-toggler-right" type="button" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto text-uppercase">
                    <li class="nav-item">
                        <a class="nav-link" href="#page-top"
                            onmouseover="this.querySelector('p').style.color = 'green';"
                            onmouseout="this.querySelector('p').style.color = 'white';">
                            <p style="color: white;">Beranda</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#definisi"
                            onmouseover="this.querySelector('p').style.color = 'green';"
                            onmouseout="this.querySelector('p').style.color = 'white';">
                            <p style="color: white;">Definisi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#unggul" onmouseover="this.querySelector('p').style.color = 'green';"
                            onmouseout="this.querySelector('p').style.color = 'white';">
                            <p style="color: white;">Keunggulan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#login" onmouseover="this.querySelector('p').style.color = 'green';"
                            onmouseout="this.querySelector('p').style.color = 'white';">
                            <p style="color: white;">Login</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#ppdb" onmouseover="this.querySelector('p').style.color = 'green';"
                            onmouseout="this.querySelector('p').style.color = 'white';">
                            <p style="color: white;">PPDB</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#galeri" onmouseover="this.querySelector('p').style.color = 'green';"
                            onmouseout="this.querySelector('p').style.color = 'white';">
                            <p style="color: white;">galeri</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak" onmouseover="this.querySelector('p').style.color = 'green';"
                            onmouseout="this.querySelector('p').style.color = 'white';">
                            <p style="color: white;">Kontak</p>
                        </a>
                    </li>
                </ul>
            </div>

            <script>
                (function() {
                    "use strict"; // Start of use strict

                    var mainNav = document.querySelector('#mainNav');

                    if (mainNav) {

                        var navbarCollapse = mainNav.querySelector('.navbar-collapse');

                        if (navbarCollapse) {

                            var collapse = new bootstrap.Collapse(navbarCollapse, {
                                toggle: false
                            });

                            var navbarItems = navbarCollapse.querySelectorAll('a');
                            for (var item of navbarItems) {
                                item.addEventListener('click', function(event) {
                                    collapse.hide();
                                });
                            }
                        }

                        var collapseNavbar = function() {

                            var scrollTop = (window.pageYOffset !== undefined) ? window.pageYOffset : (document
                                .documentElement || document.body.parentNode || document.body).scrollTop;

                            if (scrollTop > 100) {
                                mainNav.classList.add("navbar-shrink");
                            } else {
                                mainNav.classList.remove("navbar-shrink");
                            }
                        };
                        // Collapse now if page is not at top
                        collapseNavbar();
                        document.addEventListener("scroll", collapseNavbar);

                        // Hide navbar when modals trigger
                        var modals = document.querySelectorAll('.portfolio-modal');

                        for (var modal of modals) {

                            modal.addEventListener('shown.bs.modal', function(event) {
                                mainNav.classList.add('d-none');
                            });

                            modal.addEventListener('hidden.bs.modal', function(event) {
                                mainNav.classList.remove('d-none');
                            });
                        }
                    }

                })(); // End of use strict
            </script>

        </div>
    </nav>

    <header class="masthead" style="height: 100vh; background-image: url('{{ asset('Assets/images/cover2.jpg') }}');">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Halo Semuanya!</div>
                <div class="intro-heading text-uppercase">Selamat Datang di website SISTEM HAMKA BS</div>
            </div>
        </div>
        <div class="overlay"></div>
    </header>



    <style>
        .masthead {
            position: relative;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .overlay {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.5);
        }
    </style>
    <!-- Halaman Awal End -->

    <!-- Apa itu Sistem HAMKA BS -->
    <section id="definisi">
        <div class="container">
            <div class="container col-xxl-8">
                <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                    <div class="col-10 col-sm-8 col-lg-6">
                        <img src="{{ asset('Assets/images/tanya.png') }}" class="mx-lg-auto img-fluid"
                            alt="Bootstrap Themes" loading="lazy">
                    </div>
                    <div class="col-lg-6">
                        <h3 class="display-5 text-success">Apa Itu Sistem HAMKA BS?</h1>
                            <p class="lead">SIstem Hamka BS atau sistem muhammadiyah Kampa Boarding School adalah
                                sebuah Platform Website dibuat khusus untuk SD & SMP
                                Muhammadiyah Kampa, Yang berfungsi untuk Memudahkan Para Guru, Tata Usaha, Staff Pegawai
                                Bahkan Wali Murid dalam mengakses fitur - fitur sekolah.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Apa Itu Sistem HAMKA BS -->


    <!-- Halaman Keunggulan Start -->
    <section id="unggul" style="background-color: #F1F6F9;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="text-uppercase section-heading">Keunggulan Sistem HAMKA BS</h2>
                    <h3 class="text-muted section-subheading">Berikut adalah beberapa Keunggulan Sistem Sistem HAMKA BS
                    </h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-6 col-lg-3 mb-5">
                    <span class="fa-stack fa-4x mb-2">
                        <i class="fa fa-circle fa-stack-2x text-success"></i>
                        <i class="fa fa-book fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="section-heading">Materi Pembelajaran Interaktif</h4>
                    <p class="text-muted">Materi pembelajaran yang interaktif memungkinkan siswa untuk terlibat secara
                        aktif dalam
                        proses belajar dan memahami konten dengan lebih baik.</p>
                </div>
                <div class="col-md-6 col-lg-3 mb-5">
                    <span class="fa-stack fa-4x mb-2">
                        <i class="fa fa-circle fa-stack-2x text-success"></i>
                        <i class="fa fa-users fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="section-heading">Kolaborasi Siswa dan Guru</h4>
                    <p class="text-muted">Dalam Sistem HAMKA BS memungkinkan adanya kolaborasi yang lebih baik antara
                        siswa
                        dan guru
                        dalam proses pembelajaran, termasuk materi, tugas, dan nilai.</p>
                </div>
                <div class="col-md-6 col-lg-3 mb-5">
                    <span class="fa-stack fa-4x mb-2">
                        <i class="fa fa-circle fa-stack-2x text-success"></i>
                        <i class="fa fa-check-circle fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="section-heading">Pemantauan Progres Siswa</h4>
                    <p class="text-muted">Dengan menggunakan Sistem HAMKA BS, guru dapat memantau progres belajar siswa
                        secara
                        real-time dan memberikan bimbingan yang tepat.</p>
                </div>
                <div class="col-md-6 col-lg-3 mb-5">
                    <span class="fa-stack fa-4x mb-2">
                        <i class="fa fa-circle fa-stack-2x text-success"></i>
                        <i class="fa fa-calendar-check-o fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="section-heading">Penjadwalan yang Fleksibel</h4>
                    <p class="text-muted">Sistem HAMKA BS memungkinkan penjadwalan yang fleksibel, sehingga siswa dapat
                        mengatur waktu
                        belajar mereka sesuai dengan kebutuhan mereka.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Halaman Keunggulan End -->

   {{-- Login --}}
   <section id="login">
    <h2 class="text-center">Halaman Login</h2>
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-6">
                <div class="p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
                    <div class="p-3 p-lg-5 pt-lg-3">
                        <h3 class="display-6">Login Siswa</h3>
                        <br>
                        <p class="lead">Peran siswa dalam Sistem HAMKA BS dapat mengakses materi, ikuti tugas,
                            interaksi dengan guru & teman, terima umpan balik, amati kemajuan & nilai, akses sumber
                            belajar tambahan, serta berpartisipasi dalam evaluasi.</p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                            <a href="{{ url('/siswa') }}" target="blank"
                                class="btn btn-success btn-lg px-4 me-md-2">Login</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
                    <div class="p-3 p-lg-5 pt-lg-3">
                        <h3 class="display-6">Login Guru</h3>
                        <br>
                        <p class="lead">Peran guru dalam Sistem HAMKA BS memiliki fungsi-fungsi penting, seperti
                            mengelola materi, menyusun jadwal dan tugas, menilai siswa, berinteraksi dengan siswa
                            dan orang tua, dan mengamati kemajuan siswa.</p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                            <a href="{{ url('/guru') }}" target="blank"
                                class="btn btn-success btn-lg px-4 me-md-2">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-6">
                <div class="p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
                    <div class="p-3 p-lg-5 pt-lg-3">
                        <h3 class="display-6">Login Pegawai</h3>
                        <br>
                        <p class="lead">Peran pegawai dalam Sistem HAMKA BS memiliki fungsi-fungsi penting,
                            seperti
                            memberikan dukungan dalam penggunaan Sistem HAMKA BS, dan menghasilkan laporan dan
                            analisis,
                            serta mengatur komunikasi.</p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                            <a href="{{ url('/pegawai') }}" target="blank"
                                class="btn btn-success btn-lg px-4 me-md-2">Login</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
                    <div class="p-3 p-lg-5 pt-lg-3">
                        <h3 class="display-6">Login Wali Murid</h3>
                        <br>
                        <p class="lead">Peran wali murid dalam Sistem HAMKA BS fungsi-fungsinya seperti mengakses
                            informasi, memantau kemajuan belajar, berinteraksi dengan guru, dan terlibat dalam
                            proses pendidikan.</p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                            <a href="{{ url('/wali-murid') }}" target="blank"
                                class="btn btn-success btn-lg px-4 me-md-2">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
                    <div class="p-3 p-lg-5 pt-lg-3">
                        <h3 class="display-6">Login Tata Usaha</h3>
                        <br>
                        <p class="lead">Peran tata usaha dalam sistem Sistem HAMKA BS meliputi pengelolaan data
                            siswa
                            dan pegawai, administrasi akademik, jadwal pelajaran, absensi siswa, tugas dan ujian,
                            serta dukungan teknis dan pelatihan.</p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                            <a href="{{ url('/tata-usaha') }}" target="blank"
                                class="btn btn-success btn-lg px-4 me-md-2">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-lg-6">
    <div class="p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
    <div class="p-3 p-lg-5 pt-lg-3">
        <h3 class="display-6">Login Super User</h3>
        <br>
        <p class="lead">Peran Super user dalam Sistem HAMKA BS sangatlah penting yaitu pengelolaan sistem Sistem HAMKA BS, memberikan akses administrasi, pengaturan dan personalisasi, pelaporan dan analisis, serta dukungan dan pelatihan.</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
        <a href="{{ url('/super-user') }}" class="btn btn-success btn-lg px-4 me-md-2">Login</a>
        </div>
    </div>
    </div> --}}
</section>

   {{-- Login --}}

    {{-- PPDB --}}
    <section id="ppdb" style="background-color: #F1F6F9;">
        <div class="container">
            <div class="container ">
                <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                    <div class="col-10 col-sm-8 col-lg-6">
                        <img src="{{ asset('Assets/images/ppdb.png') }}" class="mx-lg-auto img-fluid"
                            alt="Gambar Ilustrasi" loading="lazy">
                    </div>
                    <div class="col-lg-6">
                        <h3 class="display-5 text-success">Penerimaan Peserta Didik Baru (PPDB)</h3>
                        <p class="lead">PPDB adalah proses penerimaan siswa baru di sekolah kami. Kami menyambut
                            calon siswa dengan antusias dan menyediakan proses pendaftaran yang mudah melalui sistem online.</p>
                        <a href="{{ url('/ppdb') }}" class="btn btn-success">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- PPDB --}}


    <section class="bg-light" id="galeri">
        <h2 class="text-center mb-5">Gallery Sekolah</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('Assets/images/gallery/Halaman.jpg') }}" alt="Photo 1"
                            class="img-fluid card-img-top" data-toggle="modal" data-target="#modalPhoto1">
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('Assets/images/gallery/sekolah.jpg') }}" alt="Photo 2"
                            class="img-fluid card-img-top" data-toggle="modal" data-target="#modalPhoto2">
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('Assets/images/gallery/sekolah2.jpg') }}" alt="Photo 3"
                            class="img-fluid card-img-top" data-toggle="modal" data-target="#modalPhoto3">
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('Assets/images/gallery/kejasama.jpg') }}" alt="Photo 4"
                            class="img-fluid card-img-top" data-toggle="modal" data-target="#modalPhoto4">
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('Assets/images/gallery/sekolah3.jpg') }}" alt="Photo 5"
                            class="img-fluid card-img-top" data-toggle="modal" data-target="#modalPhoto5">
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('Assets/images/gallery/lomba1.jpg') }}" alt="Photo 6"
                            class="img-fluid card-img-top" data-toggle="modal" data-target="#modalPhoto6">
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- Modal Start --}}

    <!-- Modal Photo 1 -->
    <div class="modal fade modal-lg" id="modalPhoto1" tabindex="-1" role="dialog"
        aria-labelledby="modalPhoto2Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('Assets/images/gallery/Halaman.jpg') }}" alt="Photo 2" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Photo 2 -->
    <div class="modal fade modal-lg" id="modalPhoto2" tabindex="-1" role="dialog"
        aria-labelledby="modalPhoto2Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('Assets/images/gallery/sekolah.jpg') }}" alt="Photo 2" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Photo 3 -->
    <div class="modal fade modal-lg" id="modalPhoto3" tabindex="-1" role="dialog"
        aria-labelledby="modalPhoto3Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('Assets/images/gallery/sekolah2.jpg') }}" alt="Photo 3" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Photo 4 -->
    <div class="modal fade modal-lg" id="modalPhoto4" tabindex="-1" role="dialog"
        aria-labelledby="modalPhoto3Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('Assets/images//gallery/kejasama.jpg') }}" alt="Photo 3" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Photo 5 -->
    <div class="modal fade modal-lg" id="modalPhoto5" tabindex="-1" role="dialog"
        aria-labelledby="modalPhoto3Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('Assets/images//gallery/sekolah3.jpg') }}" alt="Photo 3" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Photo 6 -->
    <div class="modal fade modal-lg" id="modalPhoto6" tabindex="-1" role="dialog"
        aria-labelledby="modalPhoto3Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('Assets/images//gallery/lomba1.jpg') }}" alt="Photo 3" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal End --}}

    <section id="kontak" class="kontak">
        <div class="container" data-aos="fade-up">
            <div class="section-kontak" data-aos="fade-up">
                <h2><span>Hubungi</span> Kami</h2>
            </div>
        </div>
        <div class="container mt-5" data-aos="fade-up">
            <div class="info-wrap">
                <div class="row">
                    <div class="col-lg-4 col-md-6 info">
                        <i class="bi bi-geo-alt"></i>
                        <h4>Lokasi:</h4>
                        <p> Jl. Profesor Moh. Yamin SH No.53, Bangkinang, Kec. Bangkinang<br>Kab. Kampar 28461</p>
                    </div>


                    <div class="col-lg-4 col-md-6 info mt-4 mt-lg-0">
                        <i class="bi bi-envelope"></i>
                        <h4>Email:</h4>
                        <p>sd.muhammadiyah. Kampa1@gmail.com</p>
                    </div>

                    <div class="col-lg-4 col-md-6 info mt-4 mt-lg-0">
                        <i class="bi bi-phone"></i>
                        <h4>Hubungi Melalui WA:</h4>
                        <p>+62853-7456-7200</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nama"
                        required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                        required>
                </div>
            </div>
            <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subjek"
                    required>
            </div>
            <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Pesan" id="message" required></textarea>
            </div>
            <div class="text-center mt-3">
                <button class="btn btn-success" type="submit" onclick="send()">Send
                    Message</button>
            </div>

        </div>
    </section>
    <!-- End Kontak Section -->


    <footer class="bg-dark text-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h4>About Us</h4>
                    <p>"Your go-to destination for cutting-edge web-based solutions. We specialize in crafting modern
                        web systems that seamlessly blend sleek design with advanced functionality. From responsive web
                        applications to complex e-commerce platforms, we're dedicated to delivering inspiring,
                        business-centric web solutions that connect, engage, and drive results.".</p>
                </div>
                <div class="col-lg-4">
                    <h4>Contact Us</h4>
                    <p>Phone: +6285381782497</p>
                    <p style="margin-top: -2%">Email: teamCreativeCodeFive@gmail.com</p>
                </div>
                <div class="col-lg-4">
                    <h4>Follow Us</h4>
                    <a href="https://www.instagram.com/creativecode5_id/" target="_blank"
                        class="text-light">Instagram</a> |
                    <a href="#" target="_blank" class="text-light">Facebook</a> |
                    <a href="#" target="_blank" class="text-light">LinkedIn</a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12 text-center">
                    <p>&copy; 2023 CreativeCodeFive. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function send() {
            const name = document.getElementById("name").value;
            const email = document.getElementById("email").value;
            const subject = document.getElementById("subject").value;
            const message = document.getElementById("message").value;

            // send ke wa ini +6285381782497

          window.open("https://api.whatsapp.com/send?phone=6289620569613&text=Nama%20%3A%20" + name + "%0AEmail%20%3A%20" + email + "%0ASubjek%3A%20" + subject + "%0APesan%20%3A%20" + message);








        }
    </script>

    <script src="{{ asset('Assets/dist/bootstrap/js/home.bootstrap.min.js') }}"></script>


</body>



</html>
