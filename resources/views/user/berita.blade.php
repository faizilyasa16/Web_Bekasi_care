@extends('user.layout')

@section('content')
<section class="container mt-5 mb-5">
    <h2 class="mb-5 text-center text-primary poppins">Berita Terbaru</h2>
    <div class="row gy-4">
        @foreach ($berita as $item)
            @if ($item->status == 'published')
                <div class="col-md-4">
                    <a href="{{ route('berita-user.show', $item->id) }}" class="text-decoration-none text-dark">
                        <div class="p-3 h-100 berita-card transition-scale">
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="img-fluid w-100 rounded mb-1" style="height: 200px; object-fit: cover;" alt="Gambar {{ $item->judul }}">
                            <h4 class="mb-2 poppins">{{ $item->judul }}</h4>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $berita->links() }}
    </div>
</section>
@endsection
