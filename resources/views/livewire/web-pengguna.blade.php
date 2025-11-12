<div class="row g-0">
    {{-- Sidebar --}}
    <div class="col-2 bg-light border-end vh-100 p-3 position-sticky top-0 d-none d-md-block">
        <aside class="sticky-top">
            @include('components.navbar')
        </aside>
    </div>

    {{-- Main Content --}}
    <main class="col-12 col-lg-10 p-4">
        <div class="container-fluid p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold">Manajemen Pengguna</h4>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="bi bi-person-plus"></i> Tambah Pengguna
                </button>
            </div>

            <div class="card shadow-sm">
                <div class="card-body table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Role</th>
                                <th>Bidang</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengguna as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->tanggal_lahir }}</td>
                                    <td>
                                        @if ($user->jenis_kelamin == 'L')
                                            <span class="text-primary">Laki-laki</span>
                                        @else
                                            <span class="text-danger">Perempuan</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->id_role == 1)
                                            <span class="badge bg-danger">Admin</span>
                                        @else
                                            <span class="badge bg-secondary">User</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->bidang }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning" wire:click="editUser({{ $user->id }})" data-bs-toggle="modal" data-bs-target="#editUserModal">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" wire:click="deleteUser({{ $user->id }})" data-bs-toggle="modal" data-bs-target="#deleteUserModal">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Belum ada pengguna terdaftar</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Modal Tambah --}}
            <div wire:ignore.self class="modal fade" id="addUserModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Tambah Pengguna</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" wire:model="username">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" wire:model="nama">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" wire:model="tanggal_lahir">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="L" wire:model="jenis_kelamin"> Laki-laki
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="P" wire:model="jenis_kelamin"> Perempuan
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Role</label>
                                <select class="form-select" wire:model="id_role">
                                    <option value="">Pilih...</option>
                                    <option value="1">Admin</option>
                                    <option value="2">User</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Bidang</label>
                                @foreach ($data_bidang as $d)
                                    <div class="form-check col-sm-6">
                                        <input class="form-check-input" type="radio" id="flexRadioDefault1" wire:model='id_bidang' value="{{ $d->id }}">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            {{ $d->bidang }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" wire:model="password">
                                <div>@error('password') {{ $message }} @enderror</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary" wire:click="storeUser">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Edit --}}
            <div wire:ignore.self class="modal fade" id="editUserModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-warning text-white">
                            <h5 class="modal-title">Edit Pengguna</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" wire:model="username_edit">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" wire:model="nama_edit">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" wire:model="tanggal_lahir_edit">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="L" wire:model="jenis_kelamin_edit"> Laki-laki
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="P" wire:model="jenis_kelamin_edit"> Perempuan
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Role</label>
                                <select class="form-select" wire:model="id_role_edit">
                                    <option value="1">Admin</option>
                                    <option value="2">User</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Bidang</label>
                                @foreach ($data_bidang as $d)
                                    <div class="form-check col-sm-6">
                                        <input class="form-check-input" type="radio" id="flexRadioDefault1" wire:model='id_bidang_edit' value="{{ $d->id }}">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            {{ $d->bidang }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-warning text-white" wire:click="updateUser">Perbarui</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Hapus --}}
            <div wire:ignore.self class="modal fade" id="deleteUserModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">Hapus Pengguna</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Yakin ingin menghapus pengguna ini?
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-danger" wire:click="confirmDelete">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
