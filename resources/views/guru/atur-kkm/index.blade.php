@extends('layouts.main')

{{-- sadas --}}

@section('main')
    <div class="container">
        <div class="card card-custom">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    <h2 class="text-dark-75 text-center text-uppercase ">Mengatur Nilai KKM di Setiap Kelas</h2>
                    <p class="text-dark-50 text-center">Silakan input Nilai KKM dalam Mata Pelajaran</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-body">

                <div class="table-responsive">
                     <table class="table table-striped table-bordered" style="text-align: center">
                    <thead>
                        <tr>
                            <th colspan="5"><h5 class="text-center">Tabel Data Mata pelajaran</h5></th>
                        </tr>
                        <tr>
                            <th style="width: 5%">Nomor</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai KKM</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mapel as $m)
                            <tr>
                                <td class="small-column">{{ $loop->iteration }}</td>
                                <td>{{ $m->kelas }} {{ $m->rombel }}</td>
                                <td>{{ $m->nama }} - {{ $m->hari }}</td>
                                <td>{{ $m->KKM }}</td>
                                <td>
                                    <button class="btn btn-sm btn-success" data-toggle="modal"
                                        data-target="#editModal_{{ $m->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>



                                </td>
                                <div class="modal fade" id="editModal_{{ $m->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form action="{{ url('guru/atur-kkm/' . $m->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Atur Nilai KKM </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="editKelas">Kelas:</label>
                                                        <input type="text" class="form-control" id="editKelasDisplay"
                                                            value="{{ $m->kelas }} {{ $m->rombel }}" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="editMataPelajaran">Mata Pelajaran:</label>
                                                        <input type="text" class="form-control"
                                                            id="editMataPelajaranDisplay"
                                                            value="{{ $m->nama }} - {{ $m->hari }}" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="editNilaiKKM">Atur Nilai KKM:</label>
                                                        <input type="number" class="form-control" id="editNilaiKKM"
                                                            name="kkm" min="0" max="100">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-success"
                                                        id="saveEditButton">Simpan</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                        @endforeach
                        </tr>

                    </tbody>
                </table>
                </div>
               
            </div>
        </div>
    </div>

    <!-- Edit Modal -->



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editModal = document.getElementById("editModal");
            const saveEditButton = document.getElementById("saveEditButton");

            saveEditButton.addEventListener("click", function() {
                editModal.modal("hide");
            });
        });
    </script>

    {{-- Delete Modal --}}
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection
