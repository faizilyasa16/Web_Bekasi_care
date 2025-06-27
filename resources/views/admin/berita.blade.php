@extends('admin.layout')

@section('content')
    <div class="container-fluid poppins">
        <h3 class="mt-4">Data Berita</h3>
        @if (session('success'))
            <div class="alert alert-success mx-4">
                <ul class="mb-0">
                    <li>{{ session('success') }}</li>
                </ul>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mx-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-hover text-center bg-light rounded" style="width: 98%">
            <thead>
                <tr class="border">
                    <form method="GET" action="#">
                        <th colspan="7">
                            <div class="d-flex" style="width: 100%;">
                                <div class="input-group" style="flex: 1;">
                                    <span class="input-group-text bg-warning rounded-start bg-transparent">
                                        <button type="submit" class="btn"><i class="bi-search"></i></button>
                                    </span>
                                    <input class="form-control" type="search" placeholder="Cari Berita..." name="query">
                                </div>
                                <a class="btn btn-primary ms-2 d-flex align-items-center poppins-light" data-bs-toggle="modal" data-bs-target="#tambahBerita">Tambah Berita</a>
                            </div>
                        </th>
                    </form>
                </tr>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Gambar</th>
                    <th>Penulis</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($beritas as $index => $berita)
                    <tr class="poppins-light">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $berita->judul }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" width="80">
                        </td>
                        <td>{{ $berita->user->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $berita->status == 'published' ? 'success' : 'secondary' }}">
                                {{ ucfirst($berita->status) }}
                            </span>
                        </td>
                        <td>
                            <!-- Update tombol preview -->
                            <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#previewModal{{ $berita->id }}">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $berita->id }}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $berita->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $berita->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Berita</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body poppins-light">
                                            <div class="mb-3">
                                                <label class="form-label">Judul</label>
                                                <input type="text" name="judul" class="form-control" value="{{ $berita->judul }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="isi" class="form-label">Konten Berita</label>
                                                <textarea id="editorEdit{{ $berita->id }}" name="isi" class="form-control" rows="6">{{ $berita->isi }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Gambar (opsional)</label><br>
                                                @if ($berita->gambar)
                                                    <img src="{{ asset('storage/' . $berita->gambar) }}" width="100" class="mb-2 rounded">
                                                @endif
                                                <input type="file" name="gambar" class="form-control mt-2">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-select" required>
                                                    <option value="draft" {{ $berita->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                                    <option value="published" {{ $berita->status == 'published' ? 'selected' : '' }}>Published</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                            <div class="modal fade" id="previewModal{{ $berita->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ $berita->judul }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if($berita->gambar)
                                                <img src="{{ asset('storage/'.$berita->gambar) }}" class="img-fluid mb-3 w-100">
                                            @endif
                                            <div class="content">
                                                <h4 class="mb-3">{{ $berita->judul }}</h4>
                                                {!! $berita->isi !!}
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <small class="text-muted me-auto">
                                                Ditulis oleh: {{ $berita->user->name }} | 
                                                {{ $berita->created_at->format('d M Y') }}
                                            </small>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </tr>
                @empty
                    <tr class="poppins-light">
                        <td colspan="7" class="text-center">Tidak ada data berita.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <!-- Modal Tambah Berita -->
        <div class="modal fade" id="tambahBerita" tabindex="-1" aria-labelledby="tambahBeritaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Tambah Berita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body poppins-light">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Berita</label>
                    <input type="text" class="form-control" id="judul" name="judul" required>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar Utama</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                </div>
                <input type="hidden" name="penulis" value="{{ auth()->user()->name }}">
                <div class="mb-3">
                        <label for="isi" class="form-label">Konten Berita</label>
                        <textarea id="editorTambah" name="isi" class="form-control" rows="6"></textarea>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    </select>
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <!-- Tambahkan di bagian modal -->



    </div>
@endsection

@section('script')
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    // Inisialisasi editor untuk Tambah Berita
    ClassicEditor
        .create(document.querySelector('#editorTambah'))
        .then(editor => {
            editor.ui.view.editable.element.style.minHeight = '200px';
        })
        .catch(error => {
            console.error(error);
        });

    // Inisialisasi editor untuk semua Edit Berita
    @foreach ($beritas as $berita)
        ClassicEditor
            .create(document.querySelector('#editorEdit{{ $berita->id }}'))
            .then(editor => {
                editor.ui.view.editable.element.style.minHeight = '200px';
            })
            .catch(error => {
                console.error(error);
            });
    @endforeach
</script>
@endsection

