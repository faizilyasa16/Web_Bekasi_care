@extends('admin.layout')

@section('content')
    <div class="container-fluid poppins">
        <h3 class="mt-4 mb-3">Dashboard</h3>
        <div class="mt-3 row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bi bi-file-text-fill fs-1 fw-bold"></i>
                        <h5 class="card-title mb-3">Laporan</h5>
                        <div class="w-50 mx-auto" style="height: 2px; background-color: black;"></div>
                        <p class="card-text mt-3 kantumury">{{ $totalLaporan }}</p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bi bi-people-fill fs-1 fw-bold"></i>
                        <h5 class="card-title mb-3">Pengguna</h5>
                        <div class="w-50 mx-auto" style="height: 2px; background-color: black;"></div>
                        <p class="card-text mt-3 kantumury">{{ $totalPengguna }}</p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bi bi-newspaper fs-1 fw-bold"></i>
                        <h5 class="card-title mb-3">Berita</h5>
                        <div class="w-50 mx-auto" style="height: 2px; background-color: black;"></div>
                        <p class="card-text mt-3 kantumury">{{ $totalBerita }}</p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bi bi-chat-fill fs-1 fw-bold"></i>
                        <h5 class="card-title mb-3">Forum Diskusi</h5>
                        <div class="w-50 mx-auto" style="height: 2px; background-color: black;"></div>
                        <p class="card-text mt-3 kantumury">{{ $totalForum }}</p>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <h4 class="text-center mt-5 mb-4">Statistik Laporan Banjir</h4>
                
                <div class="p-3 rounded shadow mx-auto" style="background-color: #f0f8ff;">
                    {!! $chart->container() !!}
                </div>
            </div>
            <div class="col-6">
                <h4 class="text-center mt-5 mb-4">Statistik Berita Banjir</h4>
                <div class="p-3 bg-white rounded shadow">
                    {!! $beritaChart->container() !!}
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <!-- CDN Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{ $chart->script() }}
    {{ $beritaChart->script() }}
@endsection