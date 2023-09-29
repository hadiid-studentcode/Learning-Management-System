<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Sistem Informasi Muhammadiyah Kampa">
    <title>HAMKA BS | {{ $title }}-{{ $role }}</title>
    <link rel="icon" href="{{ asset('iconfile.png') }}">

    @include('layouts.link')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('favicon.png') }}" alt="AdminLTELogo" height="60"
                width="60">
        </div> --}}

        @include('layouts.header')

        @include('partials.sidebar')


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper card bg-white shadow-sm">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            {{-- <h1 class="m-0">{{ $title }}</h1> --}}

                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('main')
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        @include('layouts.footer')


    </div>
    <!-- ./wrapper -->

    @include('layouts.script')
</body>

</html>
