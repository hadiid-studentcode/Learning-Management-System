@extends('layouts.main')

@section('main')
    <div class="">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    <h2 class="text-dark-75 text-hover-success font-size-h1">Rekap Data Keuangan</h2>
                    <p class="lead text-muted text-center">Mohon Pilih Tahun Ajaran dan bulan yang ingin dilihat rekap keuangannya.</p>
                </div>
            </div>
        </div>
    </div>


    <div id="rekap" class="page">
        <div class="" id="rekap">
            <div class="">
                <div class="card card-custom">
                    <div class="card-body">
                        <form action="{{ url('/super-user/rekap-keuangan/search?') }}" method="GET">
                            <div class="form-group row">
                                <label for="tahunAjaran" class="col-sm-2 col-form-label">Tahun Ajaran:</label>
                                <div class="col-sm-10">
                                    <select id="tahunAjaran" name="tahunAjaran" class="form-control" required>
                                        @if (isset($tahunAjaranWhereid))
                                            <option value="{{ $tahunAjaranWhereid->id }}" hidden>
                                                {{ $tahunAjaranWhereid->tahun_ajaran }}</option>
                                        @else
                                            <option value="" hidden>Pilih Tahun Ajaran</option>
                                        @endif
                                        @foreach ($tahunAjaran as $ta)
                                            <option value="{{ $ta->id }}">{{ $ta->tahun_ajaran }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="bulan" class="col-sm-2 col-form-label">Bulan:</label>
                                <div class="col-sm-10">
                                    <select id="bulan" name="bulan" class="form-control" required>

                                        @if (isset($montDay) && isset($month))
                                            <option value="{{ $montDay }}-{{ $month }}" hidden>
                                                {{ $month }}</option>
                                        @else
                                            <option value="" hidden>Pilih Bulan</option>
                                        @endif

                                        <option value="1-Januari">Januari</option>
                                        <option value="2-Februari">Februari</option>
                                        <option value="3-Maret">Maret</option>
                                        <option value="4-April">April</option>
                                        <option value="5-Mei">Mei</option>
                                        <option value="6-Juni">Juni</option>
                                        <option value="7-Juli">Juli</option>
                                        <option value="8-Agustus">Agustus</option>
                                        <option value="9-September">September</option>
                                        <option value="10-Oktober">Oktober</option>
                                        <option value="11-November">November</option>
                                        <option value="12-Desember">Desember</option>
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

            <div id="tableContainer " class="">
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="data_table" class="table table-bordered table-striped" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th style="width: 10%">No</th>
                                    <th style="width: 10%">Tanggal</th>
                                        <th style="width: 15%">Pembarayan</th>
                                        <th>Deskripsi</th>
                                        <th style="width: 15%">Jenis</th>
                                        <th>Saldo</th>
                                        <th style="width: 10%;">Bukti</th>
                                    </tr>
                                </thead>
                                <tbody id="rekapTableBody">

                                    @if (isset($rekapKeuanganSearch))
                                        @foreach ($rekapKeuanganSearch as $rks)
                                            <tr>

                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $rks->tanggal }}</td>
                                                <td>{{ $rks->pembayaran }}</td>
                                                <td>{{ $rks->jenis }}</td>
                                                <td>{{ $rks->deskripsi }}</td>
                                                <td>Rp.{{ number_format($rks->nominal, 0, '.', '.') }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-success" data-toggle="modal"
                                                        data-target="#modalReceipts_{{ $rks->no_transaksi }}">
                                                        <i class="fa fa-eye"></i>
                                                    </button>

                                                    <!-- Modal for receipts -->
                                                    <div class="modal fade" id="modalReceipts_{{ $rks->no_transaksi }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="modalReceiptsLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="buktiModalLabel">Bukti
                                                                        Pembayaran {{ $rks->no_transaksi }}</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-8">
                                                                                <h6
                                                                                    style="font-weight: bold; text-align: left;">
                                                                                    Detail Pembayaran :</h6>
                                                                                <p style="text-align: left;">
                                                                                    {{ $rks->pembayaran }}</p>

                                                                                <h6
                                                                                    style="font-weight: bold; text-align: left;">
                                                                                    Tanggal Pembayaran :</h6>
                                                                                <p style="text-align: left;">
                                                                                    {{ $rks->tanggal }}</p>

                                                                                <h6
                                                                                    style="font-weight: bold; text-align: left;">
                                                                                    Jumlah Pembayaran :</h6>
                                                                                <p style="text-align: left;">
                                                                                    Rp.{{ number_format($rks->nominal, 0, '.', '.') }}
                                                                                </p>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <h4 style="font-weight: 300">Deskripsi
                                                                                    Pembayaran</h4>
                                                                                <p style="font-size: 2em">
                                                                                    {{ $rks->deskripsi }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-center mt-3">
                                                                        <a href="{{ asset('/storage/tata_usaha/pemasukan/' . $rks->bukti_transaksi . '.pdf') }}"
                                                                            target="_blank" class="btn btn-success"
                                                                            download>Download</a>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                    </div>

                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>


                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @foreach ($rekapKeuangan as $rk)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $rk->tanggal }}</td>
                                                <td>{{ $rk->pembayaran }}</td>
                                                <td>{{ $rk->jenis }}</td>
                                                <td>{{ $rk->deskripsi }}</td>
                                                <td>Rp.{{ number_format($rk->nominal, 0, '.', '.') }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-success" data-toggle="modal"
                                                        data-target="#modalReceipts_{{ $rk->no_transaksi }}">
                                                        <i class="fa fa-eye"></i>
                                                    </button>

                                                    <!-- Modal for receipts -->
                                                    <div class="modal fade" id="modalReceipts_{{ $rk->no_transaksi }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="modalReceiptsLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="buktiModalLabel">Bukti
                                                                        Pembayaran {{ $rk->no_transaksi }}</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-8">
                                                                                <h6
                                                                                    style="font-weight: bold; text-align: left;">
                                                                                    Detail Pembayaran :</h6>
                                                                                <p style="text-align: left;">
                                                                                    {{ $rk->pembayaran }}</p>

                                                                                <h6
                                                                                    style="font-weight: bold; text-align: left;">
                                                                                    Tanggal Pembayaran :</h6>
                                                                                <p style="text-align: left;">
                                                                                    {{ $rk->tanggal }}</p>

                                                                                <h6
                                                                                    style="font-weight: bold; text-align: left;">
                                                                                    Jumlah Pembayaran :</h6>
                                                                                <p style="text-align: left;">
                                                                                    Rp.{{ number_format($rk->nominal, 0, '.', '.') }}
                                                                                </p>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <h4 style="font-weight: 300">Deskripsi
                                                                                    Pembayaran</h4>
                                                                                <p style="font-size: 2em">
                                                                                    {{ $rk->deskripsi }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-center mt-3">

                                                                        @if ($rk->jenis == 'Pemasukan')
                                                                            @php
                                                                                $filePath = 'storage/tata_usaha/pemasukan/' . $rk->bukti_transaksi . '.pdf';
                                                                            @endphp
                                                                            @if (Illuminate\Support\Facades\File::extension($filePath) == 'pdf')
                                                                                {{-- Tampilkan PDF --}}


                                                                                <a href="{{ asset($filePath) }}"
                                                                                    target="_blank"
                                                                                    class="btn btn-success"
                                                                                    download>Download</a>
                                                                            @else
                                                                                {{-- Tampilkan Gambar --}}



                                                                                <a href="{{ asset($filePath . '.jpg') }}"
                                                                                    target="_blank"
                                                                                    class="btn btn-success"
                                                                                    download>Download</a>
                                                                            @endif
                                                                        @else
                                                                            <a href="{{ asset('storage/tata_usaha/pengeluaran/' . $rk->bukti_transaksi) }}"
                                                                                target="_blank" class="btn btn-success"
                                                                                download>Download</a>
                                                                        @endif


                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                                <tfoot>

                                    @if (isset($totalPemasukanSearch) || isset($totalPengeluaranSearch))
                                        <tr>
                                            <td colspan="5" style="text-align: right;"><strong>Total
                                                    Pemasukan:</strong>
                                            </td>
                                            <td colspan="2">
                                                <strong>Rp.{{ number_format($totalPemasukanSearch, 0, '.', '.') }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" style="text-align: right;"><strong>Total
                                                    Pengeluaran:</strong>
                                            </td>
                                            <td colspan="2">
                                                <strong>Rp.{{ number_format($totalPengeluaranSearch, 0, '.', '.') }}</strong>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="5" style="text-align: right;"><strong>Total
                                                    Pemasukan:</strong>
                                            </td>
                                            <td colspan="2">
                                                <strong>Rp.{{ number_format($totalPemasukan, 0, '.', '.') }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" style="text-align: right;"><strong>Total
                                                    Pengeluaran:</strong>
                                            </td>
                                            <td colspan="2">
                                                <strong>Rp.{{ number_format($totalPengeluaran, 0, '.', '.') }}</strong>
                                            </td>
                                        </tr>
                                    @endif
                                </tfoot>
                            </table>
                        </div>



                        @if (isset($rekapKeuanganSearch))
                            <a class="btn mb-4 mt-4 btn-success print-button"
                                href="{{ url('/super-user/rekap-keuangan/cetak/' . $tahunAjaranWhereid->id . '/' . $montDay . '-' . $month) }}"
                                target="_blank">Cetak
                                Laporan</a>
                        @else
                            <a class="btn mb-4 mt-4 btn-success print-button"
                                href="{{ url('/super-user/rekap-keuangan/cetak/' . date('now') . '/all') }}"
                                target="_blank">Cetak
                                Laporan</a>
                        @endif
                    </div>
                </div>

                <!-- Modal for receipts -->
                <div class="modal fade" id="modalReceipts" tabindex="-1" role="dialog"
                    aria-labelledby="modalReceiptsLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalReceiptsLabel">Struk Pembayaran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="carousel slide carousel-fade d-flex justify-content-center"
                                    id="carouselExampleControls" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="https://images.unsplash.com/photo-1607697987724-fc9f8b225223?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1169&q=80"
                                                class="d-block mx-auto img-fluid" alt="Receipt 1" style="width: 50%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
                <script>
                    $('#modalReceipts').on('show.bs.modal', function(e) {
                        $('.modal .modal-dialog').attr('class', 'modal-dialog animate__animated animate__fadeIn');
                    });

                    $('#modalReceipts').on('hide.bs.modal', function(e) {
                        $('.modal .modal-dialog').attr('class', 'modal-dialog animate__animated animate__fadeOut');
                    });
                </script>
            </div>
        </div>
    </div>

    <script>
        function showTable(event) {
            event.preventDefault();
            const tahunAjaran = document.getElementById("tahunAjaran").value;
            const bulan = document.getElementById("bulan").value;

            if (tahunAjaran && bulan) {
                document.getElementById("tableContainer").style.display = "block";
            } else {
                document.getElementById("tableContainer").style.display = "none";
            }
        }
        document.getElementById("tahunAjaran").addEventListener("change", showTable);
        document.getElementById("bulan").addEventListener("change", showTable);
    </script>


    </div>
@endsection
