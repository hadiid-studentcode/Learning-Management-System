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
                            <a class="nav-link active" href="{{ url('/tata-usaha/pemasukan') }}"
                                onclick="showPage('input')">
                                <span class="nav-icon">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <span class="svg-icon ">Masuk</span>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/tata-usaha/pengeluaran') }}"
                                onclick="showPage('pengeluaran')">
                                <span class="nav-icon">
                                    <span class="nav-icon">
                                       
                                        <i class="fas fa-money-bill-alt"></i>
                                        <span class="svg-icon">Keluar</span>
                                    </span>
                                </span>
                            </a>
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


    <div id="input" class="page">
        <div class="">
            <div class="">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Input Pemasukan Keuangan Sekolah</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ asset('/tata-usaha/pemasukan') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="tanggal">Tanggal Transaksi:</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>

                            <div class="form-group">
                                <label for="kategori">kategori Transaksi:</label>
                                <input type="text" class="form-control" id="kategori" name="kategori" required>
                            </div>

                            <div class="form-group">
                                <label for="nominalmasuk">Nominal:</label>
                                <input type="text" class="form-control" id="nominalmasuk" name="nominal" required>
                            </div>

                            <script>
                                var nominalInput = document.getElementById('nominalmasuk');
                                nominalInput.addEventListener('input', formatRupiah);

                                function formatRupiah() {
                                    var nilai = nominalInput.value;
                                    var nilaiClean = nilai.replace(/\D/g, '');
                                    var numericalValue = parseInt(nilaiClean, 10);
                                    var maxLimit = 100000000; // 100 million

                                    if (numericalValue > maxLimit) {
                                        nominalInput.value = formatNumberToRupiah(maxLimit);
                                    } else {
                                        var nilaiFormatted = formatNumberToRupiah(nilaiClean);
                                        nominalInput.value = nilaiFormatted;
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
                                <label for="pengirim">Pengirim:</label>
                                <input type="text" class="form-control" id="pengirim" name="pengirim" required>
                            </div>

                            <div class="form-group">
                                <label for="metode">Metode Pembayaran:</label>
                                <select class="form-control" id="metode" onchange="checkMetodePembayaran()"
                                    name="metode">
                                    <option value="" hidden>Pilih metode</option>
                                    <option value="Tunai">Tunai</option>
                                    <option value="Transfer">Transfer</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi Transaksi:</label>
                                <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi" required></textarea>
                            </div>

                            {{-- <div class="form-group">
                                <label for="exampleInputFile">Input Bukti Transaksi</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" onchange="showFileName(event)"
                                            class="custom-file-input" id="exampleInputFile" name="bukti_transaksi">
                                        <label class="custom-file-label" for="exampleInputFile" id="file-label">

                                        </label>
                                    </div>
                                </div>
                            </div> --}}
                            <div id="preview-container" style="display: none;">
                                <img id="preview-image" style="width: 300px" class="img-fluid" src="#"
                                    alt="Preview">
                            </div>

                            <div style="display: flex; justify-content: center;">
                                <button type="submit" class="btn btn-success mb-4" style="width: 50%;">Submit</button>
                            </div>

                        </form>
                    </div>
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

        </div>
    </div>
@endsection
