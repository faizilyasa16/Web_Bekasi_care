@extends('user.layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center mb-4">
                <h1 class="text-decoration-underline link-underline-warning poppins">Riwayat Laporan</h1>
            </div>

            <!-- Table Section -->
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered mb-0 text-center">
                            <thead class="table-primary poppins">
                                <tr>
                                    <th class="py-3">Tanggal Lapor</th>
                                    <th class="py-3">Lokasi Banjir</th>
                                    <th class="py-3">Keluhan</th>
                                    <th class="py-3">Status</th>
                                    <th class="py-3">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="poppins-light">
                                @forelse ($laporans as $laporan)
                                    <tr>
                                        <td class="align-middle">{{ $laporan->created_at->format('d M Y') }}</td>
                                        <td class="align-middle">{{ $laporan->lokasi }}</td>
                                        <td class="align-middle">{{ Str::limit($laporan->keluhan, 40, '...') }}</td>
                                        <td class="align-middle">
                                            @if ($laporan->latestStatus)
                                                @php
                                                    $status = $laporan->latestStatus->status;
                                                    $badgeClass = match($status) {
                                                        'hasil_tindakan' => 'success',
                                                        'penanganan_tindakan' => 'warning',
                                                        'verifikasi_laporan' => 'primary',
                                                        'terima_laporan' => 'secondary',
                                                        default => 'dark',
                                                    };
                                                @endphp
                                                <span class="badge bg-{{ $badgeClass }}">
                                                    {{ Str::headline(str_replace('_', ' ', $status)) }}
                                                </span>
                                            @else
                                                <span class="badge bg-dark">Laporan di Kirim</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($laporan->latestStatus)
                                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#progresModal{{ $laporan->id }}">Lihat Progres</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-3">Belum ada laporan yang dikirim.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @foreach ($laporans as $laporan)
                @if ($laporan->statusHistories->isNotEmpty())
                <!-- Modal Progres -->
                <div class="modal fade" id="progresModal{{ $laporan->id }}" tabindex="-1" aria-labelledby="progresModalLabel{{ $laporan->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header poppins">
                                <h5 class="modal-title">Progres Laporan: {{ $laporan->lokasi }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body poppins-light">
                                <div class="timeline">
                                    @foreach ($laporan->statusHistories->sortBy('created_at') as $history)
                                        <div class="timeline-item position-relative ps-4 mb-5">
                                            <div class="position-absolute top-0 start-0 translate-middle bg-primary rounded-circle" style="width: 15px; height: 15px;"></div>
                                            <h6 class="fw-bold mb-1">{{ Str::headline(str_replace('_', ' ', $history->status)) }}</h6>
                                            <small class="text-muted">{{ $history->created_at->format('d M Y, H:i') }}</small>
                                            <p class="mt-2 mb-1">{{ $history->deskripsi }}</p>

                                            @if ($history->bukti)
                                                <div class="mt-2">
                                                    <label class="fw-semibold">Bukti:</label><br>
                                                    @if(Str::endsWith($history->bukti, ['.jpg', '.jpeg', '.png']))
                                                        <img src="{{ asset('storage/' . $history->bukti) }}" alt="Bukti" class="img-fluid rounded mb-2" style="max-width: 300px;">
                                                    @elseif(Str::endsWith($history->bukti, '.pdf'))
                                                        <a href="{{ asset('storage/' . $history->bukti) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat PDF</a>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
        @endforeach


        </div>
    </div>
</div>
@endsection
