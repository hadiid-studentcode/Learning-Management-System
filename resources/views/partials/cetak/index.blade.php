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

        table tr td {
            vertical-align: top;
        }

        table p {
            margin: 0;
        }

        .border-dark {
            background-color: #000;
        }

        /* Your existing CSS styles */
        .custom-table {
            margin-left: 1.25rem;
            border: 0;
            width: 760px;
        }

        .custom-table td {
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
        .payment-moon {
            
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="header">
                <p>SD MUHAMMADIYAH FULL DAY SCHOOL</p>
                <h5>BUKTI PEMBAYARAN</h5>
            </div>
            <p class="mb-2">Jl. KH. Ahmad Dahlan No. 34 Desa Kampar, Kecamatan Kampar</p>
            <p>Kampar - Riau Kode Pos 28461 Telp/Fax. 085265649245</p>

            <hr class="border-dark">

            <table class="custom-table">
                <tr>
                    <td>Diterima dari</td>
                    <td>: {{ $siswa->nama }} </td>
                    <td>Kelas</td>
                    <td>: {{ $siswa->kelas }} {{ $siswa->rombel }}</td>
                </tr>
                <tr>
                    <td>Tgl. Bayar</td>
                    <td>: {{ $tanggal }}</td>
                    <td>Operator</td>
                    <td>: Reni Sri Rahayu</td>
                </tr>
                <tr>
                    <td>Nomor induk</td>
                    <td>: {{ $siswa->nisn }}</td>
                    {{-- <td>Terbilang</td>
                    <td>: Dua Puluh Ribu </td> --}}
                </tr>
                <tr>
                    <td>No. Bukti</td>
                    <td>: {{ $pembayaran->bukti_transaksi }}</td>
                </tr>
            </table>

            <hr class="border-dark">

            <h5>Dengan rincian pembayaran sebagai berikut : </h5>

            <hr class="border-dark">

            <table>
                <tr class="payment-moon">
                    <td>{{ $pembayaran->pembayaran }}</td>

                    <td>| Rp. {{ number_format($pembayaran->tarif, 0, '.', '.') }}</td>

                </tr>
            </table>

            <hr class="border-dark">

            <table class="table table-borderless">
                <tr>
                    <td>
                        <p style="margin-left: 30%">Penyetor</p>
                    </td>
                    <td>
                        <p style="margin-left: 55%">Penerima</p>
                    </td>
                    <td>
                        <p class="d-flex" style="margin-left: 190%;">Jumlah: </p>
                    </td>

                    <td>
                        <p class="d-flex" style="margin-left: 172%;">Rp.{{ number_format($pembayaran->tarif, 0, '.', '.') }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="d-flex" style="margin-left: 258%;">Pembayaran: </p>
                    </td>

                    <td>
                        <p class="d-flex" style="margin-left: 190%;">Rp.{{ number_format($pembayaran->nominal, 0, '.', '.') }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="d-flex" style="margin-left: 281%;">Status: </p>
                    </td>

                    <td>
                        <p class="d-flex" style="margin-left: 190%;">{{ $pembayaran->deskripsi }}</p>
                    </td>
                </tr>
                <tr>
                    {{-- <td>
                        <img src="Img/1692935731892.png" alt="Tanda Tangan"
                            style="margin-left: 33px; max-width: 130px;" />
                    </td> --}}

                    {{-- <td>
                        <img src="  https://theinvestor.id/wp-content/uploads/2020/07/Ttd.png" alt="Tanda Tangan"
                            style="margin-left: 33px; max-width: 130px;" />
                    </td> --}}





                </tr>

                <tr>
                    <td>
                        <p>(.........................................)</p>
                    </td>
                    <td>
                        <p style="margin-left: 80px">(RENI SRI RAHAYU)</p>
                    </td>
                </tr>

            </table>
        </div>
    </div>
    </div>

    <script>
        window.print();
    </script>



</body>

</html>
