   {{-- Tabel Nilai --}}
   <div class="" id="nilai">
       <div class="card card-kustom gutter-b">
           <div class="card-body">
               <div class="table-responsive">
                   <table class="table table-bordered table-striped table-hover table-tugas-siswa">
                       <thead>
                        <tr>
                            <th colspan="8"><h5 class="text-center">Nilai Tugas Siswa</h5></th>
                        </tr>
                           <tr style="text-align: center;">
                               <th>No</th>
                               <th>Nama Siswa</th>
                               <th>NISN</th>
                               <th>Kelas</th>

                               <th>Tugas</th>
                               <th>Status</th>
                               {{-- <th>Nilai</th> --}}
                               <th>Nilai</th>
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
                                   @if (!empty($tugasSiswa))
                                       @foreach ($tugas as $t)
                                           @if ($s->id == $t->id_siswa)
                                               <td>
                                                   <div class="d-flex justify-content-center">
                                                       <button type="button" class="btn btn-primary">
                                                        <i class="fas fa-eye"></i> 
                                                       </button>
                                                   </div>
                                               </td>
                                               <td>{{ $t->status }}</td>

                                               <form action="{{ url('guru/jadwal/cek/nilai/' . $kode . '/' . $s->id) }}"
                                                   method="post">
                                                   @csrf
                                                   <td>
                                                       @if ($t->nilai)
                                                           <input type="number" class="form-control nilai-tugas"
                                                               name="nilai_tugas" min="0" max="100" required
                                                               value="{{ $t->nilai }}">
                                                       @else
                                                           <input type="number" class="form-control nilai-tugas"
                                                               name="nilai_tugas" min="0" max="100"
                                                               required>
                                                       @endif
                                                   </td>
                                                   <td>
                                                       <div class="row">
                                                           <div class="d-flex justify-content-center">
                                                               <button type="submit"
                                                                   class="btn btn-success btn-sm mr-2 ml-2">
                                                                   <svg fill="#ffff" width="20px" height="25px"
                                                                       viewBox="0 0 24 24"
                                                                       xmlns="http://www.w3.org/2000/svg">
                                                                       <g data-name="Layer 2">
                                                                           <g data-name="done-all">
                                                                               <rect width="24" height="24"
                                                                                   opacity="0" />
                                                                               <path
                                                                                   d="M16.62 6.21a1 1 0 0 0-1.41.17l-7 9-3.43-4.18a1 1 0 1 0-1.56 1.25l4.17 5.18a1 1 0 0 0 .78.37 1 1 0 0 0 .83-.38l7.83-10a1 1 0 0 0-.21-1.41z" />
                                                                               <path
                                                                                   d="M21.62 6.21a1 1 0 0 0-1.41.17l-7 9-.61-.75-1.26 1.62 1.1 1.37a1 1 0 0 0 .78.37 1 1 0 0 0 .78-.38l7.83-10a1 1 0 0 0-.21-1.4z" />
                                                                               <path
                                                                                   d="M8.71 13.06L10 11.44l-.2-.24a1 1 0 0 0-1.43-.2 1 1 0 0 0-.15 1.41z" />
                                                                           </g>
                                                                       </g>
                                                                   </svg>
                                                               </button>
                                                           </div>
                                                       </div>
                                                   </td>
                                               </form>
                                           @else
                                               {{-- <td></td>
                                               <td></td>
                                               <td></td>
                                               <td></td> --}}
                                           @endif
                                       @endforeach
                                   @else
                                       <td>-</td>
                                       <td>-</td>
                                       <td>-</td>
                                       <td>-</td>
                                   @endif
                               </tr>
                           @endforeach
                       </tbody>

                   </table>

               </div>

           </div>
       </div>
   </div>
   {{-- Tabel Nilai --}}
