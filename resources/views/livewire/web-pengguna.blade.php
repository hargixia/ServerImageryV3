<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Sidebar Navigation -->
        <div class="col-2 bg-light border-end p-3 d-none d-md-block"
             style="position: sticky; top: 80px; height: calc(100vh - 80px); overflow-y: auto;">
            <aside>
                @include('components.navbar')
            </aside>
        </div>


        <!-- Main Content Area -->
        <main class="col-12 col-lg-10 p-4">
            <div class="container-fluid p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold">Manajemen Pengguna</h4>
                    <button class="btn btn-primary" wire:click='tambahUser'>
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
                                @forelse ($pengguna as $index => $u)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $u->username }}</td>
                                        <td>{{ $u->nama }}</td>
                                        <td>{{ $u->tanggal_lahir }}</td>
                                        <td>
                                            @if ($u->jenis_kelamin == 'L')
                                                <span class="text-primary">Laki-laki</span>
                                            @else
                                                <span class="text-danger">Perempuan</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($u->id_role == 1)
                                                <span class="badge bg-danger">Admin</span>
                                            @else
                                                <span class="badge bg-secondary">User</span>
                                            @endif
                                        </td>
                                        <td>{{ $u->bidang }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-warning" wire:click="editUser({{ $u->id }})" >
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal" wire:click="deleteUser({{ $u->id }})">
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
            </div>
        </main>
    </div>


    <!-- Modal Hapus -->
        <div class="modal fade" id="deleteUserModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-trash3-fill me-2"></i> Hapus Pengguna
                        </h5>
                    </div>
                    <div class="modal-body">
                        <p class="mb-0">Yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Batal
                        </button>
                        <button class="btn btn-danger" wire:click='confirmDelete'>
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>

</div>
