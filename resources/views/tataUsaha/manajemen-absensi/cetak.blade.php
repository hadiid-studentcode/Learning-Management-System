<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Absensi Guru dan Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .statistics-list {
            list-style: none;
            padding: 0;
        }

        .statistics-list li {
            margin-bottom: 8px;
            padding: 8px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            table {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>

    <table>
        <thead>
            <tr>
                <th colspan="4">Laporan Absensi Guru {{ $dateGuru }}</th>
            </tr>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Waktu</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($guru as $g)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $g->nama }}</td>
                    <td>{{ $g->waktu }}</td>
                    <td>{{ $g->status }}</td>
                </tr>
            @endforeach


            <!-- Tambahkan data lainnya sesuai kebutuhan -->
        </tbody>


    </table>

    <div class="mt-4">
        <h5>Total Statistics:</h5>
        <ul class="statistics-list">
            <li>Total Hadir: {{ $totalHadir_guru }}</li>
            <li>Total Izin: {{ $totalIzin_guru }}</li>
            <li>Total Sakit: {{ $totalSakit_guru }}</li>
            <li>Total Terlambat: {{ $totalTerlambat_guru }}</li>
            <li>Total Mangkir: {{ $totalMangkir_guru }}</li>
        </ul>
    </div>
    <table>
        <thead>
            <tr>
                <th colspan="4">Laporan Absensi Pegawai {{ $datePegawai }}</th>
            </tr>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Waktu</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($pegawai as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->waktu }}</td>
                    <td>{{ $p->status }}</td>
                </tr>
            @endforeach



            <!-- Tambahkan data lainnya sesuai kebutuhan -->
        </tbody>
    </table>
    <div class="mt-4">
        <h5>Total Statistics:</h5>
        <ul class="statistics-list">
            <li>Total Hadir: {{ $totalHadir_pegawai }}</li>
            <li>Total Izin: {{ $totalIzin_pegawai }}</li>
            <li>Total Sakit: {{ $totalSakit_pegawai }}</li>
            <li>Total Terlambat: {{ $totalTerlambat_pegawai }}</li>
            <li>Total Mangkir: {{ $totalMangkir_pegawai }}</li>
        </ul>
    </div>


    <!-- Tambahkan elemen lain atau tabel lain sesuai kebutuhan -->

    <script>
        window.print();
    </script>

</body>

</html>
