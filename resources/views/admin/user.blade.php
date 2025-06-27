@extends('admin.layout')

@section('content')
    <div class="container-fluid poppins">
        <h3 class="mt-4">Data Pengguna</h3>
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
                                        <input class="form-control" type="search" placeholder="Cari User..." name="query">
                                    </div>
                                    <a class="btn btn-primary ms-2 d-flex align-items-center poppins-light" data-bs-toggle="modal" data-bs-target="#tambahUser">Tambah User</a>
                                </div>
                            </th>
                        </form>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="poppins-light">
                    @forelse ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->nik }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->status === 'terafiliasi')
                                    <span class="badge bg-success">Terafiliasi</span>
                                @elseif ($user->status === 'belum-terafiliasi')
                                    <span class="badge bg-danger">Belum Terafiliasi</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="#" 
                                    class="btn btn-warning btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editUser{{ $user->id }}">
                                        <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <!-- Modal Edit User -->
                        <div class="modal fade" id="editUser{{ $user->id }}" tabindex="-1" aria-labelledby="editUserLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title">Edit User - {{ $user->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body poppins-light">
                                    <div class="row">
                                        <!-- Kolom Kiri -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Nama</label>
                                                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>NIK</label>
                                                <input type="text" name="nik" class="form-control" value="{{ $user->nik }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                            </div>
                                        </div>

                                        <!-- Kolom Kanan -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Terafiliasi</label>
                                                <select name="status" class="form-select" id="status">
                                                    <option value="belum-terafiliasi" {{ $user->status == 'belum-terafiliasi' ? 'selected' : '' }}>Belum Terafiliasi</option>
                                                    <option value="terafiliasi" {{ $user->status == 'terafiliasi' ? 'selected' : '' }}>Terafiliasi</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label>Role</label>
                                                <select name="role" class="form-select" required>
                                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Modal Tambah User -->
        <div class="modal fade" id="tambahUser" tabindex="-1" aria-labelledby="tambahUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nik">NIK</label>
                                    <input type="text" name="nik" id="nik" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status">Terafiliasi</label>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="belum-terafiliasi">Belum Terafiliasi</option>
                                        <option value="terafiliasi">Terafiliasi</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form-select" required>
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
        </div>

    </div>
@endsection
