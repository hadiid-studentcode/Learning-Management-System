@extends('layouts.main')
@section('main')
    <div class="">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    <h2 class="text-dark-75 text-hover-success font-size-h1">Data Pembayaran</h2>
                    <p class="text-dark-50 mt-2 text-center">Silakan pilih jenis data pembayaran dan lakukan pengisian data
                        pembayaran di
                        bawah ini.</p>
                </div>
            </div>
        </div>
    </div>




    <div class="">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <form action="{{ asset('/' . $route . '/pembayaran/cari-siswa') }}" method="get">
                    <div class="form-group">
                        <label for="cariSiswa">Cari Siswa atau NISN :</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cariSiswa" placeholder="Masukkan Nama atau NISN"
                                name="cariSiswaAtauNisn"
                                value="@if (isset($search)) {{ $siswa->nama }} @else @endif">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success">Cari</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>





    @if (isset($search))

        @if ($route == 'tata-usaha')
            <div class="">
                <div class="card-custom gutter-b">
                    <div id="hasilPencarian">

                        {{-- alert kesalahan input --}}

                        @if (session('error'))
                            <div class="alert alert-warning d-flex justify-content-between align-items-center"
                                role="alert">
                                <div>
                                    <i class="fas fa-exclamation-circle" style="margin-right: 10px"></i>
                                    <strong>Peringatan!</strong> {{ session('error') }}
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif



                        {{-- alert kesalahan input --}}

                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h4 class="card-title">{{ $siswa->nama }}</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><strong>NISN:</strong> {{ $siswa->nisn }}</p>
                                <p class="card-text"><strong>Kelas:</strong> {{ $siswa->kelas }} {{ $siswa->rombel }}</p>
                                <p class="card-text"><strong>Tahun Ajaran:</strong> {{ $tahun_ajaran }}</p>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-success" data-toggle="modal"
                                    data-target="#tambahPembayaranModal">Tambah Pembayaran</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- modal tambah jenis pembayaran --}}
            <div class="modal fade" id="tambahPembayaranModal" tabindex="-1" role="dialog"
                aria-labelledby="tambahPembayaranModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ asset($route . '/pembayaran') }}" method="post"> @csrf <input type="hidden"
                            name="siswa_nama" id="siswa_nama" value="{{ $siswa->nama }}">
                        <input type="hidden" name="siswa_nisn" id="siswa_nisn" value="{{ $siswa->nisn }}">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahPembayaranModalLabel">Tambah
                                    Pembayaran
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="jenisPembayaran">Jenis Pembayaran</label>
                                    <select class="form-control" id="jenisPembayaran" name="jenisPembayaran">
                                        <option value="" hidden>Pilih Jenis Pembayaran</option>
                                        @foreach ($jenisPembayaran as $jp)
                                            @if (
                                                $jp->jenis == 'SPP KELAS 1' ||
                                                    $jp->jenis == 'SPP KELAS 2' ||
                                                    $jp->jenis == 'SPP KELAS 3' ||
                                                    $jp->jenis == 'SPP KELAS 4' ||
                                                    $jp->jenis == 'SPP KELAS 5' ||
                                                    $jp->jenis == 'SPP KELAS 6')
                                            @else
                                                <option value="{{ $jp->jenis }}-{{ $jp->nominal }}">
                                                    {{ $jp->jenis }} TAHUN {{ $tahun_ajaran }} | Rp.
                                                    {{ number_format($jp->nominal, 0, ',', '.') }}
                                                </option>
                                            @endif
                                        @endforeach
                                        <option value="spp">SPP TAHUN {{ $tahun_ajaran }} </option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="form-group" id="kelasSPPContainer" style="display: none;">
                                    <label for="kelasSPP">Kelas SPP</label>
                                    <select class="form-control" id="kelasSPP" name="kelasSPP">
                                        <option value="" hidden>Pilih Kelas</option>
                                        @foreach ($jenisPembayaran as $jp)
                                            @if (
                                                $jp->jenis == 'SPP KELAS 1' ||
                                                    $jp->jenis == 'SPP KELAS 2' ||
                                                    $jp->jenis == 'SPP KELAS 3' ||
                                                    $jp->jenis == 'SPP KELAS 4' ||
                                                    $jp->jenis == 'SPP KELAS 5' ||
                                                    $jp->jenis == 'SPP KELAS 6')
                                                <option value="{{ $jp->jenis }}-{{ $jp->nominal }}">
                                                    {{ $jp->jenis }} TAHUN {{ $tahun_ajaran }} | Rp.
                                                    {{ number_format($jp->nominal, 0, ',', '.') }}
                                                </option>
                                            @else
                                            @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="bulanSPPContainer" style="display: none;">
                                    <label for="bulanSPP">Bulan SPP</label>
                                    <select class="form-control" id="bulanSPP" name="bulanSPP">
                                        <option value="" hidden>Pilih Bulan</option>
                                        <option value="januari">Januari</option>
                                        <option value="februari">Februari</option>
                                        <option value="maret">Maret</option>
                                        <option value="april">April</option>
                                        <option value="mei">Mei</option>
                                        <option value="juni">Juni</option>
                                        <option value="juli">Juli</option>
                                        <option value="agustus">Agustus</option>
                                        <option value="september">September</option>
                                        <option value="oktober">Oktober</option>
                                        <option value="november">November</option>
                                        <option value="desember">Desember</option>
                                    </select>
                                </div>
                                <div class="form-group" id="inputContainer" style="display: none;">
                                    <label for="inputText">Pembayaran Lainnya</label>
                                    <input type="text" class="form-control" id="inputText"
                                        name="jenisPembayaranLainnya">
                                    <label for="inputNominal">Input Nominal Pembayaran</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control" id="inputNominal" name="nominal">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tanggalBayarBaru">Tanggal Pembayaran</label>
                                    <input type="date" class="form-control" id="inputTanggal"
                                        name="tanggal_pembayaran">
                                </div>
                                <div class="form-group">
                                    <label for="jumlahPembayaranBaru">Jumlah Pembayaran</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="text" class="form-control" id="inputJumlah"
                                            name="jumlah_pembayaran">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                                <script>
                                    document.getElementById("jenisPembayaran").addEventListener("change", function() {
                                        var selectedValue = this.value;
                                        var kelasSPPContainer = document.getElementById("kelasSPPContainer");
                                        var bulanSPPContainer = document.getElementById("bulanSPPContainer");
                                        var inputContainer = document.getElementById("inputContainer");
                                        kelasSPPContainer.style.display = "none";
                                        bulanSPPContainer.style.display = "none";
                                        inputContainer.style.display = "none";
                                        if (selectedValue === "spp") {
                                            kelasSPPContainer.style.display = "block";
                                            bulanSPPContainer.style.display = "block";
                                        } else if (selectedValue === "Lainnya") {
                                            inputContainer.style.display = "block";
                                        }
                                    });
                                    document.getElementById("bulanSPP").addEventListener("change", function() {
                                        var selectedValue = this.value;
                                        var inputContainer = document.getElementById("inputContainer");
                                        inputContainer.style.display = "none";
                                        if (selectedValue === "none") {
                                            inputContainer.style.display = "block";
                                        }
                                    });
                                    // Mengatur format angka pada input Jumlah Pembayaran
                                    var inputJumlah = document.getElementById("inputJumlah");
                                    inputJumlah.addEventListener("input", function() {
                                        var value = inputJumlah.value.replace(/\D/g, "");
                                        if (value === "") {
                                            inputJumlah.value = "";
                                        } else {
                                            var amount = parseInt(value);
                                            if (amount > 1000000000) {
                                                amount = 1000000000;
                                            }
                                            inputJumlah.value = new Intl.NumberFormat("id-ID").format(amount);
                                        }
                                    });
                                    // Mengatur format angka pada input Nominal Pembayaran Lainya
                                    var inputNominal = document.getElementById("inputNominal");
                                    inputNominal.addEventListener("input", function() {
                                        var value = inputNominal.value.replace(/\D/g, "");
                                        if (value === "") {
                                            inputNominal.value = "";
                                        } else {
                                            var amount = parseInt(value);
                                            if (amount > 1000000000) {
                                                amount = 1000000000;
                                            }
                                            inputNominal.value = new Intl.NumberFormat("id-ID").format(amount);
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- end --}}
        @else
            <div class="">
                <div class="card-custom gutter-b">
                    <div id="hasilPencarian">

                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h4 class="card-title">{{ $siswa->nama }}</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><strong>NISN:</strong> {{ $siswa->nisn }}</p>
                                <p class="card-text"><strong>Kelas:</strong> {{ $siswa->kelas }} {{ $siswa->rombel }}</p>
                                <p class="card-text"><strong>Tahun Ajaran:</strong> {{ $tahun_ajaran }}</p>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        @endif
        </div>
    @else
    @endif

    {{-- <div class="container">
    <div class="card-custom gutter-b">
        <div id="hasilPencarian">
            
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="card-title">{{ $siswa->nama }}</h4>
                </div>
                <div class="card-body">
                    <p class="card-text"><strong>NISN:</strong> {{ $siswa->nisn }}</p>
                    <p class="card-text"><strong>Kelas:</strong> {{ $siswa->kelas }} {{ $siswa->rombel }}</p>
                    <p class="card-text"><strong>Tahun Ajaran:</strong> {{ $tahun_ajaran }}</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" data-toggle="modal" data-target="#tambahPembayaranModal">Tambah Pembayaran</button>
                </div>
            </div>
        
        </div>
    </div>
</div> --}}

    <div class="">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div id="siswaDetails">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mt-4" id="data_table">
                            <thead>
                                <tr>
                                    <th colspan="8">
                                        <h5 class="text-center">Data Pembayaran Siswa</h5>
                                    </th>
                                </tr>
                                <tr>
                                    <th>No Transaksi</th>
                                    <th>Jenis</th>
                                    <th>Nominal</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Sisa</th>
                                    <th>Keterangan</th>
                                    @if ($route == 'tata-usaha')
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="pembayaranTableBody">
                                @if (isset($search))
                                    @foreach ($pembayaran as $p)
                                        <tr>

                                            <td>{{ $p->no_transaksi }}</td>
                                            <td>{{ $p->pembayaran }}</td>
                                            <td>Rp.{{ number_format($p->tarif, 0, '.', '.') }}</td>
                                            <td>{{ $p->tanggal }}</td>
                                            <td>Rp.{{ number_format($p->nominal, 0, '.', '.') }}</td>
                                            <td>RP.{{ number_format($p->sisa, 0, '.', '.') }}</td>
                                            <td>{{ $p->deskripsi }}</td>
                                            @if ($route == 'tata-usaha')
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">

                                                        @if ($route == 'super-user')
                                                            <a href="{{ url($route . '/pembayaran/cetak/' . $p->no_transaksi) }}"
                                                                class="btn btn-info btn-sm" target="_blank">
                                                                <i class="fas fa-print"></i>
                                                            </a>
                                                        @else
                                                            @if ($p->deskripsi == 'Belum Lunas')
                                                                <button class="btn btn-success btn-sm mr-1"
                                                                    data-toggle="modal"
                                                                    data-target="#editPembayaranModal{{ $p->no_transaksi }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                {{-- modal edit jenis pembayaran --}}
                                                                <div class="modal fade"
                                                                    id="editPembayaranModal{{ $p->no_transaksi }}"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="editPembayaranModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <form
                                                                            action="{{ asset($route . '/pembayaran/' . $p->no_transaksi) }}"
                                                                            method="post"> @csrf @method('PUT') <input
                                                                                type="hidden" name="no_transaksi"
                                                                                value="{{ $p->no_transaksi }}">
                                                                            <input type="hidden" name="siswa_nisn"
                                                                                value="{{ $nisn }}">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="editPembayaranModalLabel"> Edit
                                                                                        Pembayaran
                                                                                    </h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="editJenisPembayaran">Jenis
                                                                                            Pembayaran</label>
                                                                                        <select class="form-control"
                                                                                            id="editJenisPembayaran"
                                                                                            name="editJenisPembayaran"
                                                                                            disabled>
                                                                                            <option value="" hidden>
                                                                                                {{ $p->pembayaran }} | RP
                                                                                                {{ number_format($p->nominal, 0, ',', '.') }}
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="editTanggalBayarBaru">Tanggal
                                                                                            Pembayaran</label>
                                                                                        <input type="date"
                                                                                            class="form-control"
                                                                                            id="editInputTanggal"
                                                                                            name="editTanggalPembayaran"
                                                                                            disabled
                                                                                            value="{{ date('Y-m-d') }}">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="editJumlahPembayaranBaru">Sisa
                                                                                            Pembayaran</label>
                                                                                        <div class="input-group">
                                                                                            <div
                                                                                                class="input-group-prepend">
                                                                                                <span
                                                                                                    class="input-group-text">Rp.</span>
                                                                                            </div>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                disabled
                                                                                                value="{{ number_format($p->sisa, 0, ',', '.') }}"
                                                                                                id="editSisaPembayaran"
                                                                                                name="editSisaPembayaran">
                                                                                            <input type="hidden"
                                                                                                class="form-control"
                                                                                                value="{{ $p->sisa }}"
                                                                                                id="editSisaPembayaran"
                                                                                                name="editSisaPembayaran">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="editJumlahPembayaranBaru">Jumlah
                                                                                            Pembayaran</label>
                                                                                        <div class="input-group">
                                                                                            <div
                                                                                                class="input-group-prepend">
                                                                                                <span
                                                                                                    class="input-group-text">Rp.</span>
                                                                                            </div>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                id="editInputJumlah-{{ $p->id }}"
                                                                                                oninput="rupiah({{ $p->id }})"
                                                                                                name="editJumlahPembayaran">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit"
                                                                                            class="btn btn-secondary"
                                                                                            data-dismiss="modal">Batal</button>
                                                                                        <button type="submit"
                                                                                            class="btn btn-success">Simpan</button>
                                                                                    </div>
                                                                                    <script>
                                                                                        document.getElementById("editJenisPembayaran").addEventListener("change", function() {
                                                                                            var selectedValue = this.value;
                                                                                            var kelasSPPContainer = document.getElementById("editKelasSPPContainer");
                                                                                            var bulanSPPContainer = document.getElementById("editBulanSPPContainer");
                                                                                            var inputContainer = document.getElementById("editInputContainer");
                                                                                            kelasSPPContainer.style.display = "none";
                                                                                            bulanSPPContainer.style.display = "none";
                                                                                            inputContainer.style.display = "none";
                                                                                            if (selectedValue === "spp") {
                                                                                                kelasSPPContainer.style.display = "block";
                                                                                                bulanSPPContainer.style.display = "block";
                                                                                            } else if (selectedValue === "lainya") {
                                                                                                inputContainer.style.display = "block";
                                                                                            }
                                                                                        });
                                                                                        document.getElementById("editBulanSPP").addEventListener("change", function() {
                                                                                            var selectedValue = this.value;
                                                                                            var inputContainer = document.getElementById("editInputContainer");
                                                                                            inputContainer.style.display = "none";
                                                                                            if (selectedValue === "none") {
                                                                                                inputContainer.style.display = "block";
                                                                                            }
                                                                                        });
                                                                                        // var editInputJumlah = document.getElementById("editInputJumlah");
                                                                                        // editInputJumlah.addEventListener("input", function() {
                                                                                        //     var value = editInputJumlah.value.replace(/\D/g, "");
                                                                                        //     if (value === "") {
                                                                                        //         editInputJumlah.value = "";
                                                                                        //     } else {
                                                                                        //         var amount = parseInt(value);
                                                                                        //         if (amount > 1000000000) {
                                                                                        //             amount = 1000000000;
                                                                                        //         }
                                                                                        //         editInputJumlah.value = new Intl.NumberFormat("id-ID").format(amount);
                                                                                        //     }
                                                                                        // });
                                                                                        function rupiah(id) {
                                                                                            var editInputJumlah = document.getElementById("editInputJumlah-" + id);
                                                                                            var value = editInputJumlah.value.replace(/\D/g, "");
                                                                                            if (value === "") {
                                                                                                editInputJumlah.value = "";
                                                                                            } else {
                                                                                                var amount = parseInt(value);
                                                                                                if (amount > 1000000000) {
                                                                                                    amount = 1000000000;
                                                                                                }
                                                                                                editInputJumlah.value = new Intl.NumberFormat("id-ID").format(amount);
                                                                                            }
                                                                                        }
                                                                                        var editInputNominal = document.getElementById("editInputNominal");
                                                                                        editInputNominal.addEventListener("input", function() {
                                                                                            var value = editInputNominal.value.replace(/\D/g, "");
                                                                                            if (value === "") {
                                                                                                editInputNominal.value = "";
                                                                                            } else {
                                                                                                var amount = parseInt(value);
                                                                                                if (amount > 1000000000) {
                                                                                                    amount = 1000000000;
                                                                                                }
                                                                                                editInputNominal.value = new Intl.NumberFormat("id-ID").format(amount);
                                                                                            }
                                                                                        });
                                                                                    </script>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                {{-- end --}}
                                                            @else
                                                            @endif



                                                            <form
                                                                action="{{ asset($route . '/pembayaran/' . $p->no_transaksi) }}"
                                                                method="post"> @csrf @method('DELETE') <input
                                                                    type="hidden" name="nisn" id="nisn"
                                                                    value="{{ $nisn }}">




                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    data-toggle="modal"
                                                                    data-target="#confirmDeleteModal{{ $p->id }}">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>


                                                            </form>

                                                            {{-- modal confirm delete --}}


                                                            <div class="modal fade"
                                                                id="confirmDeleteModal{{ $p->id }}" tabindex="-1"
                                                                role="dialog" aria-labelledby="confirmDeleteModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="confirmDeleteModalLabel">
                                                                                Konfirmasi
                                                                                Hapus Pembayaran</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body"> Apakah Anda yakin
                                                                            ingin
                                                                            menghapus
                                                                            pembayaran
                                                                            ini? </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">Batal</button>
                                                                            <form
                                                                                action="{{ url('/' . $route . '/pembayaran/' . $p->no_transaksi) }}"
                                                                                method="POST"> @csrf @method('DELETE')
                                                                                <input type="hidden" name="siswa_nisn"
                                                                                    id="siswa_nisn"
                                                                                    value="{{ $nisn }}">
                                                                                <button type="submit"
                                                                                    class="btn btn-danger"
                                                                                    onclick="return showConfirmation('{{ $p->id }}')">Hapus</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>








                                                            <a href="{{ url($route . '/pembayaran/cetak/' . $p->no_transaksi) }}"
                                                                class="btn btn-info btn-sm"style="margin-right: 5%;"
                                                                target="_blank">
                                                                <i class="fas fa-print"></i>
                                                            </a>



                                                    </div>
                                                </td>
                                            @endif




                                            <script>
                                                $('#reportModal').on('shown.bs.modal', function() {
                                                    // Aksi yang diambil saat modal ditampilkan
                                                });

                                                $('#reportModal').on('hidden.bs.modal', function() {
                                                    // Aksi yang diambil saat modal disembunyikan
                                                });
                                            </script>
                                    @endif

                                    </td>
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
@endsection
