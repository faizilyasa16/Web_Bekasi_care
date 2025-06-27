@extends('user.layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-9 flex-column">
            <div class="align-items-center">
                <h1 class="text-decoration-underline link-underline-warning poppins">Profil Saya</h1>
            </div>
            <!-- Wrapper Gambar + Icon -->
            <div class="text-center"> <!-- Parent element dengan text-center -->
                <div class="position-relative d-inline-block mx-auto" style="width: 200px; height: 200px;">
                <!-- Preview Gambar -->
                <img src="{{ auth()->user()->img ? asset('storage/' . auth()->user()->img) : asset('img/profile.png') }}" 
                    id="previewImage"
                    class="img-fluid rounded-circle w-100 h-100 object-fit-cover border"
                    alt="Foto Profil">

                <!-- Tombol Upload (icon) -->
                <label for="img" 
                    class="btn btn-sm btn-light border rounded-circle position-absolute bottom-0 end-0 translate-middle p-1 shadow"
                    title="Ganti Foto">
                    <i class="bi bi-pencil-fill text-primary"></i>
                </label>
                </div>
            </div>
            <div class="mt-3 d-block mx-auto text-center poppins">
               <span class="fw-bold fs-3">Halo, {{ auth()->user()->name }}</span>
               @if (auth()->user()->status == 'terafiliasi')
                   <div class="mt-2 mb-5">
                        <span class="fw-bold p-2 fs-5" style="color: #fec330">
                            NIK TERAFILIASI WARGA KOTA BEKASI
                        </span>
                    </div>
               @else
                   <div class="mt-4 mb-5">
                        <span class="fw-bold p-2 fs-3" style="color: #fec330">
                            NIK BELUM TERAFILIASI WARGA KOTA BEKASI
                        </span>
                    </div>
               @endif
                <div class="card shadow-sm mb-5 text-start">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif (session('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{{ session('success') }}</li>
                            </ul>
                        </div>
                    @endif
                    <div class="card-body poppins-light p-4">
                        <form action="{{ route('profile-user.update', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- NIK Field -->
                            <div class="mb-3">
                                <label for="nik" class="form-label fw-bold">NIK Terdaftar</label>
                                <input type="text" class="form-control py-2" id="nik" 
                                    value="{{ auth()->user()->nik ?? 'Belum terdaftar' }}" 
                                    readonly>
                            </div>
                            <input type="file" id="img" name="img" accept="image/*" class="d-none" onchange="previewProfile(event)">

                            <!-- Username Field -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Username</label>
                                <input type="text" class="form-control py-2" name="name" id="name" 
                                    value="{{ auth()->user()->name }}">
                            </div>
                            
                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control py-2" name="email" id="email" 
                                    value="{{ auth()->user()->email }}">
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('ubah-password') }}" class="text-primary">Ubah Password <i class="bi bi-arrow-right"></i></a>
                            </div>
                            <!-- Submit Button -->
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
    </div>
</div>
@endsection

@section('script')
    <script>
        function previewProfile(event) {
            const input = event.target;
            const reader = new FileReader();

            reader.onload = function(){
                const img = document.getElementById('previewImage');
                img.src = reader.result;
            };

            if (input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection