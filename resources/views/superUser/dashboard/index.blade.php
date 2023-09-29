@extends('layouts.main')
@section('main')
    <div class="container ">
        <div class="card card-custom">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    <h1 class="jumbotron-heading">Selamat Datang</h1>
                    <p class="lead text-muted">Silahkan Nikmati momen-momen berharga dalam galeri foto SD Muhammadiyah Kampa.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container border rounded ">
        <div class="card-custom gutter-b">
            <div class="card-body">
                <section class="text-center">
                    <div class="album py-5">
                        <div class="container">
                            <div class="row">

                                @foreach ($gallery as $g)
                                    <div class="col-md-4">
                                        <div class="card mb-4 shadow-sm">
                                            <a href="#" data-toggle="modal" data-target="#imageModal_{{ $g->id }}">
                                                <img style="object-fit: cover; height: 400px; width: 100%;"
                                                    src="{{ asset('storage/gallery/' . $g->foto) }}"
                                                    class="card-img-top img-fluid" alt="Lomba 1">
                                            </a>
                                            <div class="card-body">
                                                <p class="card-text">{{ $g->deskripsi }}</p>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- modal --}}
                                    <div class="modal fade" id="imageModal_{{ $g->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="imageModalLabel" aria-hidden="true">
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
                                    {{-- end modal --}}
                                @endforeach



                            </div>
                        </div>
                    </div>
                </section>


                <footer class="text-muted border-top pt-3 mt-4">
                    <div class="container">
                        <p class="float-right">
                            <a href="#" onclick="scrollToTop(); return false;"><i class="fas fa-arrow-up"></i></a>
                        </p>
                        <p>Album Foto SIMU Kampa &copy; 2023</p>
                    </div>
                </footer>

            </div>
        </div>
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
@endsection
