            <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-success card-outline">

                    <div class="card-header">
                        <h3 class="card-title">Pesan Masuk</h3>



                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="Search Mail">
                                <div class="input-group-append">
                                    <div class="btn btn-success">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="mailbox-controls">


                            <div class="float-right">
                                {{ $pesan->currentPage() }}-{{ $pesan->perPage() }}/{{ $pesan->total() }}
                                <div class="btn-group">
                                    @if ($pesan->hasPages())
                                        <ul class="pagination">
                                            {{-- Previous Page Link --}}
                                            @if ($pesan->onFirstPage())
                                                <li class="disabled">
                                                    <a href='#' class="btn btn-default btn-sm">
                                                        <i class="fas fa-chevron-left"></i>
                                                    </a>
                                                </li>
                                            @else
                                                <li>



                                                    <a href='{{ $pesan->previousPageUrl() }}'
                                                        class="btn btn-default btn-sm">
                                                        <i class="fas fa-chevron-left"></i>
                                                    </a>
                                                </li>
                                            @endif

                                            {{-- Next Page Link --}}
                                            @if ($pesan->hasMorePages())
                                                <li>


                                                    <a href="{{ $pesan->nextPageUrl() }}"
                                                        class="btn btn-default btn-sm">
                                                        <i class="fas fa-chevron-right"></i>
                                                    </a>


                                                </li>
                                            @else
                                                <li class="disabled">
                                                   <a href='#' class="btn btn-default btn-sm">
                                                        <i class="fas fa-chevron-right"></i>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    @endif



                                </div>
                                <!-- /.btn-group -->
                            </div>
                            <!-- /.float-right -->
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <tbody>


                                    @foreach ($pesan as $p)
                                        <tr
                                            @if ($p->status == 'Pesan Sudah Dibaca') class="bg-white" @else class="bg-light" @endif>
                                            <td>
                                                <form action="{{ asset('/' . $route . '/pesan/' . $p->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="icheck-primary">
                                                        <button type="submit" class="btn btn-default btn-sm">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </form>

                                            </td>
                                            <td class="mailbox-star"><a href="show.blade.php"></a></td>
                                            <td class="mailbox-name"><a
                                                    href="{{ asset('/' . $route . '/pesan/' . $p->id) }}">
                                                    @if ($p->namaPengirim == 'admin')
                                                        Kepala Sekolah
                                                    @else
                                                        {{ $p->namaPengirim }}
                                                    @endif
                                                </a>
                                            </td>
                                            <td class="mailbox-subject"><b>{{ $p->perihal }}</b> -
                                                {{ $p->shortenedMessage }}</td>
                                            </td>
                                            <td class="mailbox-attachment"></td>
                                            <td class="mailbox-date"> {{ $p->formattedTime }}</td>
                                        </tr>
                                    @endforeach











                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->

            <!-- /.row -->
