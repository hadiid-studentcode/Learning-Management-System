@extends('layouts.main')

@section('main')
    <div class="">
        <div class="card card-custom">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    <h2 class="jumbotron-heading text-center">Laporan Kesalahan Input Keuangan</h2>
                    <p class="lead text-muted text-center" style="font-size:18px;">Silahkan Pilih Waktu dan Cek laporan kesalahan input
                        dalam rekap Keuangan Sekolah.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="container mt-2">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <h4 class="text-center text-uppercase mt-2">Tanggal Laporan</h4>
                        <hr>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <form>
                                    <div class="form-group">
                                        <label for="tanggal">Pilih Tanggal:</label>
                                        <input type="date" class="form-control" id="tanggalLaporan">
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary mx-2" onclick="tampilkanLaporan()">Tampilkan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="" id="laporanContainer">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="data_table1" class="table table-striped table-bordered" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th colspan="6"> <h5 class="text-center">Daftar Laporan Kesalahan Input Pemasukkan</h5></th>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Tarif</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="laporanTableBody">
                                    @foreach ($pemasukkan as $p)
                                        <tr>
                                            <td>{{ $p->tanggal }}</td>
                                            <td>{{ $p->pembayaran }}</td>
                                            <td class="rupiah-format">Rp.{{ number_format($p->tarif, 0, '.', '.') }}</td>

                                            <td class="rupiah-format">Rp.{{ number_format($p->nominal, 0, '.', '.') }}</td>
                                            <td>{{ $p->report }}</td>
                                            <td>
                                                <button class="btn btn-success btn-detail" data-toggle="modal"
                                                    data-target="#confirmIzinModalLabel_{{ $p->no_transaksi }}">
                                                    <i class="fas fa-check"></i>
                                                </button>



                                                <!-- Modal -->
                                                <div class="modal fade" id="confirmIzinModalLabel_{{ $p->no_transaksi }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="confirmIzinModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="confirmDeleteModalLabel">
                                                                    Konfirmasi Laporan </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin mengizinkan nya?
                                                            </div>

                                                            <form
                                                                action="{{ url('/super-user/laporan-keuangan/pemasukkan/diterima/' . $p->no_transaksi) }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Batal</button>

                                                                    <button type="submit" class="btn btn-success">Ya</button>

                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- akhir modal --}}

                                                <button class="btn btn-danger btn-detail" data-toggle="modal"
                                                    data-target="#confirmNoModalLabel_{{ $p->no_transaksi }}">
                                                    <i class="fas fa-times"></i>
                                                </button>

                                                {{-- modal --}}
                                                <div class="modal fade" id="confirmNoModalLabel_{{ $p->no_transaksi }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="confirmNoModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="confirmNoModalLabel">
                                                                    Konfirmasi Laporan</h5>
                                                                <button type="submit" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah anda yakin tidak ingin mengizinkan nya?
                                                            </div>
                                                            <form
                                                                action="{{ url('/super-user/laporan-keuangan/pemasukkan/ditolak/' . $p->no_transaksi) }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Batal</button>

                                                                    <button type="submit" class="btn btn-danger">Ya</button>

                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- akhir modal --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                          </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="" id="laporanContainer">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="data_table" class="table table-striped table-bordered" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th colspan="6"> <h5 class="text-center">Daftar Laporan Kesalahan Input Pengeluaran</h5></th>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Tarif</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="laporanTableBody">
                                    @foreach ($pengeluaran as $pn)
                                        <tr>
                                            <td>{{ $pn->tanggal }}</td>
                                            <td>{{ $pn->pembayaran }}</td>
                                            <td class="rupiah-format">-</td>
                                            <td class="rupiah-format">Rp.{{ number_format($pn->nominal, 0, '.', '.') }}</td>
                                            <td>{{ $pn->report }}</td>
                                            <td>
                                                <button class="btn btn-success btn-detail" data-toggle="modal"
                                                    data-target="#confirmIzinModalLabel_{{ $pn->no_transaksi }}">
                                                    <i class="fas fa-check"></i>
                                                </button>
    
    
    
                                                <!-- Modal -->
                                                <div class="modal fade" id="confirmIzinModalLabel_{{ $pn->no_transaksi }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="confirmIzinModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="confirmDeleteModalLabel">
                                                                    Konfirmasi Laporan</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin mengizinkan nya?
                                                            </div>
                                                            <form
                                                                action="{{ url('/super-user/laporan-keuangan/pengeluaran/diterima/' . $pn->no_transaksi) }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Batal</button>
    
                                                                    <button type="submit" class="btn btn-success">Ya</button>
    
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- akhir modal --}}
    
                                                <button class="btn btn-danger btn-detail" data-toggle="modal"
                                                    data-target="#confirmNoModalLabel_{{ $pn->no_transaksi }}">
                                                    <i class="fas fa-times"></i>
                                                </button>
    
                                                {{-- modal --}}
                                                <div class="modal fade" id="confirmNoModalLabel_{{ $pn->no_transaksi }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="confirmNoModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="confirmNoModalLabel">
                                                                    Konfirmasi Laporan</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah anda yakin tidak ingin mengizinkan nya?
                                                            </div>
                                                            <form
                                                                action="{{ url('/super-user/laporan-keuangan/pengeluaran/ditolak/' . $pn->no_transaksi) }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Batal</button>
    
                                                                    <button type="submit" class="btn btn-danger">Ya</button>
    
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- akhir modal --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                          </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>





    <script>
        function formatRupiah(angka) {
            var rupiah = '';
            var angkarev = angka.toString().split('').reverse().join('');
            for (var i = 0; i < angkarev.length; i++) {
                if (i % 3 == 0) {
                    rupiah += angkarev.substr(i, 3) + '.';
                }
            }
            return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
        }

        document.addEventListener("DOMContentLoaded", function() {
            var detailButtons = document.querySelectorAll(".btn-detail");
            var modal = new bootstrap.Modal(document.getElementById("detailModal"));

            detailButtons.forEach(function(button) {
                button.addEventListener("click", function() {
                    modal.show();
                });
            });

            var rupiahElements = document.querySelectorAll('.rupiah-format');
            rupiahElements.forEach(function(element) {
                var nominal = parseFloat(element.textContent.replace('.', '').replace('Rp. ', ''));
                element.textContent = formatRupiah(nominal);
            });
        });
    </script>
@endsection
