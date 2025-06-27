@extends('user.layout')

@section('content')
<section class="container mt-5">
    <div class="row justify-content-center poppins">
        <div class="col-8">
            <div class="align-items-center mb-5">
                <h1 class="text-decoration-underline link-underline-warning">Ubah Password</h1>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="card shadow-sm mb-5 text-start">
                <div class="card-body p-4 poppins-light">
                    <form action="{{ route('profile-user.password', auth()->user()->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Password Lama -->
                        <div class="mb-3">
                            <label for="old_password" class="form-label fw-bold">Password Lama</label>
                            <input type="password" class="form-control py-2" id="old_password" name="old_password" required>
                        </div>
                        
                        <!-- Password Baru -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Password Baru</label>
                            <input type="password" class="form-control py-2" id="password" name="password" required>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Password</label>
                            <input type="password" class="form-control py-2" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <!-- Link Kembali -->
                        <div class="mb-3">
                            <a href="{{ route('profile-user') }}" class="text-primary">Kembali <i class="bi bi-arrow-right"></i></a>
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary py-2">
                                <i class="bi bi-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
