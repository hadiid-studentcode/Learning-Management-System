@extends('layouts.main')

@section('main')
    <div class="">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    <h2 class="text-dark-75 text-hover-success font-size-h1">Rekap Data Keuangan</h2>
                    <p class="text-dark-50 text-center">Mohon Isi Data uang Keluar dengan benar dan Jujur.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="" style="width:auto;">
        <div class="card card-custom" id="data_pertemuan">
            <div class="card-body">
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/tata-usaha/pemasukan') }}" onclick="showPage('input')">
                                <span class="nav-icon">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <span class="svg-icon ">Masuk</span>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url('/tata-usaha/pengeluaran') }}"
                                onclick="showPage('pengeluaran')">
                                <span class="nav-icon">
                                    <span class="nav-icon">
                                       
                                        <i class="fas fa-money-bill-alt"></i>
                                        <span class="svg-icon">Keluar</span>
                                    </span>
                                </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/tata-usaha/rekap-keuangan') }}" onclick="showPage('rekap')">
                                <span class="nav-icon">
                                    <i class="fas fa-clipboard-list"></i>
                                    <span class="svg-icon ">Rekap</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>



    <div class="page">
        <div class="" id="input-pemasukan-content">
            <div class="">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Laporkan Pengeluaran</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ asset('/tata-usaha/pengeluaran') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="tanggal">Tanggal:</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal">
                            </div>

                            <div class="form-group">
                                <label for="jumlah">Nominal:</label>
                                <input type="text" class="form-control" id="jumlah" name="nominal">
                            </div>

                            <script>
                                var jumlahInput = document.getElementById('jumlah');
                                jumlahInput.addEventListener('input', formatRupiah);

                                function formatRupiah() {
                                    var nilai = jumlahInput.value;
                                    var nilaiClean = nilai.replace(/\D/g, '');
                                    var nilaiFormatted = formatNumberToRupiah(nilaiClean);
                                    jumlahInput.value = nilaiFormatted;

                                    var maxLimit = 100000000;
                                    var numericalValue = parseInt(nilaiClean, 10);
                                    if (numericalValue > maxLimit) {
                                        jumlahInput.value = formatNumberToRupiah(maxLimit);
                                    }
                                }

                                function formatNumberToRupiah(angka) {
                                    var rupiah = '';
                                    var angkarev = angka.toString().split('').reverse().join('');
                                    for (var i = 0; i < angkarev.length; i++) {
                                        if (i % 3 == 0) {
                                            rupiah += angkarev.substr(i, 3) + '.';
                                        }
                                    }
                                    return 'Rp ' + rupiah.split('', rupiah.length - 1).reverse().join('');
                                }
                            </script>


                            <div class="form-group">
                                <label for="kategori">Kategori Pengeluaran:</label>
                                <select class="form-control" id="kategori" name="kategori" onchange="showInput()">
                                    <option value="">Pilih kategori</option>
                                    <option value="Biaya Bahan Baku">Biaya Bahan Baku</option>
                                    <option value="Biaya Listrik">Biaya Listrik</option>
                                    <option value="Gaji Guru">Gaji Guru</option>
                                    <option value="Gaji Pegawai">Gaji Pegawai</option>
                                    <option value="Gaji TU">Gaji TU</option>
                                    <option value="Biaya Lainnya">Biaya Lainnya</option>
                                </select>
                            </div>

                            <div class="form-group" id="guruSelect" style="display: none;">
                                <label for="guru">Pilih Guru:</label>
                                <select class="form-control" id="guru" name="guru">
                                    <option value="">Pilih guru</option>
                                    @foreach ($guru as $g)
                                        <option value="{{ $g->id }}">{{ $g->nama }}</option>
                                    @endforeach
                                    <!-- Tambahkan opsi nama guru lainnya di sini -->
                                </select>
                            </div>

                            <div class="form-group" id="tuSelect" style="display: none;">
                                <label for="tu">Pilih TU:</label>
                                <select class="form-control" id="tu" name="tu">
                                    <option value="">Pilih TU</option>
                                    @foreach ($tataUsaha as $t)
                                        <option value="{{ $t->id }}">{{ $t->nama }}</option>
                                    @endforeach

                                    <!-- Tambahkan opsi nama pegawai TU lainnya di sini -->
                                </select>
                            </div>

                            <div class="form-group" id="pegawaiSelect" style="display: none;">
                                <label for="pegawai">Pilih Pegawai:</label>
                                <select class="form-control" id="pegawai" name="pegawai">
                                    <option value="">Pilih pegawai</option>
                                    @foreach ($pegawai as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach

                                    <!-- Tambahkan opsi nama pegawai lainnya di sini -->
                                </select>
                            </div>

                            <div class="form-group" id="lainnyaInput" style="display: none;">
                                <label for="lainnya">Biaya Lainnya:</label>
                                <input type="text" class="form-control" id="lainnya" name="biayaLainnya"
                                    placeholder="Masukkan biaya lainnya">
                            </div>

                            <script>
                                function showInput() {
                                    var kategoriSelect = document.getElementById("kategori");
                                    var guruSelect = document.getElementById("guruSelect");
                                    var tuSelect = document.getElementById("tuSelect");
                                    var pegawaiSelect = document.getElementById("pegawaiSelect");
                                    var lainnyaInput = document.getElementById("lainnyaInput");

                                    if (kategoriSelect.value === "Gaji Guru") {
                                        guruSelect.style.display = "block";
                                        tuSelect.style.display = "none";
                                        pegawaiSelect.style.display = "none";
                                        lainnyaInput.style.display = "none";
                                    } else if (kategoriSelect.value === "Gaji TU") {
                                        guruSelect.style.display = "none";
                                        tuSelect.style.display = "block";
                                        pegawaiSelect.style.display = "none";
                                        lainnyaInput.style.display = "none";
                                    } else if (kategoriSelect.value === "Gaji Pegawai") {
                                        guruSelect.style.display = "none";
                                        tuSelect.style.display = "none";
                                        pegawaiSelect.style.display = "block";
                                        lainnyaInput.style.display = "none";
                                    } else if (kategoriSelect.value === "Biaya Lainnya") {
                                        guruSelect.style.display = "none";
                                        tuSelect.style.display = "none";
                                        pegawaiSelect.style.display = "none";
                                        lainnyaInput.style.display = "block";
                                    } else {
                                        guruSelect.style.display = "none";
                                        tuSelect.style.display = "none";
                                        pegawaiSelect.style.display = "none";
                                        lainnyaInput.style.display = "none";
                                    }
                                }
                            </script>


                            <div class="form-group">
                                <label for="metode">Metode Pembayaran:</label>
                                <select class="form-control" id="metode" onchange="checkMetodePembayaran()"
                                    name="metode">
                                    <option value="">Pilih metode pembayaran</option>
                                    <option value="Tunai">Tunai</option>
                                    <option value="Transfer">Transfer</option>
                                    <option value="Lainya">Lainya</option>
                                </select>
                            </div>

                            <div class="form-group" id="formLainya" style="display: none;">
                                <label for="metodeLainya">Metode Pembayaran Lainya:</label>
                                <input type="text" class="form-control" id="metodeLainya"
                                    placeholder="Masukkan metode pembayaran lainya" name="metodeLainnya">
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi:</label>
                                <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi"></textarea>
                            </div>


                            <script>
                                function checkMetodePembayaran() {
                                    var metodePembayaran = document.getElementById("metode").value;
                                    var formLainya = document.getElementById("formLainya");

                                    if (metodePembayaran === "Lainya") {
                                        formLainya.style.display = "block";
                                    } else {
                                        formLainya.style.display = "none";
                                    }
                                }
                            </script>

                            <div class="form-group">
                                <label for="exampleInputFile">Input Bukti Transaksi</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" onchange="showFileName(event)"
                                            class="custom-file-input" id="exampleInputFile" name="bukti_transaksi">
                                        <label class="custom-file-label" for="exampleInputFile" id="file-label">

                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div id="preview-container" style="display: none;">
                                <img id="preview-image" style="width: 300px" class="img-fluid" src="#"
                                    alt="Preview">
                            </div>
                    </div>

                    <script>
                        function showFileName(event) {
                            var input = event.target;
                            var fileName = input.files[0].name;
                            document.getElementById("file-label").textContent = fileName;

                            var previewContainer = document.getElementById("preview-container");
                            var previewImage = document.getElementById("preview-image");
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();

                                reader.onload = function(e) {
                                    previewImage.src = e.target.result;
                                };

                                previewContainer.style.display = "block";
                                reader.readAsDataURL(input.files[0]);
                            } else {
                                previewContainer.style.display = "none";
                            }
                        }
                    </script>
                    <div style="display: flex; justify-content: center;">
                        <button type="submit" class="btn btn-success mb-4" style="width: 50%;">Submit</button>
                    </div>

                    </form>
                </div>
            </div>
            <script>
                function toggleBiayaLainnya() {
                    var kategori = document.getElementById("kategori").value;
                    var formBiayaLainnya = document.getElementById("formBiayaLainnya");

                    if (kategori === "Biaya Lainnya") {
                        formBiayaLainnya.style.display = "block";
                    } else {
                        formBiayaLainnya.style.display = "none";
                    }
                }
            </script>
        </div>
    </div>
@endsection
