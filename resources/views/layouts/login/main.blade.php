<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simu Kampa | {{ $title }} </title>
    <link rel="icon" href="{{ asset('iconfile.png') }}">


    @include('layouts.login.link')

</head>

<body>


    <style>
        body {
            margin: 0;
        }
    </style>

    <section class="flex flex-col md:flex-row h-screen items-center">



        @include('layouts.login.header')


        <div
            class="bg-white w-full md:max-w-md lg:max-w-full md:mx-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12
          flex items-center justify-center">

            <div class="w-full h-100">
                <img src="{{ asset('Assets/images/sistemhamkabs.jpg') }}" alt="Simu kampa" class="mx-auto h-44"
                    style="height: 200px; width: 250px; margin-top:20px;">
                <h1 class="text-xl md:text-2xl font-bold leading-tight mt-12" style="font-size: 30px; color: green; ">
                    Login {{ $role }}</h1>



                @if (session()->has('error'))
                    {{-- alert kesalahan password --}}
                    <div class="alert alert-dismissible fade show" role="alert"
                        style="color: white; background-color: #C70039">
                        <strong>Warning!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                            style="color: white"></button>
                    </div>

                    {{-- alert kesalahan password --}}
                @endif





                @yield('main')


                @include('layouts.login.footer')

            </div>

        </div>


    </section>

    <script src="{{ asset('Assets/dist/bootstrap/js/bootstrap.bundle.min.js') }}"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>


</body>

</html>
