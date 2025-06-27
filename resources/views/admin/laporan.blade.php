@extends('admin.layout')

@section('content')
    <div class="container-fluid poppins">
        <h3 class="mt-4">Data Laporan</h3>
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
                        <th colspan="9">
                            <div class="d-flex" style="width: 100%;">
                                <div class="input-group" style="flex: 1;">
                                    <span class="input-group-text bg-warning rounded-start bg-transparent">
                                        <button type="submit" class="btn"><i class="bi-search"></i></button>
                                    </span>
                                    <input class="form-control" type="search" placeholder="Cari Laporan..." name="query">
                                </div>
                            </div>
                        </th>
                    </form>
                </tr>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Foto Kejadian</th>
                    <th>Lokasi</th>
                    <th>Keluhan</th>
                    <th>Kebutuhan</th>
                    <th>Tingkat Prioritas</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="poppins-light">
                @forelse ($laporans as $laporan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $laporan->user->name }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Kejadian" width="80">
                        </td>
                        <td>{{ $laporan->lokasi }}</td>
                        <td>{{ Str::limit($laporan->keluhan, 10, '...') }}</td>
                        <td>{{ Str::limit($laporan->kebutuhan, 10, '...') }}</td>
                        <td>
                            @php
                                $urgensiClass = [
                                    'sangat-tinggi' => 'bg-danger text-white',
                                    'tinggi' => 'bg-warning text-dark',
                                    'normal' => 'bg-primary text-white',
                                    'rendah' => 'bg-info text-dark',
                                    'sangat-rendah' => 'bg-success text-white',
                                ];
                            @endphp

                            <span class="badge {{ $urgensiClass[$laporan->urgensi] ?? 'bg-secondary' }}">
                                {{ Str::title(str_replace('-', ' ', $laporan->urgensi)) }}
                            </span>
                        </td>
                        <td>
                            @if ($laporan->latestStatus)
                                <span class="badge bg-primary">
                                    {{ Str::ucfirst(str_replace('_', ' ', $laporan->latestStatus->status)) }}
                                </span>
                            @else
                                <span class="badge bg-secondary">Belum Ada Status</span>
                            @endif
                        </td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $laporan->id }}">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#gantiStatusModal{{ $laporan->id }}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.laporan.delete', $laporan->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                                    <!-- Modal Ganti Status -->
                            <div class="modal fade" id="gantiStatusModal{{ $laporan->id }}" tabindex="-1" aria-labelledby="gantiStatusLabel{{ $laporan->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('admin.laporan.updateStatus', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Ubah Status Laporan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                
                                            <div class="mb-3">
                                                <label for="status" class="form-label fw-bold">Status Baru</label>
                                                <select name="status" id="status" class="form-select" required>
                                                    @php
                                                        $statusList = [
                                                            'terima_laporan' => 'Terima Laporan',
                                                            'verifikasi_laporan' => 'Verifikasi Laporan',
                                                            'penanganan_tindakan' => 'Penanganan / Tindakan',
                                                            'hasil_tindakan' => 'Hasil Tindakan'
                                                        ];

                                                        // Ambil daftar status yang sudah pernah digunakan
                                                        $usedStatuses = $laporan->statusHistories->pluck('status')->toArray();
                                                        $latestStatus = optional($laporan->latestStatus)->status;
                                                    @endphp

                                                    @foreach ($statusList as $value => $label)
                                                        <option 
                                                            value="{{ $value }}"
                                                            {{ $value == $latestStatus ? 'selected' : '' }}
                                                            {{ in_array($value, $usedStatuses) && $value != $latestStatus ? 'disabled' : '' }}
                                                        >
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>



                                                <div class="mb-3">
                                                    <label for="deskripsi" class="form-label fw-bold">Deskripsi Tindakan / Catatan</label>
                                                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required></textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="bukti" class="form-label fw-bold">Bukti (Opsional)</label>
                                                    <input type="file" name="bukti" class="form-control" accept="image/*,application/pdf">
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success">Simpan Status</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Modal Detail Laporan -->
                            <div class="modal fade" id="detailModal{{ $laporan->id }}" tabindex="-1" aria-labelledby="detailLabel{{ $laporan->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailLabel{{ $laporan->id }}">Detail Laporan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ asset('storage/' . $laporan->foto) }}" class="img-fluid mb-3" alt="">
                                            <p><strong>Nama Pengirim:</strong> {{ $laporan->user->name }}</p>
                                            <p><strong>Lokasi Kejadian:</strong> {{ $laporan->lokasi }}</p>
                                            <p><strong>Tanggal Laporan:</strong> {{ $laporan->created_at }}</p>
                                            <p><strong>Keluhan:</strong> {{ $laporan->keluhan }}</p>
                                            <p><strong>Kebutuhan:</strong> {{ $laporan->kebutuhan }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Tidak ada data laporan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>


    </div>
@endsection
