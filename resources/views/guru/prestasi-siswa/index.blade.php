@extends('layouts.main')

@section('main')


<div class=" ">
    <div class="card card-custom">
        <div class="card-body">
            <div class="d-flex flex-column align-items-center">
                <h2 class="text-dark-75 text-center">Data Prestasi Siswa</h2>
                <p class="text-dark-50 text-center">Silakan Masukkan Prestasi Siswa di bawah ini.</p>
            </div>
        </div>
    </div>
</div>

<div class="gutter-b">
    <div class="card card-custom">
        <div class="card-body">
            <div class="table-responsive">
               <table class="table table-striped table-bordered" style="width: 98%" id="data_table">
                <thead>
                    <tr>
                        <th colspan="5"><h5 class="text-center">Data Prestasi Siswa</h5></th>
                    </tr>
                    <tr>
                        <th style="width: 7%">No</th>
                        <th>Nama</th>
                        <th>NISN</th>
                        <th>Kelas</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                            <tr>
                                <td>1</td>
                                <td>Ucok</td>
                                <td>23983298</td>
                                <td>4 ibrahim</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="btn btn-success btn-sm mr-1" data-toggle="modal" data-target="#prestasiModal">
                                            <i class="fas fa-plus"></i> 
                                        </button>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewModal">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    
                                </td>
                            </tr>
                </tbody>
            </table> 
              </div>
           
        </div>
    </div>
</div>

        <div class="modal fade" id="prestasiModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Prestasi</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <form action="" class="form-horizontal" method="POST"
                        enctype="multipart/form-data" accept-charset="utf-8">
                        

                        <div class="modal-body">
                            <input type="hidden" name="id_siswa" value="">
                            <div class="form-group">
                                <label>Status Prestasi</label>
                                <select class="form-control" name="status" required>
                                    <option value="">Pilih Status Prestasi</option>
                                    <option value="Akademik">Akademik</option>
                                    <option value="Non Akademik">Non Akademik</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama Prestasi</label>
                                <input type="text" name="nama_prestasi" class="form-control"
                                    placeholder="Nama Prestasi" required />
                            </div>
                            <div class="form-group">
                                <label>Tanggal Perolehan</label>
                                <input type="date" id="tanggalPerolehan" class="form-control" name="tanggal"
                                    placeholder="Tanggal Perolehan" required />
                            </div>
                            <div class="form-group">
                                <label>Prediket</label>
                                <select class="form-control" name="prediket" required>
                                    <option value="">Pilih Prediket</option>
                                    <option value="Juara 1">Juara 1</option>
                                    <option value="Juara 2">Juara 2</option>
                                    <option value="Juara 3">Juara 3</option>
                                    <option value="Tanpa Peringkat">Tanpa Peringkat</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Input Foto</label>
                                <div class="custom-file">
                                    <input type="file" accept="image/*"
                                        onchange="showFileNameAndPreview(event, )"
                                        class="custom-file-input" id="exampleInputFile" name="foto" required>
                                    <label class="custom-file-label" for="exampleInputFile"
                                        id="file-label_">Pilih File</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <img id="previewImage_" src="#" alt="Preview"
                                    style="display: none; max-width: 200px; margin-top: 10px;">
                            </div>
                        </div>
                       
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




        <div class="modal fade" id="viewModal">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Prestasi Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                                <div class="row border border-1 ">
                                    <div class="col-md-4 text-center">

                                        <img src="https://plus.unsplash.com/premium_photo-1664304936422-4b3b09f047e6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1936&q=80"
                                            class="img-fluid modal-photo" width="97%" style="padding: 3%">

                                    </div>
                                    <div class="col-md-8">
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <table style="margin: 0px;">
                                                    <tr>
                                                        <td style="padding: 5px;">Status Prestasi</td>
                                                        <td style="padding: 5px;">: Akademik</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 5px;">Nama Prestasi</td>
                                                        <td style="padding: 5px;">: Lomba ML</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 5px;">Waktu Peroleh</td>
                                                        <td style="padding: 5px;">: 4 maret 2023</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 5px;">Prediket</td>
                                                        <td style="padding: 5px;">: Juara</td>
                                                    </tr>
                                                </table>
                                                
                                                
                                                <form
                                                    action=""
                                                    method="post">
                                                    
                                                    <button type="submit" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#deleteModal" style="margin: 1%">Delete</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                     

                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>






 
@endsection
