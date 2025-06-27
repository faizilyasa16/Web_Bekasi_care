@extends('admin.layout')

@section('content')
<div class="container-fluid poppins">
    <h3 class="mt-4">Data Forum Diskusi</h3>
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
                                <input class="form-control" type="search" placeholder="Cari Forum..." name="query">
                            </div>
                            <a class="btn btn-primary ms-2 d-flex align-items-center poppins-light" data-bs-toggle="modal" data-bs-target="#tambahForum">Tambah Forum</a>
                        </div>
                    </th>
                </form>
            </tr>
            <tr>
                <th>No</th>
                <th>Judul Topik</th>
                <th>Pengirim</th>
                <th>Tanggal Post</th>
                <th>Balasan</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="poppins-light">
            @forelse ($forums as $index => $forum)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ Str::limit($forum->judul, 50) }}</td>
                    <td>{{ $forum->user->name ?? '-' }}</td>
                    <td>{{ $forum->created_at->format('d M Y') }}</td>
                    <td>{{ $forum->replies->count() }}</td>
                    <td>
                        @if ($forum->status == 'open')
                            <span class="badge bg-{{ $forum->status == 'open' ? 'success' : 'secondary' }}">
                                {{ ucfirst($forum->status) }}
                            </span>
                        @else
                            <span class="badge bg-{{ $forum->status == 'closed' ? 'danger' : 'secondary' }}">
                                {{ ucfirst($forum->status) }}
                            </span>
                        @endif
                    </td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailForum{{ $forum->id }}">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editForum{{ $forum->id }}">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('forum.destroy', $forum->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus forum ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <!-- Modal Edit Forum -->
                <div class="modal fade" id="editForum{{ $forum->id }}" tabindex="-1" aria-labelledby="editForumLabel{{ $forum->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('forum.update', $forum->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Forum: {{ $forum->judul }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3 text-start">
                                        <label for="judul" class="form-label">Judul Topik</label>
                                        <input type="text" class="form-control" id="judul" name="judul" value="{{ $forum->judul }}" required>
                                    </div>
                                    <div class="mb-3 text-start">
                                        <label for="isi" class="form-label">Isi Forum</label>
                                        <textarea class="form-control" id="isi" name="isi" rows="4" required>{{ $forum->isi }}</textarea>
                                    </div>
                                    <div class="mb-3 text-start">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-select" required>
                                            <option value="open" {{ $forum->status == 'open' ? 'selected' : '' }}>Open</option>
                                            <option value="closed" {{ $forum->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal fade" id="detailForum{{ $forum->id }}" tabindex="-1" aria-labelledby="detailForumLabel{{ $forum->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailForumLabel{{ $forum->id }}">Detail Forum: {{ $forum->judul }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <h4 class="mb-3">{{ $forum->judul }}</h4>
                                <p>{{ $forum->isi }}</p>

                            </div>
                            <div class="modal-footer d-flex justify-content-between align-items-center">
                                <span class="text-muted">Total Views : {{ $forum->views }}</span>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada topik forum.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <!-- Modal Tambah Forum -->
    <div class="modal fade" id="tambahForum" tabindex="-1" aria-labelledby="tambahForumLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="#" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahForumLabel">Tambah Forum Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 text-start">
                            <label for="judul" class="form-label">Judul Topik</label>
                            <input type="text" class="form-control" id="judul" name="judul" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="isi" class="form-label">Isi Forum</label>
                            <textarea class="form-control" id="isi" name="isi" rows="4" required></textarea>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="open">Open</option>
                                <option value="closed">Closed</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Posting</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
