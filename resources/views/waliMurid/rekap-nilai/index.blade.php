@extends('layouts.main')

@section('main')
    <div class=" ">
        <div class="card card-custom">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    <h3 class="jumbotron-heading">Data Rekapan Nilai Siswa</h3>
                    <p class="lead text-muted">Silahkan Kepada Wali Muird untuk melihat data Nilai anak sesuai tahun
                        ajaran dan mata pelajaran.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <form action="{{ url('/wali-murid/rekap-nilai/' . $id_siswa) }}" method="GET" id="siswaForm">
                    @csrf
                    <div class="form-group row">
                        <label for="kelas" class="col-sm-2 col-form-label">Pilih Kelas</label>
                        <div class="col-sm-10">
                            <select id="kelas" name="kelas" class="form-control" required>
                                <option value="@if (isset($kelasSearch)) {{ $kelasSearch->id }} @else @endif"
                                    hidden>
                                    @if (isset($kelasSearch))
                                        Kelas {{ $kelasSearch->kelas }} {{ $kelasSearch->rombel }}
                                        {{ $kelasSearch->tahun_ajaran }}
                                    @else
                                        Pilih Kelas
                                    @endif
                                </option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}">kelas {{ $k->kelas }} {{ $k->rombel }}
                                        {{ $k->tahun_ajaran }}</option>
                                @endforeach
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


    <div class="" id="reportCard">
        <div class="card card-custom">
            <div class="card-body">
                <div class="card-body" style="display: flex; flex-direction: column; align-items: flex-start;">
                    <div style="flex-grow: 1;"></div>



                    <div class="table-responsive">
                        <table class="table" width="50%">
                            @if (isset($rekapNilaiSiswa))
                                <tr>
                                    <td>Nama</td>
                                    <td>:&nbsp;{{ $siswa->nama }}</td>
                                </tr>
                                <tr>
                                    <td>NISN</td>
                                    <td>:&nbsp;{{ $siswa->nisn }}</td>
                                </tr>
                                <tr>
                                    <td>Kelas</td>
                                    <td>:&nbsp;{{ $siswa->kelas }} {{ $siswa->rombel }}</td>
                                </tr>
                                <tr>
                                    <td>Wali Kelas</td>
                                    <td>:&nbsp;{{ $siswa->guru }}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
                <div id="resultTable">

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mata Pelajaran</th>
                                    <th>KKM</th>
                                    <th>Nilai</th>
                                    <th>Rata-rata</th>
                                    <th>Catatan Guru</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($rekapNilaiSiswa))
                                    @foreach ($rekapNilaiSiswa as $rns)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="subject-name">{{ $rns->nama }}</td>
                                            <td>{{ $rns->KKM }}</td>
                                            <td>{{ $rns->nilai }}</td>
                                            <td class="grade @if ($rns->rata_rata >= $rns->KKM) @else text-danger @endif">
                                                {{ $rns->rata_rata }}</td>

                                            <td class="remarks">{{ $rns->catatan }}</td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>





    {{--
    <script>
        document.getElementById('siswaForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            var selectedSiswa = document.getElementById('kelas').value;

            if (selectedSiswa !== '') {
                // Generate the table dynamically
                var table = document.createElement('table');
                table.classList.add('table', 'table-bordered');

                var tableHeader = document.createElement('thead');
                tableHeader.innerHTML = `
                    <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>KKM</th>
                        <th>Nilai</th>
                        <th>Nilai Rata-rata</th>
                        <th>Catatan Guru</th>
                    </tr>
                `;
                table.appendChild(tableHeader);

                var tableBody = document.createElement('tbody');
                tableBody.innerHTML = `
                    <tr>
                        <td>1</td>
                        <td class="subject-name">Pendidikan Agama</td>
                        <td>75</td>
                        <td>40</td>
                        <td class="grade">62.7</td>
                        <td class="remarks">Nilai dibawah KKM. Tingkatkan Belajar.</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td class="subject-name">Pendidikan Kewarganegaraan</td>
                        <td>66</td>
                        <td>50</td>
                        <td class="grade">75.9</td>
                        <td class="remarks">Nilai dibawah KKM. Tingkatkan Belajar.</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td class="subject-name">Bahasa Indonesia</td>
                        <td>57</td>
                        <td>53</td>
                        <td class="grade">84.0</td>
                        <td class="remarks">Nilai dibawah KKM. Tingkatkan Belajar.</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td class="subject-name">Matematika</td>
                        <td>52</td>
                        <td>43</td>
                        <td class="grade">58.1</td>
                        <td class="remarks">Nilai dibawah KKM. Tingkatkan Belajar.</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td class="subject-name">Ilmu Pengetahuan Alam</td>
                        <td>56</td>
                        <td>96</td>
                        <td class="grade">84.5</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td class="subject-name">Ilmu Pengetahuan Sosial</td>
                        <td>56</td>
                        <td>53</td>
                        <td class="grade">74.8</td>
                        <td class="remarks">Nilai dibawah KKM. Tingkatkan Belajar.</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td class="subject-name">Seni Budaya dan Keterampilan</td>
                        <td>67</td>
                        <td>56</td>
                        <td class="grade">76.8</td>
                        <td class="remarks">Nilai dibawah KKM. Tingkatkan Belajar.</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td class="subject-name">Pendidikan Jasmani</td>
                        <td>63</td>
                        <td>85</td>
                        <td class="grade">90.4</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td class="subject-name">Muatan Lokal</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="subject-name">- Bahasa Bali</td>
                        <td>63</td>
                        <td>56</td>
                        <td class="grade">77.4</td>
                        <td class="remarks">Nilai dibawah KKM. Tingkatkan Belajar.</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="subject-name">- Budi Pekerti</td>
                        <td>75</td>
                        <td>63</td>
                        <td class="grade">62.6</td>
                        <td class="remarks">Nilai dibawah KKM. Tingkatkan Belajar.</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="subject-name">- Bahasa Inggris</td>
                        <td>52</td>
                        <td>63</td>
                        <td class="grade">62.6</td>
                        <td></td>
                    </tr>
                `;
                table.appendChild(tableBody);

                var resultTable = document.getElementById('resultTable');
                resultTable.innerHTML = '';
                resultTable.appendChild(table);
            }
        });
    </script> --}}
@endsection
