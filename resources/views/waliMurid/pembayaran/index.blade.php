@extends('layouts.main')

@section('main')
    <div class="row-fluid">
        <div style="position: relative;" class="widget span12">
            <div class="widget-body">
                <div class="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="widget">
                                <div class="widget-body">
                                    <div class="table-responsive">
                                           <table class="table table-striped table-bordered">
                                                <tr>
                                                    <td>Nama</td>
                                                    <td>{{ $siswa->nama }}</td>
                                                    <td>Wali Kelas</td>
                                                    <td>: {{ $siswa->guru }}<sup></sup></td>
                                                </tr>
                                                <tr>
                                                    <td>NISN</td>
                                                    <td>: {{ $siswa->nisn }}</td>
                                                    <td>Kelas</td>
                                                    <td>: {{ $siswa->kelas }} {{ $siswa->rombel }}</td>
                                                </tr>
                                            </table>
                                    </div>
                                 


                                </div>
                                @foreach ($pembayaran as $p)
                                    <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td colspan="6" style="background:#28a745;color: #fff;">TA
                                                            <b>{{ $p->tahun_ajaran }}</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 400px;">Nama Tagihan</th>
                                                        <th>Jumlah Tagihan</th>
                                                        <th>Jumlah Dibayar</th>
                                                        <th>Sisa Tagihan</th>
                                                        <th>Status</th>
                                                        <th style="width: 15%; text-align:center;">Bukti Pembayaran</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $p->pembayaran }}</td>
                                                        <td>Rp. {{ number_format($p->tarif, 0, ',', '.') }}</td>
                                                        <td>Rp. {{ number_format($p->nominal, 0, ',', '.') }}</td>
                                                        <td>Rp. {{ number_format($p->sisa, 0, ',', '.') }}</td>
                                                        <td><span class="label label-success">{{ $p->deskripsi }}</span>
                                                        </td>
                                                        <td style="text-align: center;">

                                                            <button type="button" class="btn btn-link" data-toggle="modal"
                                                                data-target="#buktiModal_{{ $p->no_transaksi }}">
                                                                <svg fill="#000000" width="30px" height="30px"
                                                                    viewBox="0 0 1920 1920"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <g fill-rule="evenodd">
                                                                        <path fill-rule="nonzero"
                                                                            d="M0 53v1813.33h1386.67v-320H1280v213.34H106.667V159.667H1280V373h106.67V53z" />
                                                                        <path
                                                                            d="M1226.67 1439.67c113.33 0 217.48-39.28 299.6-104.96l302.37 302.65c20.82 20.84 54.59 20.85 75.42.04 20.84-20.82 20.86-54.59.04-75.43l-302.41-302.68c65.7-82.12 104.98-186.29 104.98-299.623 0-265.097-214.91-480-480-480-265.1 0-480.003 214.903-480.003 480 0 265.093 214.903 480.003 480.003 480.003Zm0-106.67c206.18 0 373.33-167.15 373.33-373.333 0-206.187-167.15-373.334-373.33-373.334-206.19 0-373.337 167.147-373.337 373.334 0 206.183 167.147 373.333 373.337 373.333Z" />
                                                                    </g>
                                                                </svg>
                                                            </button>
                                                            <div class="modal fade" id="buktiModal_{{ $p->no_transaksi }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="buktiModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="buktiModalLabel">
                                                                                Bukti Pembayaran</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <h6>Detail Pembayaran:</h6>
                                                                                        <p>{{ $p->pembayaran }}</p>
                                                                                        <p>Tanggal Pembayaran:
                                                                                            {{ $tanggal }}</p>
                                                                                        <p>Jumlah Pembayaran:
                                                                                            Rp.{{ number_format($p->nominal, 0, ',', '.') }}
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <h6>Status Pembayaran</h6>
                                                                                        <p style="font-size: 30px">
                                                                                            {{ $p->deskripsi }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                            @php
                                                                                $image_path = 'storage/tata_usaha/pemasukan/' . $p->bukti_transaksi . '.pdf';
                                                                                if (File::exists($image_path)) {
                                                                                    $path = $image_path;
                                                                                } else {
                                                                                    $path = null;
                                                                                }
                                                                            @endphp

                                                                            @if (!$path == null)
                                                                                <div class="text-center mt-3">
                                                                                    <a href="{{ asset('/storage/tata_usaha/pemasukan/' . $p->bukti_transaksi . '.pdf') }}"
                                                                                        target="_blank"
                                                                                        class="btn btn-primary"
                                                                                        download>Download</a>
                                                                                    <button type="button"
                                                                                        class="btn btn-success"
                                                                                        data-dismiss="modal">Close</button>
                                                                                </div>
                                                                            @endif

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Sertakan file CSS dan JavaScript Bootstrap -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


        </div>
    </div>
    </div>
@endsection
