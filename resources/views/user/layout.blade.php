<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bekasi Care</title>
  <link rel="stylesheet" href="{{ asset('css/Bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/Bootstrap-icon/font/bootstrap-icons.css') }}">
  <style>
    @font-face {
    font-family: 'Poppins';
    src: url('{{ asset('font/poppins/WebFonts/Poppins/Poppins-Bold.woff') }}');
    }

    @font-face {
        font-family: 'Kantumury';
        src: url('{{ asset('font/kantumury/webfonts/kantumruy-pro-khmer-500-normal.woff') }}');
    }

    @font-face {
        font-family: 'Poppins-Light';
        src: url('{{ asset('font/poppins/WebFonts/Poppins/Poppins-Light.woff') }}');
    }
    .poppins {
        font-family: 'Poppins', sans-serif;
    }
    .poppins-light {
        font-family: 'Poppins-Light', sans-serif;
    }
    .kantumury {
        font-family: 'Kantumury', sans-serif;
    }
    html, body {
      height: 100%;
      margin: 0;
    }
    .wrapper {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    main {
      margin-top: 70px;
      flex: 1;
    }
    nav ul li a {
      text-decoration: none;
      color: blue;
      font-family: 'kantumury', sans-serif;
    }
    .card-hover:hover {
        background-color: #0d6efd; /* Bootstrap primary */
        color: #ffffff;
    }

    .card-hover:hover .card-title,
    .card-hover:hover .card-text,
    .card-hover:hover i {
        color: #ffffff;
        transition: 0.3s ease;
    }

    .card-hover {
        transition: background-color 0.3s ease, color 0.3s ease;
        cursor: pointer;
    }
    .transition-scale {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .transition-scale:hover {
        transform: scale(1.03);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        z-index: 1;
        background-color: #f8f9fa; /* Optional: kasih efek terang dikit */
        border-radius: 8px;
    }
    .nav-link-fade {
        opacity: 0.5;
        transition: opacity 0.3s ease;
    }

    .nav-link-fade:hover {
        opacity: 0.8;
    }

    .nav-link-fade.active {
        opacity: 1;
        font-weight: 600; /* optional: biar lebih jelas */
        color: #0d6efd !important; /* optional: tetap biru untuk aktif */
    }
  </style>
</head>
<body>
  <div class="wrapper">
      <header class="d-flex justify-content-between align-items-center py-3"
        style="background-color: #FFD700; position: fixed; top: 0; width: 100%; z-index: 1030;">
        <!-- Logo / Nama -->
      <div class="d-flex align-items-center ms-4">
        <img src="{{ asset('img/logo.png') }}" class="img-fluid" style="max-width: 50px;" alt="Logo">
        <div class="mx-1" style="height: 40px; width: 1px; background-color: black;"></div>
        <h5 class="mb-0 ms-2 align-self-center kantumury fw-bold" style="color: #0d6efd;">Bekasi Care</h5>
      </div>


      <!-- Navigasi -->
      <nav class="d-flex align-items-center">
        <ul class="list-unstyled d-flex align-items-center gap-4 mb-0">
          <li><a href="{{ route('home') }}" class="text-decoration-none nav-link-fade {{ request()->is('home') ? 'active' : '' }}">Beranda</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-primary nav-link-fade {{ request()->is('diskusi') || request()->is('laporan-user') ? 'active' : '' }}" href="#" id="dropdownLayananButton" role="button"
              data-bs-toggle="dropdown" aria-expanded="true">
              Layanan
            </a>
            <ul class="dropdown-menu bg-warning-subtle mt-4" style="margin-top: 15px" aria-labelledby="dropdownLayananButton">
              <li class="mb-1"><a class="dropdown-item" href="{{ route('diskusi') }}">Diskusi</a></li>
              <li><a class="dropdown-item" href="{{ route('laporan-user') }}">Laporkan Masalah</a></li>
            </ul>
          </li>

          <li><a href="{{ route('berita-user') }}" class="text-decoration-none nav-link-fade {{ request()->is('berita-user') ? 'active' : '' }}">Berita</a></li>
          <li><a href="{{ route('about') }}" class="text-decoration-none nav-link-fade {{ request()->is('about') ? 'active' : '' }}">Tentang Kami</a></li>
        </ul>
      </nav>


        <!-- User / Login -->
        <div class="d-flex align-items-center me-5">
          @if (Auth::check())
          <div class="dropdown">
                <a href="#" 
                  class="dropdown-toggle text-white text-decoration-none d-flex align-items-center" 
                  id="dropdownMenuButton" 
                  role="button" 
                  data-bs-toggle="dropdown" 
                  aria-expanded="false">
                  <i class="bi bi-person-circle fs-2 text-white me-2"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-end mt-2 kantumury" aria-labelledby="dropdownMenuButton">
                  <li class="mb-1"><a class="dropdown-item" href="{{ route('profile-user') }}">Profile</a></li>
                  <li class="mb-1"><a class="dropdown-item" href="{{ route('riwayat-user') }}">Riwayat Laporan</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0)" onclick="confirmLogout()">Logout</a></li>
                </ul>

          </div>
          @else
            <a href="{{ route('login') }}" class="btn btn-primary" style="font-family: 'kantumury', sans-serif">Login | Daftar</a>
          @endif
        </div>
      </header>
        <main>
          @yield('content')
        </main>

          <!-- Footer -->
<footer class="text-white pt-3" style="background-color: #0048E8; font-family: 'poppins', sans-serif">
  <div class="container">
    <img src="{{ asset('img/logo.png') }}" class="img-fluid" style="max-width: 70px;" alt="">
    <div class="row text-center text-md-start">
      <!-- Kolom 1: Tentang -->
      <div class="col-md-4 mb-4">
        <h5>Bekasi Care</h5>
          <p class="small poppins-light">
            Sebuah platform terpadu yang memudahkan warga Kota Bekasi untuk melaporkan kejadian banjir dengan cepat dan mudah, sekaligus membantu pihak berwenang dalam merespons dan menangani situasi secara efisien dan terorganisir.
          </p>
      </div>

      <!-- Kolom 2: Navigasi -->
      <div class="col-md-4 mb-4">
        <h5>Navigasi</h5>
        <div class="row poppins-light">
          <div class="col-6">
            <ul class="list-unstyled">
              <li><a href="{{ route('home') }}" class="text-white text-decoration-none">Beranda</a></li>
              <li><a href="{{ route('berita-user') }}" class="text-white text-decoration-none">Berita</a></li>
              <li><a href="{{ route('laporan-user') }}" class="text-white text-decoration-none">Lapor</a></li>
            </ul>
          </div>
          <div class="col-6">
            <ul class="list-unstyled">
              <li><a href="{{ route('diskusi') }}" class="text-white text-decoration-none">Diskusi</a></li>
              <li><a href="{{ route('about') }}" class="text-white text-decoration-none">Tentang Kami</a></li>
            </ul>
          </div>
        </div>
      </div>


      <!-- Kolom 3: Sosial Media -->
      <div class="col-md-4 mb-4">
        <h5>Ikuti Kami</h5>
        <div class="poppins-light">
          <p class="mb-1 text-white"><i class="bi bi-envelope-fill me-2"></i>info@example.com</p>
          <p class="text-white"><i class="bi bi-telephone-fill me-2"></i>+62 812-3456-7890</p>
            <div class="d-flex justify-content-center justify-content-md-start gap-3 mb-3">
              <a href="#" class="text-white fs-4" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="text-white fs-4" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="text-white fs-4" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
            </div>
        </div>
      </div>

    </div>

    <hr class="border-light" />

    <div class="text-center pb-3">
      <p class="mb-0 small">© {{ date('Y') }} Bekasi Care. All rights reserved.</p>
    </div>
  </div>
</footer>



  </div>

  <form id="keluar-app" action="{{ route('logout') }}" method="post">
    @csrf
  </form>
  @yield('script')
  <script src="{{ asset('css/Bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script>
    function confirmLogout() {
      if (confirm('Apakah Anda yakin ingin keluar?')) {
        document.getElementById('keluar-app').submit();
      }
    }
  </script>
</body>
</html>
