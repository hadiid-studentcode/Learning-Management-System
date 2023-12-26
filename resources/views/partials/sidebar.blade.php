<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/' . $route) }}" class="brand-link">
        <img src="{{ asset('Assets/images/sistemhamkabs.jpg') }}" alt="AdminLTE Logo" class="brand-image">
        <span class="brand-text text-success ">HAMKA BS </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">

                    {{-- switch role --}}

                    @php
                        // get jumlah pesan masuk dan belum dibaca
                        $id_user = Auth::user()->id;
                        $resultPesan = new App\Models\Pesan();
                        $pesan = $resultPesan->jumlahPesanBelumDibaca($id_user);



                        // get pegawai jenis where id_user
                        $resultPegawai = new App\Models\Pegawai();



                        $tataUsaha = $resultPegawai->getPegawaiFirst(['jenis'], $id_user);

                        if($tataUsaha == null){
                            $jenis ='';
                        }else{
                              $jenis = $tataUsaha->jenis;

                        }





                    @endphp

                    @switch($role)
                        @case('Pegawai')
                            {{-- sidebar untuk pegawai --}}
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ asset('/pegawai/dashboard') }}"
                                        class="nav-link @if ($title == 'Dashboard') active @else '' @endif">
                                        <i class="fas fa-chart-bar"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Dashboard</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ asset('/pegawai/pesan') }}"
                                        class="nav-link @if ($title == 'Pesan') active @else '' @endif">
                                        <i class="fas fa-envelope"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Pesan</span>
                                        @if ($pesan > 0)
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                                style="margin-left: 5px;">
                                                {{ $pesan }}
                                            </span>
                                        @endif
                                    </a>
                                </li>

                                <li class="nav-item" style="margin-top: 210%">
                                    <a href="{{ asset('/' . $route . '/setting') }}"
                                        class="nav-link @if ($title == 'Settings') active @else '' @endif">
                                        <i class="fas fa-cogs"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Setting</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/logout') }}" class="nav-link">
                                        <i class="fas fa-sign-out-alt"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Keluar</span>
                                    </a>
                                </li>

                            </ul>

                            {{-- akhir sidebar untuk pegawai --}}
                        @break

                        @case('Wali Murid')
                            {{-- sidebar untuk wali murid --}}
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ asset('/wali-murid/dashboard') }}"
                                        class="nav-link @if ($title == 'Dashboard') active @else '' @endif">
                                        <i class="fas fa-home"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Dashboard</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ asset('/wali-murid/profile-siswa') }}"
                                        class="nav-link @if ($title == 'Profile Siswa') active @else '' @endif">
                                        <i class="fas fa-user"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Profil Siswa</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ asset('/wali-murid/pesan') }}"
                                        class="nav-link @if ($title == 'Pesan') active @else '' @endif">
                                        <i class="fas fa-envelope"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Pesan</span>
                                        @if ($pesan > 0)
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                                style="margin-left: 5px;">
                                                {{ $pesan }}
                                            </span>
                                        @endif
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ asset('/wali-murid/pembayaran') }}"
                                        class="nav-link @if ($title == 'Pembayaran') active @else '' @endif">
                                        <i class="fas fa-money-bill"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Pembayaran</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/rekap-nilai') }}"
                                        class="nav-link @if ($title == 'Rekap Nilai') active @else '' @endif">
                                        <i class="fas fa-file-alt"
                                            style="width:25px; font-size:20px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Rekap Nilai</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ asset('/wali-murid/prestasi-siswa') }}"
                                        class="nav-link @if ($title == 'Prestasi Siswa') active @else '' @endif">
                                        <i class="fas fa-trophy"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Prestasi Siswa</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ asset('/wali-murid/mata-pelajaran') }}"
                                        class="nav-link @if ($title == 'Mata Pelajaran') active @else '' @endif">
                                        <i class="fas fa-book"
                                            style="width:25px; font-size:20px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Mata Pelajaran</span>
                                    </a>
                                </li>


                                <li class="nav-item" style="margin-top:130%;">
                                    <a href="{{ asset('/' . $route . '/setting') }}"
                                        class="nav-link @if ($title == 'Settings') active @else '' @endif">
                                        <i class="fas fa-cogs"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Setting</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/logout') }}" class="nav-link">
                                        <i class="fas fa-sign-out-alt"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Keluar</span>
                                    </a>
                                </li>

                            </ul>

                            {{-- akhir sidebar untuk wali murid --}}
                        @break

                        @case('Guru')
                            {{-- sidebar untuk Guru --}}
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/dashboard') }}"
                                        class="nav-link @if ($title == 'Dashboard') active @else '' @endif">
                                        <i class="fas fa-chart-bar"
                                            style="width:25px; font-size:20px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Dashboard</span>
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/jadwal') }}"
                                        class="nav-link @if ($title == 'Jadwal') active @else '' @endif">
                                        <i class="fas fa-book"
                                            style="width:25px; font-size:20px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Jadwal </span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/pesan') }}"
                                        class="nav-link @if ($title == 'Pesan') active @else '' @endif">
                                        <i class="fas fa-envelope"
                                            style="width:25px; font-size:20px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Pesan</span>
                                        @if ($pesan > 0)
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                                style="margin-left: 5px;">
                                                {{ $pesan }}
                                            </span>
                                        @endif
                                    </a>
                                </li>

                                @if ($jenisGuru == 'Wali Kelas')
                                    <li class="nav-item">
                                        <a href="{{ asset('/' . $route . '/rekap-nilai') }}"
                                            class="nav-link @if ($title == 'Rekap Nilai') active @else '' @endif">
                                            <i class="fas fa-chart-bar"
                                                style="width:25px; font-size:20px; height:25px; color: black; margin-right: 23px;"></i>
                                            <span style="font-family: arial; color: black;">Rekap Nilai</span>
                                        </a>
                                    </li>
                                @endif
                                @if ($jenisGuru == 'Wali Kelas')
                                    <li class="nav-item">
                                        <a href="{{ asset('/' . $route . '/manajemen-siswa') }}"
                                            class="nav-link @if ($title == 'Manajemen Siswa') active @else '' @endif">
                                            <i class="fas fa-users"
                                                style="width:25px; font-size:20px; height:25px; color: black; margin-right: 23px;"></i>
                                            <span style="font-family: arial; color: black;">Manajemen Siswa</span>
                                        </a>
                                    </li>
                                      <li class="nav-item">
                                        <a href="{{ asset('/' . $route . '/manajemen-akun') }}"
                                            class="nav-link @if ($title == 'Manajemen Akun') active @else '' @endif">
                                             <i class="fas fa-user-cog"
                                                style="font-size: 20px; width: 25px; height: 25px; color: black; margin-right: 23px;"></i>
                                            <span style="font-family: arial; color: black;">Manajemen Akun</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ asset('/' . $route . '/prestasi-siswa') }}"
                                            class="nav-link @if ($title == 'Prestasi Siswa') active @else '' @endif">
                                            <i class="fas fa-award"
                                                style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                            <span style="font-family: arial; color: black;">Prestasi Siswa</span>
                                        </a>
                                    </li>

                                @endif
                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/atur-kkm') }}"
                                        class="nav-link @if ($title == 'Atur KKM') active @else '' @endif">
                                        <i class="fas fa-cogs"
                                            style="width:25px; font-size:20px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Atur KKM</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/manajemen-nilai') }}"
                                        class="nav-link @if ($title == 'Manajemen Nilai') active @else '' @endif">
                                        <i class="fas fa-file-alt"
                                            style="width:25px; font-size:20px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Manajemen Nilai</span>
                                    </a>
                                </li>
                                 @if ($jenisGuru == 'Wali Kelas')
                                    {{-- tutorial --}}
                                    <li class="nav-item">
                                        <a href="{{ asset('/' . $route . '/tutorial') }}"
                                            class="nav-link @if ($title == 'Tutorial') active @endif">
                                            <i class="fas fa-video"
                                                style="font-size:20px; width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                            <span style="font-family: arial; color: black;">Video Tutorial</span>
                                        </a>
                                    </li>
                                    {{-- end tutorial --}}
                                @endif

                                <li class="nav-item" style="margin-top: 140%;">
                                    <a href="{{ asset('/' . $route . '/setting') }}"
                                        class="nav-link @if ($title == 'Settings') active @else '' @endif">
                                        <i class="fas fa-cogs"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Setting</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/logout') }}" class="nav-link">
                                        <i class="fas fa-sign-out-alt"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Keluar</span>
                                    </a>
                                </li>




                                {{-- <li class="nav-item"> --}}
                                {{-- <a href="{{ asset('/' . $route . '/rekap-nilai') }}" --}}
                                {{-- class="nav-link @if ($title == 'Rekap-nilai') active @else '' @endif"> --}}
                                {{-- <svg width="25px" height="25px" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"><defs><style>.a{fill:none;stroke:#000000;stroke-linecap:round;stroke-linejoin:round;}</style></defs><path class="a" d="M36.3492,27.26l-1.9361-1.1163L32.4769,27.26V5.7249H26.8956a2.6848,2.6848,0,0,0-2.845,2.845,2.6811,2.6811,0,0,0-2.845-2.845H7.3758V35.5578h13.83a2.6848,2.6848,0,0,1,2.845,2.8449,2.6811,2.6811,0,0,1,2.845-2.8449h13.83V5.7249H36.3492Z"/><path class="a" d="M24.1,42.2751c-3.734,0-2.845-3.576-6.5593-3.576H4.6V9.5578H7.3758"/><path class="a" d="M7.3462,33.3845h13.83a2.6848,2.6848,0,0,1,2.845,2.845,2.6811,2.6811,0,0,1,2.845-2.845H40.7254"/><path class="a" d="M10.6891,9.0836h3.5977a.3541.3541,0,0,1,.32.38v7.3792a.3541.3541,0,0,1-.32.38H10.6891a.3541.3541,0,0,1-.32-.38V9.4639A.3541.3541,0,0,1,10.6891,9.0836Z"/><path class="a" d="M17.2839,9.0836h4.04"/><path class="a" d="M17.2839,13.1337h4.04"/><path class="a" d="M17.2839,17.1839h4.04"/><path class="a" d="M10.27,21.234l11.0638.0719"/><path class="a" d="M10.27,25.2842l11.0638.0718"/><path class="a" d="M10.27,29.3343l11.0638.0719"/><path class="a" d="M26.372,21.234l6.0883.0392m3.8889.0221,1.0768.0106"/><path class="a" d="M26.372,25.2842l6.0883.0388m3.8889.02,1.0768.0132"/><path class="a" d="M26.372,29.3343l11.0639.0719"/><path class="a" d="M26.372,13.035l6.0883.0391m3.8988.0258,1.0669.0069"/><path class="a" d="M26.372,17.1839l6.0883.0391m3.8889.023,1.0768.01"/><path class="a" d="M26.372,9.0144l6.0883.0392m3.8889.0255,1.0768.0071"/><path class="a" d="M24.1,42.2751c3.734,0,2.845-3.576,6.5593-3.576H43.6V9.5578H40.7254"/></svg> --}}
                                {{-- <p>Data Nilai</p> --}}
                                {{-- </a> --}}
                                {{-- </li> --}}

                            </ul>
                            {{-- akhir dan dimasukkan diisini --}}


                            {{-- akhir sidebar untuk Guru --}}
                        @break

                        {{-- siswa --}}
                        @case('Siswa')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/dashboard') }}"
                                        class="nav-link @if ($title == 'Dashboard') active @else '' @endif">
                                        <i class="fas fa-chart-bar"
                                            style="width:25px; font-size:20px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Dashboard</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/jadwal') }}"
                                        class="nav-link @if ($title == 'Jadwal') active @else '' @endif">
                                        <i class="fas fa-book"
                                            style="width:25px; font-size:20px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Jadwal</span>
                                    </a>
                                </li>

                                <li class="nav-item" style="margin-top: 210%">
                                    <a href="{{ asset('/' . $route . '/logout') }}" class="nav-link">
                                        <i class="fas fa-sign-out-alt"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Keluar</span>
                                    </a>
                                </li>


                                {{-- Menu sidebar siswa Nggak dibuat  --}}

                                {{-- akhir dan dimasukkan diisini --}}
                            </ul>
                        @break

                        {{-- sidebar tata usaha --}}
                        @case('Tata Usaha')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/dashboard') }}"
                                        class="nav-link @if ($title == 'Dashboard') active @else '' @endif">
                                        <i class="fas fa-chart-bar"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Dashboard</span>
                                    </a>
                                </li>



                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/pesan') }}"
                                        class="nav-link @if ($title == 'Pesan') active @else '' @endif">
                                        <i class="fas fa-envelope"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Pesan </span>
                                        @if ($pesan > 0)
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                                style="margin-left: 5px;">
                                                {{ $pesan }}
                                            </span>
                                        @endif
                                    </a>
                                </li>

                                @if ($jenis == 'Bagian Administrasi' || $jenis == 'admin')
                                    <li class="nav-item">
                                        <a href="{{ asset('/' . $route . '/manajemen-guru') }}"
                                            class="nav-link @if ($title == 'Manajemen Guru') active @endif">
                                            <i class="fas fa-chalkboard-teacher"
                                                style="font-size: 20px; width: 25px; height: 25px; color: black; margin-right: 23px;"></i>
                                            <span style="font-family: Arial; color: black;">Manajemen Guru</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ asset('/' . $route . '/manajemen-kelas') }}"
                                            class="nav-link @if ($title == 'Manajemen Kelas') active @endif">
                                            <i class="fas fa-chalkboard-teacher"
                                                style="font-size: 20px; width: 25px; height: 25px; color: black; margin-right: 23px;"></i>
                                            <span style="font-family: Arial; color: black;">Manajemen Kelas</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ asset('/' . $route . '/manajemen-siswa') }}"
                                            class="nav-link @if ($title == 'Manajemen Siswa') active @endif">
                                            <i class="fas fa-user-plus"
                                                style="font-size: 20px; width: 25px; height: 25px; color: black; margin-right: 23px;"></i>
                                            <span style="font-family: Arial; color: black;">Manajemen Siswa</span>
                                        </a>
                                    </li>
                                    {{-- PPDB --}}
                                    <li class="nav-item">
                                        <a href="{{ asset('/' . $route . '/kelola-ppdb') }}"
                                            class="nav-link @if ($title == 'Kelola PPDB') active @endif">
                                            <i class="fas fa-user-graduate"
                                                style="font-size: 20px; width: 25px; height: 25px; color: black; margin-right: 23px;"></i>
                                            <span style="font-family: Arial; color: black;">Kelola PPDB</span>
                                        </a>
                                    </li>
                                    {{-- PPDB --}}
                                    <li class="nav-item">
                                        <a href="{{ asset('/' . $route . '/manajemen-mata-pelajaran') }}"
                                            class="nav-link @if ($title == 'Manajemen Mata Pelajaran') active @endif">
                                            <i class="fas fa-calendar-alt"
                                                style="font-size:20px; width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                            <span style="font-family: arial; color: black;">Manajemen Mapel</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ asset('/' . $route . '/manajemen-pegawai') }}"
                                            class="nav-link @if ($title == 'Manajemen Pegawai') active @endif">
                                            <i class="fas fa-user-plus"
                                                style="font-size: 20px; width: 25px; height: 25px; color: black; margin-right: 23px;"></i>
                                            <span style="font-family: Arial; color: black;">Manajemen Pegawai</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ asset('/' . $route . '/manajemen-akun') }}"
                                            class="nav-link @if ($title == 'Manajemen Akun') active @endif">
                                            <i class="fas fa-user-cog"
                                                style="font-size: 20px; width: 25px; height: 25px; color: black; margin-right: 23px;"></i>
                                            <span style="font-family: Arial; color: black;">Manajemen Akun</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ asset('/' . $route . '/manajemen-absensi') }}"
                                            class="nav-link @if ($title == 'Manajemen Absensi') active @endif">
                                            <i class="far fa-clock"
                                                style="font-size: 20px; width: 25px; height: 25px; color: black; margin-right: 23px;"></i>
                                            <span style="font-family: Arial; color: black;"> Absensi</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ asset('/' . $route . '/prestasi-siswa') }}"
                                            class="nav-link @if ($title == 'Prestasi Siswa') active @else '' @endif">
                                            <i class="fas fa-award"
                                                style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                            <span style="font-family: arial; color: black;">Prestasi Siswa</span>
                                        </a>
                                    </li>
                                @endif
                                @if ($jenis == 'Bagian Keuangan' || $jenis == 'admin')
                                    <li class="nav-item">
                                        <a href="{{ asset('/' . $route . '/pembayaran') }}"
                                            class="nav-link @if ($title == 'Pembayaran') active @else '' @endif">
                                            <i class="fas fa-credit-card"
                                                style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                            <span style="font-family: arial; color: black;">Pembayaran</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ asset('/' . $route . '/rekap-keuangan') }}"
                                            class="nav-link  @if ($title == 'Rekap Keuangan') active @else '' @endif"">
                                            <i class="fas fa-file-invoice"
                                                style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                            <span style="font-family: arial; color: black;">Rekap Keuangan</span>
                                        </a>
                                    </li>
                                @endif

                                @if ($jenis == 'Bagian Hubungan Masyarakat' || $jenis == 'admin')
                                    <li class="nav-item">
                                        <a href="{{ asset('/' . $route . '/gallery') }}"
                                            class="nav-link @if ($title == 'Gallery') active @else '' @endif">
                                            <i class="fas fa-images"
                                                style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                            <span style="font-family: arial; color: black;">Gallery</span>
                                        </a>
                                    </li>
                                @endif
                                @if ($jenis == 'Bagian Administrasi' || $jenis == 'admin')
                                    <li class="nav-item">
                                        <a href="{{ asset('/' . $route . '/kinerja-guru') }}"
                                            class="nav-link @if ($title == 'Kinerja Guru') active @else '' @endif">
                                            <i class="fas fa-chalkboard-teacher"
                                                style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                            <span style="font-family: arial; color: black;">Kinerja Guru</span>
                                        </a>
                                    </li>
                                @endif
                                <hr>
                                <li class="nav-item" style="margin-top:2%;">
                                    <a href="{{ asset('/' . $route . '/setting') }}"
                                        class="nav-link @if ($title == 'Settings') active @else '' @endif">
                                        <i class="fas fa-cogs"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Setting</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/logout') }}" class="nav-link">
                                        <i class="fas fa-sign-out-alt"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Keluar</span>
                                    </a>
                                </li>

                            </ul>
                        @break

                        {{-- super user --}}
                        @case('Super User')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/dashboard') }}"
                                        class="nav-link @if ($title == 'Dashboard') active @else '' @endif">
                                        <i class="fas fa-chart-bar"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Dashboard</span>
                                    </a>
                                </li>



                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/pesan') }}"
                                        class="nav-link @if ($title == 'Pesan') active @endif">
                                        <i class="fas fa-envelope"
                                            style="font-size: 20px; width: 25px; height: 25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: Arial; color: black;">Pesan</span>
                                        @if ($pesan > 0)
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                                style="margin-left: 5px;">
                                                {{ $pesan }}
                                            </span>
                                        @endif
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/Nilai-siswa') }}"
                                        class="nav-link @if ($title == 'Nilai Siswa') active @endif">
                                        <i class="fas fa-book"
                                            style="font-size: 20px; width: 25px; height: 25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: Arial; color: black;">Nilai Siswa</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/rekap-keuangan') }}"
                                        class="nav-link @if ($title == 'Rekap Keuangan') active @endif">
                                        <i class="fas fa-money-bill"
                                            style="font-size: 20px; width: 25px; height: 25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: Arial; color: black;">Rekap Keuangan</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/kinerja-guru') }}"
                                        class="nav-link @if ($title == 'Kinerja Guru') active @endif">
                                        <i class="fas fa-chart-line"
                                            style="font-size: 20px; width: 25px; height: 25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: Arial; color: black;">Kinerja Guru</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/pembayaran') }}"
                                        class="nav-link @if ($title == 'Pembayaran') active @endif">
                                        <i class="fas fa-credit-card"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Pembayaran Siswa</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/laporan-keuangan') }}"
                                        class="nav-link @if ($title == 'Laporan Keuangan') active @endif">
                                        <i class="fas fa-user-lock"
                                            style="font-size: 20px; width: 25px; height: 25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: Arial; color: black;">Laporan Keuangan</span>
                                    </a>
                                </li>

                                <li class="nav-item" style="margin-top: 135%">
                                    <a href="{{ asset('/' . $route . '/setting') }}"
                                        class="nav-link @if ($title == 'Settings') active @else '' @endif">
                                        <i class="fas fa-cogs"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Setting</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ asset('/' . $route . '/logout') }}" class="nav-link">
                                        <i class="fas fa-sign-out-alt"
                                            style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                        <span style="font-family: arial; color: black;">Keluar</span>
                                    </a>
                                </li>


                            </ul>
                        @break

                        {{-- sidebar tata usaha --}}

                        @default
                    @endswitch


                </li>
                {{-- <li class="nav-item menu-open" style="margin-top: 500px">
                    <ul class="nav nav-treeview">

                        @if ($role == 'Siswa')
                        @else
                            <li class="nav-item">
                                <a href="{{ asset('/' . $route . '/setting') }}"
                                    class="nav-link @if ($title == 'Setting') active @else '' @endif">
                                    <i class="fas fa-cogs"
                                        style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                    <span style="font-family: arial; color: black;">Setting</span>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ asset('/' . $route . '/logout') }}" class="nav-link">
                                <i class="fas fa-sign-out-alt"
                                    style="font-size:20px;  width:25px; height:25px; color: black; margin-right: 23px;"></i>
                                <span style="font-family: arial; color: black;">Keluar</span>
                            </a>
                        </li>

                    </ul>
                </li> --}}



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>
