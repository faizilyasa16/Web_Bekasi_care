@extends('user.layout')

@section('content')
<section class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary poppins">Forum Diskusi</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Auth::check())
            <a href="#" class="btn btn-primary poppins-light" data-bs-toggle="modal" data-bs-target="#modalTambahForum">
                <i class="bi bi-plus-circle me-1"></i> Tambah Forum
            </a>
        @endif
    </div>

    <div class="row gy-4">
        @foreach ($forums as $forum)
        {{-- Di sini $forum adalah satu item, jadi boleh akses $forum->status --}}
            <div class="col-12">
                <a href="{{ route('forum.show', $forum->id) }}" class="text-decoration-none text-dark">
                    <div class="d-flex align-items-center p-3 border rounded shadow-sm">
                        <img src="{{ $forum->user->img ? asset('storage/' . $forum->user->img) : asset('img/profile.png') }}"
                            class="rounded-circle me-3" alt="Foto User" width="60" height="60">
                        <div>
                            <h5 class="mb-1 poppins">{{ Str::limit($forum->judul, 50) }}</h5>
                            <small class="text-muted poppins-light">Dibuat pada {{ $forum->created_at->format('d M Y') }}</small>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>
    <!-- Modal Tambah Forum -->
    <div class="modal fade" id="modalTambahForum" tabindex="-1" aria-labelledby="modalTambahForumLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('forum.store') }}" method="POST">
        @csrf
        <div class="modal-content poppins-light">
            <div class="modal-header">
            <h5 class="modal-title poppins" id="modalTambahForumLabel">Tambah Forum</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
            <input type="hidden" name="status" value="open">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Forum</label>
                <input type="text" name="judul" id="judul" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="isi" class="form-label">Isi Forum</label>
                <textarea name="isi" id="isi" rows="5" class="form-control" required></textarea>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </div>
        </form>
    </div>
    </div>

</section>
@endsection
