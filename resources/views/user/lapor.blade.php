@extends('user.layout')

@section('content')
<section class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="bg-white shadow rounded p-4 p-md-5 poppins-light">
                <h2 class="text-center mb-4 text-primary text-decoration-underline link-underline-warning poppins">Laporkan Masalah Banjir di Daerahmu</h2>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('laporan-user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Kiri: Upload Foto -->
                        <div class="col-md-6 mb-4">
                            <label for="foto" class="form-label fw-bold">Upload Foto Banjir</label>
                            <input class="form-control" type="file" id="foto" name="foto" accept="image/*" onchange="previewImage(event)">
                            
                            <!-- Preview Gambar -->
                            <div class="mt-3">
                                <label for="preview" class="form-label fw-bold">Preview Gambar:</label>
                                <img id="preview" src="#" alt="Preview Gambar" class="img-fluid rounded shadow-sm d-none border" style="max-height: 300px;">
                            </div>
                        </div>

                        <!-- Kanan: Input Informasi -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="lokasi" class="form-label fw-bold">Lokasi Banjir</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Contoh: Jl. Mawar No. 12, Jakarta Timur">
                            </div>
                            <div class="mb-3">
                                <label for="urgensi" class="form-label fw-bold">Urgensi Banjir</label>
                                <select name="urgensi" id="urgensi" class="form-select" required>
                                    <option disabled selected>-- Pilih Urgensi --</option>
                                    <option value="sangat-tinggi" {{ old('urgensi') == 'sangat-tinggi' ? 'selected' : '' }}>Sangat Tinggi</option>
                                    <option value="tinggi" {{ old('urgensi') == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                                    <option value="normal" {{ old('urgensi', 'normal') == 'normal' ? 'selected' : '' }}>Normal</option>
                                    <option value="rendah" {{ old('urgensi') == 'rendah' ? 'selected' : '' }}>Rendah</option>
                                    <option value="sangat-rendah" {{ old('urgensi') == 'sangat-rendah' ? 'selected' : '' }}>Sangat Rendah</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="keluhan" class="form-label fw-bold">Keluhan Banjir</label>
                                <textarea class="form-control" id="keluhan" name="keluhan" rows="3" placeholder="Jelaskan kondisi banjir di lokasi ini..."></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="kebutuhan" class="form-label fw-bold">Kebutuhan yang Diperlukan</label>
                                <textarea class="form-control" id="kebutuhan" name="kebutuhan" rows="3" placeholder="Contoh: Makanan, Obat-obatan, Perahu karet"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        @if (auth()->user()->status === 'terafiliasi')
                            <button type="submit" class="btn btn-primary px-5 py-2 fw-semibold shadow">Laporkan Banjir</button>
                        @else
                            <button type="button" onclick="alert('Gagal! Anda belum terafiliasi. Hubungi admin untuk verifikasi.')" class="btn btn-secondary px-5 py-2 fw-semibold shadow">
                                Laporkan Banjir
                            </button>
                        @endif
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
