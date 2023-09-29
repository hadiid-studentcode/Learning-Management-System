    <div class="container" id="materi">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary" >
                    <div class="card-header">
                        <h3 class="card-title">Upload Materi</h3>
                    </div>
                    <form action="{{ url('/guru/jadwal/cek/materi/' . $kode) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Nama Materi</label>
                                <input type="text" class="form-control" name="nama_materi" placeholder="Nama"
                                    value="{{ $pertemuan->nama_materi }}">
                            </div>

                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" placeholder="tanggal"
                                    value="{{ $pertemuan->tanggal_materi }}">
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea id="keterangan" name="keterangan_materi">{{ $pertemuan->deskripsi_materi }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Input Materi</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" accept="" onchange="showFileNames(event)"
                                            class="custom-file-input" id="fileInputMateri" name="file_materi" multiple>
                                        <label class="custom-file-label" for="fileInputMateri"
                                            id="file-label-materi">{{ substr($pertemuan->file_materi, strpos($pertemuan->file_materi, "-") + 1) }}</label>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="form-group">
                                <label for="exampleInputLink">Input Link Materi</label>
                                <input type="text" class="form-control" id="exampleInputLink" name="link_materi"
                                    value="{{ $pertemuan->link_materi }}">
                            </div> --}}

                           
                            @if(isset($pertemuan->file_materi))

                                <div class="form-group">
                                    <label for="materi">Materi yang sudah dimasukan:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="materi" readonly
                                            value="{{ substr($pertemuan->file_materi, strpos($pertemuan->file_materi, "-") + 1) }}">
                                        <div class="input-group-append">
                                            <a href="{{ asset('storage/guru/materi/' . $pertemuan->file_materi) }}"
                                                target="_blank" class="btn btn-outline-secondary" type="button"
                                                id="viewButton">Lihat Materi</a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                          


                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-success" style="height: ">
                    <div class="card-header">
                        <h3 class="card-title">Upload Tugas</h3>
                    </div>
                    <form action="{{ url('/guru/jadwal/cek/tugas/' . $kode) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Nama Tugas</label>
                                <input type="text" class="form-control" name="nama_tugas"
                                    value="{{ $pertemuan->nama_tugas }}"
                                    placeholder="Nama">
                            </div>

                            <div class="form-group">
                                <label for="tanggal">Deadline Tugas</label>
                                <input type="datetime-local" class="form-control" name="deadline_tugas"
                                    value="{{ $pertemuan->tanggal_tugas }}"
                                    placeholder="Deadline Tugas">
                            </div>


                            <div class="form-group">
                                <label for="tugas">Deskripsi Tugas</label>
                                <textarea id="tugas" name="deskripsi_tugas">{{ $pertemuan->deskripsi_tugas }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Upload Tugas</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" accept="" onchange="showFileName(event)"
                                            class="custom-file-input" id="fileInputTugas" name="file_tugas">
                                        <label class="custom-file-label" for="fileInputTugas" id="file-label-tugas">{{ substr($pertemuan->file_tugas, strpos($pertemuan->file_tugas, "-") + 1) }}</label>
                                    </div>
                                </div>
                            </div>

                            @if(isset($pertemuan->file_tugas))

                            <label for="tugas">Tugas yang sudah dimasukan:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="tugas" readonly
                                    value="{{ substr($pertemuan->file_tugas, strpos($pertemuan->file_tugas, "-") + 1) }}">
                                <div class="input-group-append">
                                    <a href="{{ asset('storage/guru/tugas/' . $pertemuan->file_tugas) }}"
                                        target="_blank" class="btn btn-outline-secondary" type="button"
                                        id="viewButton">Lihat Tugas</a>
                                </div>
                            </div>
                            @endif

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('keterangan');
        CKEDITOR.replace('tugas');

        function showFileNames(event) {
            var input = event.target;
            var fileNames = Array.from(input.files).map(file => file.name);
            if (input.id === 'fileInputMateri') {
                document.getElementById("file-label-materi").textContent = fileNames.join(", ");
            } else if (input.id === 'fileInputTugas') {
                document.getElementById("file-label-tugas").textContent = fileNames.join(", ");
            }
        }

        function showFileName(event) {
            var input = event.target;
            var fileName = input.files[0].name;
            document.getElementById("file-label-tugas").textContent = fileName;
        }
    </script>
