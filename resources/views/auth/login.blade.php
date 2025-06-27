<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/Bootstrap/css/bootstrap.min.css') }}">
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
  </style>
</head>
<body>
  <section class="vh-100 d-flex align-items-center justify-content-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="">
            <div class="text-center">
                <h1 class="text-primary fw-bold poppins-light">Bekasi Care</h1>
            </div>

            <div class="mt-5">
              <form method="POST" action="#">
                @csrf

                <div class="form-group mb-3">
                    <label for="nik" class="form-label poppins-light">Masukan NIK</label>
                    <input type="text" id="NIK" class="form-control" name="nik" required >
                </div>


                <div class="form-group mb-3">
                    <label for="password" class="form-label poppins-light">Password</label>
                    <input type="password" id="password" class="form-control" name="password" required autocomplete="current-password">
                </div>
                <div class="form-group mb-3">
                    <p class="text-center text-primary poppins-light">Bekasi aja Care, Masa kamu engga?</p>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary w-50 mx-auto d-block poppins-light">Masuk ke Bekasi Care</button>
                </div>
                <div class="form-group mb-3">
                    <p class="text-center text-primary poppins-light">Belum Punya Akun? <a href="{{ route('register') }}" class="text-decoration-none text-warning">Daftar Sekarang</a></p>
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="{{ asset('css/Bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
