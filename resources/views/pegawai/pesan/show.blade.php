@extends('layouts.main')

@section('main')




<section class="content container-custom">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <a href="{{ asset('/pegawai/pesan') }}" class="btn btn-success btn-block mb-3">Kembali Ke Inbox</a>
          <!-- /.card -->
        </div>
        <!-- /.col -->

        @include('partials.pesan.show')

      <!-- /.col -->
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>

@endsection
