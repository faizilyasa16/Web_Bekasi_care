<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/Bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
  <section class="vh-100 d-flex align-items-center justify-content-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="">
            <div class="text-center">
                <h1 class="text-primary">Bekasi Care</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>

            <div class="mt-5">
              <form method="POST" action="#">
                @csrf

                <div class="form-group mb-3">
                    <label for="name" class="form-label"> Nama Lengkap</label>
                    <input type="text" id="name" class="form-control" name="name" required >
                </div>


                <div class="form-group mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" id="nik" class="form-control" name="nik" required autocomplete="current-password">
                </div>
                
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" class="form-control" name="email" required >
                </div>
                
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" class="form-control" name="password" required >
                </div>

                <div class="form-group mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required >
                </div>

                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary w-50 mx-auto d-block">Register ke Bekasi Care</button>
                </div>
                <div class="form-group mb-3">
                    <p class="text-center text-primary">Sudah Punya Akun? <a href="{{ route('login') }}" class="text-decoration-none text-warning">Login Sekarang</a></p>
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
