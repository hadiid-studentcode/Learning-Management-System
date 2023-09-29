@extends('layouts.main')

@section('main')
    <div class=" mt-2">
        <div class="card card-custom">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    <h3 class="jumbotron-heading">Selamat Datang Wali Murid {{ $siswa }}</h3>
                    <p class="lead text-muted">Silahkan Nikmati momen-momen berharga dalam galeri foto SD Muhammadiyah Kampa.
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if ($kunci == null)

        <div class=" border rounded p-3">
            <main role="main">
                <section class="text-center">
                    <div class="album py-5">
                        <div class="">
                            <div class="row">

                                @foreach ($gallery as $g)
                                    <div class="col-6 col-md-6 col-lg-4">
                                        <div class="card mb-4 shadow-sm">
                                            <div data-toggle="modal" data-target="#imageModal{{ $g->id }}">
                                                <img style="object-fit: cover; height: 400px; width: 100%;"
                                                    src="{{ asset('storage/gallery/' . $g->foto) }}"
                                                    class="card-img-top img-fluid" alt="Lomba 1">
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{ $g->deskripsi }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Modal Start --}}
                                    <div class="modal fade" id="imageModal{{ $g->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="imageModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content" style="width: 100%; height: 100%;">
                                                <div class="modal-body">
                                                    <img src="{{ asset('storage/gallery/' . $g->foto) }}" class="img-fluid"
                                                        alt="Lomba 1">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Modal End --}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <footer class="text-muted border-top pt-3 mt-4">
                <div class="">
                    <p class="float-right">
                        <a href="#" onclick="scrollToTop(); return false;"><i class="fas fa-arrow-up"></i></a>
                    </p>
                    <p>Album Foto SIMU Kampa &copy; 2023</p>
                </div>
            </footer>
        </div>

        <script>
            function scrollToTop() {
                const duration = 500;
                const start = window.pageYOffset;
                const startTime = 'now' in window.performance ? performance.now() : new Date().getTime();

                const scroll = function() {
                    const currentTime = 'now' in window.performance ? performance.now() : new Date().getTime();
                    const timeElapsed = currentTime - startTime;
                    const run = ease(timeElapsed, start, -start, duration);
                    window.scrollTo(0, run);
                    if (timeElapsed < duration) {
                        requestAnimationFrame(scroll);
                    }
                };

                const ease = function(t, b, c, d) {
                    t /= d / 2;
                    if (t < 1) return c / 2 * t * t + b;
                    t--;
                    return -c / 2 * (t * (t - 2) - 1) + b;
                };

                requestAnimationFrame(scroll);
            }
        </script>
    @else
        @if (empty($kunci[0]))
         {{-- alert segara lakukan pembayaran --}}
          <div class="alert alert-danger d-flex align-items-center " role="alert">
                <i class="fas fa-lock" style="margin-right: 2%; font-size: 24px;"></i>
                <div>
                    <p class="card-text">
                        Maaf, kami ingin mengingatkan bahwa ada keterlambatan dalam pembayaran SPP bulan
                        {{ $kunci[1] }} tahun ajaran
                        {{ $kunci[2] }}. Kami mohon untuk segera melakukan pembayaran.
                    </p>
                </div>
                
            </div>
             {{-- alert segara lakukan pembayaran --}}
        @elseif($kunci[0]->deskripsi == 'Belum Lunas')
         {{-- alert segara lakukan pembayaran --}}
            <div class="alert alert-danger d-flex align-items-center " role="alert">
                <i class="fas fa-lock" style="margin-right: 2%; font-size: 24px;"></i>
                <div>
                    <p class="card-text">
                        Maaf, kami ingin mengingatkan bahwa ada keterlambatan dalam pembayaran SPP bulan
                        {{ $kunci[1] }} tahun ajaran
                        {{ $kunci[2] }}. Kami mohon untuk segera melakukan pembayaran.
                    </p>
                </div>
                
            </div>
             {{-- alert segara lakukan pembayaran --}}
        @else
            <div class=" border rounded p-3">
                <main role="main">
                    <section class="text-center">
                        <div class="album py-5">
                            <div class="">
                                <div class="row">

                                    @foreach ($gallery as $g)
                                        <div class="col-6 col-md-6 col-lg-4">
                                            <div class="card mb-4 shadow-sm">
                                                <div data-toggle="modal" data-target="#imageModal{{ $g->id }}">
                                                    <img style="object-fit: cover; height: 400px; width: 100%;"
                                                        src="{{ asset('storage/gallery/' . $g->foto) }}"
                                                        class="card-img-top img-fluid" alt="Lomba 1">
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text">{{ $g->deskripsi }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Modal Start --}}
                                        <div class="modal fade" id="imageModal{{ $g->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content" style="width: 100%; height: 100%;">
                                                    <div class="modal-body">
                                                        <img src="{{ asset('storage/gallery/' . $g->foto) }}"
                                                            class="img-fluid" alt="Lomba 1">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Modal End --}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </section>
                </main>

                <footer class="text-muted border-top pt-3 mt-4">
                    <div class="">
                        <p class="float-right">
                            <a href="#" onclick="scrollToTop(); return false;"><i class="fas fa-arrow-up"></i></a>
                        </p>
                        <p>Album Foto SIMU Kampa &copy; 2023</p>
                    </div>
                </footer>
            </div>

            <script>
                function scrollToTop() {
                    const duration = 500;
                    const start = window.pageYOffset;
                    const startTime = 'now' in window.performance ? performance.now() : new Date().getTime();

                    const scroll = function() {
                        const currentTime = 'now' in window.performance ? performance.now() : new Date().getTime();
                        const timeElapsed = currentTime - startTime;
                        const run = ease(timeElapsed, start, -start, duration);
                        window.scrollTo(0, run);
                        if (timeElapsed < duration) {
                            requestAnimationFrame(scroll);
                        }
                    };

                    const ease = function(t, b, c, d) {
                        t /= d / 2;
                        if (t < 1) return c / 2 * t * t + b;
                        t--;
                        return -c / 2 * (t * (t - 2) - 1) + b;
                    };

                    requestAnimationFrame(scroll);
                }
            </script>
        @endif


    @endif


@endsection
