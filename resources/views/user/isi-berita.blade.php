@extends('user.layout')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4 poppins-light">
        <h1 class="text-primary mb-5 poppins">{{ $berita->judul }}</h1>
        <span class="text-muted d-block mb-1">Ditulis oleh: {{ $berita->penulis ?? 'Admin' }}</span>
        <span class="text-muted">{{ $berita->created_at->format('d M Y') }}</span>
    </div>

    <div class="d-flex justify-content-center align-items-center mb-4">
        <img src="{{ asset('storage/' . $berita->gambar) }}" 
             class="img-fluid rounded shadow-sm" 
             style="width: 100%; max-height: 450px; object-fit: cover;" 
             alt="Gambar {{ $berita->judul }}">
    </div>

    <div class="mt-3 poppins-light">
        {!! $berita->isi !!}
    </div>

</div>
@endsection
