@extends('user.layout')

@section('content')


<div class="d-flex flex-column flex-md-row justify-content-between align-items-center ps-5 py-5 bg-light">
  <!-- Konten Teks -->
  <div style="max-width: 1200px;">
    <h1 class="mb-2 poppins text-primary" style="font-size:5rem; line-height: 1.2;">
      Solusi Modern untuk Penanganan Banjir
    </h1>
    <p class="mb-3 poppins-light"
      style="line-height: 1.6; font-size: 1.1rem; max-width: 78ch;">
        BekasiCare hadir sebagai solusi modern dalam menghadapi permasalahan banjir di Kota Bekasi. Dengan sistem pelaporan yang cepat dan terintegrasi, masyarakat dapat berkontribusi langsung dalam menyampaikan informasi banjir, 
        sementara petugas dapat mengambil tindakan secara tepat dan efisien berdasarkan data yang masuk.   
    </p>
    <a href="{{ route('laporan-user') }}" class="btn btn-primary poppins-light fs-5">Ayo Lapor!!</a>
  </div>


  <!-- Gambar -->
  <div class="mt-4 mt-md-0 ms-md-5" style="max-width: 100%;">
    <img src="{{ asset('img/tanganhome.png') }}" alt="Tangan" style="max-width: 600px;" class="img-fluid">
  </div>
</div>



      <!-- Simak Berita -->
    <section class="w-100 px-3 py-5" style="margin-top: 100px">
      <div class="container-fluid">
        <h1 class="text-center text-primary poppins">Simak Berita Banjir di Bekasi</h1>
        <p class="text-center poppins-light">Simak Banjir Terkini di Kota Bekasi, Disini SOB!</p>

        <div class="row mt-5 poppins-light">
          @forelse ($berita as $item)
          <div class="col-12 col-md-6 mb-4">
            <a href="{{ route('berita-user.show', $item->id) }}" class="text-decoration-none text-dark">
              <div class="card h-100 shadow-sm transition-scale ">
                <img src="{{ asset('storage/' . $item->gambar) }}"
                    class="card-img-top"
                    style="height: 200px; object-fit: cover;"
                    alt="Gambar {{ $item->judul }}">
                <div class="card-body">
                  <h5 class="card-title poppins">{{ $item->judul }}</h5>
                  <p class="card-text">{!! Str::limit(strip_tags($item->isi), 100) !!}</p>
                </div>
              </div>
            </a>
          </div>

          @empty
          <p class="text-center text-muted">Belum ada berita tersedia.</p>
          @endforelse
        </div>
      </div>
    </section>


      <!-- Diskusi -->
      <section class="w-100 px-3 py-5 bg-light">
        <div class="container-fluid">
          <h2 class="text-center text-primary mb-4 poppins">Ayo Diskusi Dengan Sesama Warga Bekasi!</h2>
          <p class="text-center poppins-light">Gabung forum, diskusi masalah banjir, solusi warga, dan dukungan RT/RW.</p>
          <div class="text-center mt-4">
            <a href="{{ route('diskusi') }}" class="btn btn-outline-primary poppins-light">Gabung Forum Diskusi</a>
          </div>
        </div>
      </section>


@endsection