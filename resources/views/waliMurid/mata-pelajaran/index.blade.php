@extends('layouts.main')

@section('main')
    <div class=" ">
        <div class="card card-custom">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    <h3 class="jumbotron-heading">Halaman Mata Pelajaran Siswa </h3>
                    <p class="lead text-muted">Silahkan Kepada Wali Muird untuk melihat data pelajaran anak sesuai tahun
                        ajaran dan mata pelajaran.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="">
    <div class="card card-custom">
        <div class="card-body">
            <form action="               <div class="form-group">
                  <label for="tahun">Tahun Akademik:</label>
                  <select class="form-control" name="kelas" id="kelas" required>
                    <option value="" hidden>Pilih Kelas</option>
                    <option value="1a">Kelas 1A Tahun Ajaran 2022/2023</option>
                    <option value="1b">Kelas 2A Tahun Ajaran 2023/2024</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="pelajaran">Pilih Pelajaran:</label>
                  <select class="form-control" name="pelajaran" id="pelajaran" onchange="showGuruAndPertemuan()" required>
                    <option value="" hidden>Pilih Mata Pelajaran</option>
                    <option value="matematika">Matematika</option>
                    <option value="bahasa-inggris">Bahasa Inggris</option>
                    <option value="fisika">Fisika</option>
                  </select>
                </div>

                <div class="form-group" id="guru-" style="display: none;">
                  <label for="guru">Nama Guru:</label>
                  <input type="text" class="form-control" id="guru" readonly>
                </div>

                <div class="form-group" id="pertemuan-" style="display: none;">
                  <label for="pertemuan">Pilih Pertemuan:</label>
                  <select class="form-control" name="pertemuan" id="pertemuan" onchange="showMateri()" required>
                    <option value="" hidden>Pilih Pertemuan</option>
                    <option value="senen-pertemuan-1">Senen Pertemuan 1</option>
                    <option value="senen-pertemuan-2">Senen Pertemuan 2</option>
                    <option value="senen-pertemuan-3">Senen Pertemuan 3</option>
                    <option value="selasa-pertemuan-1">Selasa Pertemuan 1</option>
                    <option value="selasa-pertemuan-2">Selasa Pertemuan 2</option>
                    <option value="selasa-pertemuan-3">Selasa Pertemuan 3</option>
                  </select>
                </div>

                <div id="materi-" style="display: none;">
                  <label for="materi">Materi:</label>
                  <p id="materi"></p>
                </div>

                <br>

                <input type="submit" value="Lihat Materi" class="btn btn-success">
              </form>
        </div>
    </div>
</div>

  <script>
    function showGuruAndPertemuan() {
      var select = document.getElementById("pelajaran");
      var selectedOption = select.options[select.selectedIndex].value;
      var guru = document.getElementById("guru-");
      var guruInput = document.getElementById("guru");
      var pertemuan = document.getElementById("pertemuan-");
      var materi = document.getElementById("materi-");

      if (selectedOption === "matematika") {
        guruInput.value = "Nama Guru Matematika";
      } else if (selectedOption === "bahasa-inggris") {
        guruInput.value = "Nama Guru Bahasa Inggris";
      } else if (selectedOption === "fisika") {
        guruInput.value = "Nama Guru Fisika";
      } else {
        guruInput.value = "";
      }

      if (selectedOption) {
        guru.style.display = "block";
        pertemuan.style.display = "block";
        materi.style.display = "none";
      } else {
        guru.style.display = "none";
        pertemuan.style.display = "none";
        materi.style.display = "none";
      }
    }

    function showMateri() {
      var select = document.getElementById("pertemuan");
      var selectedOption = select.options[select.selectedIndex].value;
      var materi = document.getElementById("materi-");
      var materiText = document.getElementById("materi");

      if (selectedOption) {
        materiText.innerText = "Materi yang dibahas dalam " + selectedOption;
        materi.style.display = "block";
      } else {
        materiText.innerText = "";
        materi.style.display = "none";
      }
    }
  </script>
 --}}

    <div class="">
        <div class="card card-custom">
            <div class="card-body">
                <form action="{{ url('/wali-murid/mata-pelajaran/search') }}" method="GET">

                    <div class="form-group">
                        <label for="tahun">Tahun Akademik:</label>
                        <select class="form-control" name="kelas" id="kelas" required>
                            <option value="@if(isset($kelasSearch)) {{ $kelasSearch->id }} @else @endif" hidden>@if(isset($kelasSearch)) Kelas {{ $kelasSearch->kelas }} {{ $kelasSearch->rombel }} {{ $kelasSearch->tahun_ajaran }} @else Pilih Kelas @endif</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}">Kelas {{ $k->kelas }} {{ $k->rombel }} Tahun
                                    Ajaran {{ $k->tahun_ajaran }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pelajaran">Pilih Pelajaran:</label>
                        <select class="form-control" name="pelajaran" id="pelajaran" required>
                            <option value="@if(isset($mapelSearch)) {{ $mapelSearch->kode }} @else @endif" hidden>@if(isset($mapelSearch)) {{ $mapelSearch->nama }} @else Pilih Mata Pelajaran @endif</option>
                            @foreach ($mapel as $m)
                                <option value="{{ $m->kode }}">{{ $m->nama }}</option>
                            @endforeach

                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>

                </form>
            </div>
        </div>
    </div>

    <div id="materi-" class="">
        <div class="card card-custom">
            <div class="card-body">

              <div class="table-responsive">
                <table id="data_table" class="table table-bordered table-striped" style="text-align: center;">
                  <thead>
                    <tr>
                      <th colspan="5"><h5 class="text-center">Materi Siswa</h5></th>
                    </tr>
                      <tr>
                          <th style="width: 5%;">No</th>
                          <th>Pertemuan</th>
                          <th>Tanggal</th>
                          <th>Nama Materi</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody id="materi-table">

                      @if(isset($pertemuan))
                      @foreach($pertemuan as $p)
                        @if ($p->nama_materi == true && $p->tanggal_materi == true)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>Pertemuan {{ $p->pertemuan_ke }}</td>
                          <td>{{ $p->tanggal_materi }}</td>
                          <td>Materi 1 Matematika</td>
                          <td><a href="{{ asset('storage/guru/materi/' . $p->file_materi) }}" target="_blank" class="btn btn-success"><i class="fas fa-eye"></i></a> </td>
                      </tr>
                      @endif
                      @endforeach

                      @endif
                     
                    
                  </tbody>
              </table>
              </div>
            </div>
        </div>
    </div>
@endsection
