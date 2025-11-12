<div class="container-fluid p-0">
    <div class="row g-0">
        <div class="col-2 bg-light border-end vh-100 p-3 position-sticky top-0 d-none d-md-block">
            <aside class="sticky-top">
                @include('components.navbar')
            </aside>
        </div>

        <main class="col-12 col-lg-10 p-4">
            <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
                <h1 class="h3">Daftar Pengguna</h1>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="bi bi-person-plus"></i> Tambah Pengguna
                </button>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-hover align-middle">
                        <thead class="table-secondary">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Role</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengguna as $index => $p)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $p->nama }}</td>
                                    <td>
                                        @if ($p->jenis_kelamin === 'L')
                                            <i class="bi bi-gender-male text-primary"></i> Laki-laki
                                        @elseif ($p->jenis_kelamin === 'P')
                                            <i class="bi bi-gender-female text-danger"></i> Perempuan
                                        @else
                                            {{ $p->jenis_kelamin }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($p->id_role == 1)
                                            <span class="badge bg-danger">Admin</span>
                                        @else
                                            <span class="badge bg-secondary">User</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning me-1" 
                                                wire:click="editUser({{ $p->id }})" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editUserModal">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" 
                                                wire:click="deleteUser({{ $p->id }})" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteUserModal">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        Belum ada pengguna terdaftar
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Tambah -->
            <div wire:ignore.self class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addUserLabel">Tambah Pengguna</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" wire:model="nama">
                                @error('nama') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label d-block">Jenis Kelamin</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="lakiLaki" value="L" wire:model="jenis_kelamin">
                                    <label class="form-check-label" for="lakiLaki">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="perempuan" value="P" wire:model="jenis_kelamin">
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                                @error('jenis_kelamin') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select class="form-select" wire:model="role">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="1">Admin</option>
                                    <option value="2">User</option>
                                </select>
                                @error('role') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary" wire:click="storeUser">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit -->
            <div wire:ignore.self class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning text-white">
                            <h5 class="modal-title" id="editUserLabel">Edit Pengguna</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" wire:model="nama_edit">
                                @error('nama_edit') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label d-block">Jenis Kelamin</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="lakiLakiEdit" value="L" wire:model="jenis_kelamin_edit">
                                    <label class="form-check-label" for="lakiLakiEdit">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="perempuanEdit" value="P" wire:model="jenis_kelamin_edit">
                                    <label class="form-check-label" for="perempuanEdit">Perempuan</label>
                                </div>
                                @error('jenis_kelamin_edit') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select class="form-select" wire:model="role_edit">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="1">Admin</option>
                                    <option value="2">User</option>
                                </select>
                                @error('role_edit') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-warning text-white" wire:click="updateUser">Perbarui</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Hapus -->
            <div wire:ignore.self class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="deleteUserLabel">Hapus Pengguna</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Apakah kamu yakin ingin menghapus pengguna ini?
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-danger" wire:click="confirmDelete">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>
