<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light bg">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <p class="nav-link"
                style="color: rgb(104, 104, 143); font-size: 16px; margin-bottom: 0; font-family: 'Arial', sans-serif; letter-spacing: 1px;">
                Sistem Hamka Boarding School | {{ $role }}
            </p>
        </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="">



            @if ($folder == true || $img == true)
                <img src="{{ asset('storage/' . $folder . '/images/' . $img) }}" alt="Profil" style="border-radius:50%"
                    height="45px" width="45px">
            @endif

            </a>

        </li>


    </ul>
</nav>
<!-- /.navbar -->
