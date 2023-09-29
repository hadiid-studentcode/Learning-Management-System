@extends('layouts.main')

@section('main')
 
    <div class="">
        <div class="card card-custom">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    <h2 class="text-dark-75 text-center ">Data Kinerja Guru</h2>
                    <p class="text-dark-50 text-center">Berikut adalah data guru dengan kinerja absensi dan mengajaranya.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="" id="table-container">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                            <div class="table-responsive">
                                <table id="data_table" class="table table-bordered table-striped"
                                    style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th colspan="9">
                                                <h5 class="text-center">Tabel Rekap Kinerja Guru</h5>
                                            </th>
                                        </tr>
                                        <tr class="success">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>NIG</th>
                                            <th>Bidang Studi</th>
                                            <th>Absensi</th>
                                            <th>Upload Materi</th>
                                            <th>Upload Tugas</th>
                                            <th>Total Kinerja</th>
                                            <th>Rata Rata</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-body">
                                        @foreach ($guru as $g)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $g->nama }}</td>
                                                <td>{{ $g->nig }}</td>
                                                <td>{{ $g->studi_keahlihan }}</td>
                                                <td>0</td>

                                                {{-- Inisialisasi total materi dan tugas --}}
                                                @php
                                                    $total_materi = 0;
                                                    $total_tugas = 0;
                                                    $jumlahPertemuan = 0;
                                                @endphp

                                                @foreach ($poin as $p)
                                                    @if ($p->id_guru == $g->id)
                                                        {{-- Tambahkan nilai materi dan tugas --}}
                                                        @php
                                                            $total_materi += $p->poin_upload_materi;
                                                            $total_tugas += $p->poin_upload_tugas;
                                                            
                                                            if ($p->poin_upload_materi || $p->poin_upload_tugas) {
                                                                $jumlahPertemuan++;
                                                            }
                                                        @endphp
                                                    @endif
                                                @endforeach

                                                {{-- Tampilkan total materi dan tugas --}}
                                                <td>{{ $total_materi }}</td>
                                                <td>{{ $total_tugas }}</td>

                                                {{-- Hitung total kinerja --}}
                                                @php
                                                    $total_kinerja = 0 + $total_materi + $total_tugas;
                                                    $total_kinerja_percent = $jumlahPertemuan > 0 ? ($total_kinerja / $jumlahPertemuan) * 100 : 0;
                                                @endphp

                                                {{-- Tampilkan total kinerja --}}
                                                <td>{{ $total_kinerja }}</td>
                                                <td>{{ number_format($total_kinerja_percent, 2) }} %</td>
                                            </tr>
                                        @endforeach
                                    </tbody>


                                </table>
                            </div>
            </div>
        </div>
    </div>








    {{-- 
<script>
    document.getElementById('search-form').addEventListener('submit', function(event) {
        event.preventDefault();

        var year = document.getElementById('year').value;
        var month = document.getElementById('month').value;

        var sampleData = [
            { no: 1, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 2, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 3, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 4, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 5, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 6, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 7, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 8, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 9, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 10, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 11, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 12, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
        ];


        var tableRows = '';
        for (var i = 0; i < sampleData.length; i++) {
            var data = sampleData[i];
            var totalKinerja = calculateTotalKinerja(data.kinerjaAbsensi, data.kinerjaMengajar);

            tableRows += '<tr>' +
                '<td>' + data.no + '</td>' +
                '<td>' + data.nama + '</td>' +
                '<td>' + data.nbm + '</td>' +
                '<td>' + data.walas + '</td>' +
                '<td>' + data.bidang + '</td>' +
                '<td>' + data.status + '</td>' +
                '<td>' + data.kinerjaAbsensi + '</td>' +
                '<td>' + data.kinerjaMengajar + '</td>' +
                '<td>' + totalKinerja + '</td>' +
                '</tr>';
        }

        var dataBody = document.getElementById('data-body');
        dataBody.innerHTML = tableRows;

    });

    function calculateTotalKinerja(kinerjaAbsensi, kinerjaMengajar) {
        var absensiPercentage = parseInt(kinerjaAbsensi) / 100;
        var mengajarPercentage = parseInt(kinerjaMengajar) / 100;
        var totalKinerja = (absensiPercentage + mengajarPercentage) / 2 * 100;
        return totalKinerja.toFixed(2) + '%';
    }
</script>
 --}}




    {{-- <script>
    document.getElementById('search-form').addEventListener('submit', function(event) {
        event.preventDefault();

        var year = document.getElementById('year').value;
        var month = document.getElementById('month').value;

        var sampleData = [
            { no: 1, nama: 'test', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '20%', kinerjaMengajar: '90%' },
            { no: 2, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 3, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 4, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 5, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 6, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 7, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 8, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 9, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 10, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 11, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
            { no: 12, nama: 'hadid andri yulison', nbm: '918239812739', walas: '4A', bidang: 'bahasa inggris', status: 'Kontrak', kinerjaAbsensi: '80%', kinerjaMengajar: '90%' },
        ];

        // Generate table rows based on the retrieved data
        var tableRows = '';
        for (var i = 0; i < sampleData.length; i++) {
            var data = sampleData[i];
            var totalKinerja = calculateTotalKinerja(data.kinerjaAbsensi, data.kinerjaMengajar);

            tableRows += '<tr>' +
                '<td>' + data.no + '</td>' +
                '<td>' + data.nama + '</td>' +
                '<td>' + data.nbm + '</td>' +
                '<td>' + data.walas + '</td>' +
                '<td>' + data.bidang + '</td>' +
                '<td>' + data.status + '</td>' +
                '<td>' + data.kinerjaAbsensi + '</td>' +
                '<td>' + data.kinerjaMengajar + '</td>' +
                '<td>' + totalKinerja + '</td>' +
                '</tr>';
        }

        // Update the table body with the generated rows
        var dataBody = document.getElementById('data-body');
        dataBody.innerHTML = tableRows;

    });

    // Function to calculate total kinerja
    function calculateTotalKinerja(kinerjaAbsensi, kinerjaMengajar) {
        var absensiPercentage = parseInt(kinerjaAbsensi) / 100;
        var mengajarPercentage = par    seInt(kinerjaMengajar) / 100;
        var totalKinerja = (absensiPercentage + mengajarPercentage) / 2 * 100;
        return totalKinerja.toFixed(2) + '%';
    }
</script> --}}
@endsection
