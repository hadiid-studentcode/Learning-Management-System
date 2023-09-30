@extends('layouts.main')

@section('main')

    <div class=" ">
        <div class="card card-custom">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    <h2 class="jumbotron-heading">Data Raport Siswa</h2>
                    <p class="lead text-muted text-center">Halaman Untuk melihat data nilai siswa.
                    </p>
                </div>
            </div>
        </div>
    </div>


    <div class="">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <form id="siswaForm" action="{{ url('/super-user/Nilai-siswa/create') }}" method="GET">
                    @csrf
                    <div class="form-group row">
                        <label for="tahunAjaran" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                        <div class="col-sm-10">
                            <select id="tahunAjaran" name="tahunAjaran" class="form-control" required>
                                <option value="@if (isset($tahunAjaranSearch)) {{ $tahunAjaranSearch->id }} @else @endif"
                                    hidden>
                                    @if (isset($tahunAjaranSearch))
                                        {{ $tahunAjaranSearch->tahun_ajaran }}
                                    @else
                                        Pilih Tahun Ajaran
                                    @endif
                                </option>
                                @foreach ($tahunAjaran as $th)
                                    <option value="{{ $th->id }}">{{ $th->tahun_ajaran }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <select id="kelas" name="kelas" class="form-control" required>
                                <option value="@if (isset($kelasSearch)) {{ $kelasSearch->id }} @else @endif"
                                    hidden>
                                    @if (isset($kelasSearch))
                                        Kelas {{ $kelasSearch->kelas }} {{ $kelasSearch->rombel }}
                                    @else
                                        Pilih Kelas
                                    @endif
                                </option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}">Kelas {{ $k->nama }} {{ $k->rombel }}
                                    </option>
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


    <div class="modal fade" id="kelasModal" tabindex="-1" role="dialog" aria-labelledby="kelasModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kelasModalLabel">Penting</h5>
                </div>
                <div class="modal-body">
                    Mohon Lengkapi data Terlebih Dahulu !
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="" id="reportCardContainer">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div id="resultTable">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" style="text-align: center">
                            <thead>
                                <tr>
                                    <th colspan="4" style="text-align: center">
                                        <h4>Data Nilai Siswa</h4>
                                    </th>
                                </tr>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>NISN</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($siswa))
                                    @foreach ($siswa as $s)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $s->nama }}</td>
                                            <td>{{ $s->nisn }}</td>
                                            <td><button type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#showReport_{{ $s->id }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <!-- Modal Lihat Nilai -->
                                                <div class="modal fade" id="showReport_{{ $s->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Data Nilai
                                                                    {{ $s->nama }}</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>No</th>
                                                                            <th>Mata Pelajaran</th>
                                                                            <th>KKM</th>
                                                                            <th>Nilai</th>
                                                                            <th>Nilai Rata-rata</th>
                                                                            <th>Catatan Guru</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($raport as $r)
                                                                            @if ($r->id_siswa == $s->id)
                                                                                <tr>
                                                                                    <td>{{ $loop->iteration }}</td>
                                                                                    <td class="subject-name">
                                                                                        {{ $r->mapel }}</td>
                                                                                    <td>{{ $r->KKM }}</td>
                                                                                    <td>{{ $r->total_nilai }}</td>
                                                                                    <td
                                                                                        class="grade @if ($r->rata_rata >= $r->KKM) @else text-danger @endif">
                                                                                        {{ $r->rata_rata }}</td>
                                                                                    <td class="remarks">{{ $r->catatan }}
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
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

    <div id="resultTable"></div>

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
