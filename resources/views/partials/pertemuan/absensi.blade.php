 {{-- Tabel Absensi --}}
 <div class="container" id="absensi">
     <div class="card card-custom gutter-b">
         <div class="card-body">
             <div class="table-responsive">
                 <div class="table-responsive">
                    <table id="data_table" class="table table-bordered table-striped table-hover table-absensi">
                        <thead>
                            <tr>
                                <th colspan="6"><h5 class="text-center">Absensi Siswa</h5></th>
                            </tr>
                            <tr style="text-align: center;">
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>NISN</th>
                                <th>Kelas</th>
                                <th>Absensi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ $s->nisn }}</td>
                                    <td>{{ $s->kelas }} {{ $s->rombel }}</td>
                                    <td>
                                        <form action="{{ url('guru/jadwal/cek/absensi/' . $kode . '/' . $s->id) }}"
                                            method="post">
                                            @csrf
                                            <select class="custom-select action-select" name="status_absensi">
                                                @foreach ($absen as $abs)
                                                    @if ($s->id == $abs->id_siswa)
                                                        <option value="{{ $abs->status }}" hidden>{{ $abs->status }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                                <option value="" hidden>Pilih</option>
                                                <option value="Hadir">Hadir</option>
                                                <option value="Sakit">Sakit</option>
                                                <option value="Izin">Izin</option>
                                                <option value="Tidak Hadir">Tidak Hadir</option>
                                            </select>
                                    </td>
   
                                    <td>
                                        @php
                                            $absensiExist = false;
                                        @endphp
                                        @foreach ($absen as $a)
                                            @if ($a->id_siswa == $s->id)
                                                @php
                                                    $absensiExist = true;
                                                @endphp
                                            @break
                                        @endif
                                    @endforeach
   
   
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                    </div>
                                    
   
   
                                    </form>
                                </td>
                            </tr>
                        @endforeach
   
                        <!-- Tambahkan baris lebih banyak di sini -->
                    </tbody>
                   </table>
                  </div>
         









         </div>
     </div>
 </div>
</div>
{{-- Tabel Absensi --}}
