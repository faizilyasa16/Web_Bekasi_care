@extends('user.layout')

@section('content')
<div class="container mt-5 mb-4 poppins">
    <!-- Post Utama -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="d-flex align-items-center mb-3">
            <img src="{{ $forum->user->img ? asset('storage/' . $forum->user->img) : asset('img/profile.png') }}"
                class="rounded-circle me-3" alt="Foto User" width="60" height="60">
                <div>
                    <h5 class="mb-0">{{ $forum->user->name }}</h5>
                    <small class="text-muted">{{ $forum->created_at->format('d M Y, H:i') }}</small>
                </div>
            </div>
            <h4>{{ $forum->judul }}</h4>
            <p class="mt-2 poppins-light">{{ $forum->isi }}</p>
        </div>
    </div>

    <!-- Replies / Komentar -->
    <h5 class="mb-3">Komentar</h5>
    @forelse ($forum->replies as $reply)
        <div class="card mb-3 border-start border-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                <img src="{{ $forum->user->img ? asset('storage/' . $forum->user->img) : asset('img/profile.png') }}"
                    class="rounded-circle me-3" alt="Foto User" width="60" height="60">
                    <div>
                        <strong>{{ $reply->user->name }}</strong><br>
                        <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                <p class="mb-0 poppins-light">{{ $reply->isi }}</p>
            </div>
        </div>
    @empty
        <p class="text-muted poppins-light">Belum ada komentar. Jadilah yang pertama!</p>
    @endforelse

    <!-- Form Balasan -->
    <div class="card mt-4 shadow-sm">
        <div class="card-body">
            <form action="{{ route('forum.reply', $forum->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="isi" class="form-label">Tulis Komentar</label>
                    <textarea name="isi" class="form-control poppins-light" rows="3" placeholder="Tulis sesuatu..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>
</div>
@endsection
