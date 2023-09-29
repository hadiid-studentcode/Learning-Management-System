<!DOCTYPE html>
<html>

<head>
    <style>
        .container {
            width: 800px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }

        .card {
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #fff;
        }

        table p {
            margin: 0;
        }

        .border-dark {
            background-color: #000;
        }

        .custom-table td {
            width: 25%;
            padding: 0.4rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 10px;
        }

        .signature img {
            max-width: 110px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 10px;
        }

        .payment-info {
            margin-bottom: 40%;
            margin-right: 20px;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .total {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="header">
                <p>SD MUHAMMADIYAH FULL DAY SCHOOL</p>
                <h5>BUKTI REKAP KEUANGAN @if($jenis == 'rekap keuangan search') ( {{ strtoupper($bulan) }} {{ $tahunAjaran }} ) @else @endif</h5>
            </div>
            <p class="mb-2">Jl. KH. Ahmad Dahlan No. 34 Desa Kampar, Kecamatan Kampar</p>
            <p>Kampar - Riau Kode Pos 28461 Telp/Fax. 085265649245</p>

            <hr class="border-dark">

            <table class="custom-table" style="text-align: center;">
                <tr>
                    <th>Tanggal</th>
                    <th>Pembarayan</th>
                    <th>Deskripsi</th>
                    <th>Jenis</th>
                    <th>Saldo</th>
                </tr>
                @if ($jenis == 'rekap keuangan')
                    @foreach ($rekapKeuangan as $rk)
                        <tr>
                            <td>{{ $rk->tanggal }}</td>
                            <td>{{ $rk->pembayaran }}</td>
                            <td>{{ $rk->deskripsi }}</td>
                            <td>{{ $rk->jenis }}</td>
                            <td>Rp.{{ number_format($rk->nominal, 0, '.', '.') }}</td>
                        </tr>
                    @endforeach
                @elseif($jenis == 'rekap keuangan search')
                    @foreach ($rekapKeuanganSearch as $rks)
                        <tr>
                            <td>{{ $rks->tanggal }}</td>
                            <td>{{ $rks->pembayaran }}</td>
                            <td>{{ $rks->deskripsi }}</td>
                            <td>{{ $rks->jenis }}</td>
                            <td>Rp.{{ number_format($rks->nominal, 0, '.', '.') }}</td>
                        </tr>
                    @endforeach
                @else
                @endif



            </table>

            <hr class="border-dark">

            <div class="row">
                <div class="col-md-4">
                    <div class="penerima">
                        <img src="{{ asset('/assets/images/TTD.png') }}" alt="Tanda Tangan" class="img-fluid"
                            style="max-width: 110px;" />
                        <p style="margin-top: -1%;">(RENI SRI RAHAYU)</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="payment-info">
                        <table>
                           
                            @if ($jenis == 'rekap keuangan')
                                <tr>
                                    <td>Total Pemasukan:</td>
                                    <td>: Rp.{{ number_format($total['pemasukan'], 0, '.', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Total Pengeluaran</td>
                                    <td>: Rp.{{ number_format($total['pengeluaran'], 0, '.', '.') }}</td>
                                </tr>
                            @elseif($jenis == 'rekap keuangan search')
                                <tr>
                                    <td>Total Pemasukan:</td>
                                    <td>: Rp.{{ number_format($totalSearch['pemasukan'], 0, '.', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Total Pengeluaran</td>
                                    <td>: Rp.{{ number_format($totalSearch['pengeluaran'], 0, '.', '.') }}</td>
                                </tr>
                            @else
                            @endif

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        window.print();
    </script>

</body>

</html>
