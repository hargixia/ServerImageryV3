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
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#UserModal">
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
                                        <button class="btn btn-sm btn-warning" wire:click="editUser({{ $user->id }})" data-bs-toggle="modal" data-bs-target="#UserModal">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" wire:click="deleteUser({{ $user->id }})" data-bs-toggle="modal" data-bs-target="#UserModal">
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
            <!-- Modal Tambah -->
<form @if($status == 0) wire:submit='storeUser' @elseif ($status == 1) wire:submit='updateUser' @else wire:submit='confirmDelete' @endif class="modal fade" id="UserModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="bi bi-person-plus-fill me-2"></i> {{ $label_status }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body row g-3">
                <!-- ALERT VALIDASI -->
                @if ($errors->any())
                    <div id="error_msg" class="alert alert-danger">
                        <strong>Terjadi kesalahan!</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <script>
                            setTimeout(function() {
                                var errorMsg = document.getElementById('error_msg');
                                if (errorMsg) {
                                    errorMsg.style.display = 'none';
                                }
                            }, 10000);
                        </script>
                @endif

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
                        @foreach ($role as $r)
                            <option value="{{ $r->id }}">{{$r->nama}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Bidang</label>
                    @foreach ($data_bidang as $d)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" wire:model='id_bidang' value="{{ $d->id }}">
                            <label class="form-check-label">{{ $d->bidang }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" wire:model="password">
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Batal
                </button>
                <button class="btn btn-primary" type="submit" wire:click="storeUser">
                    <i class="bi bi-save"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</form>

<!-- Modal Edit -->
<form wire:ignore.self class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">
                    <i class="bi bi-pencil-square me-2"></i> Edit Pengguna
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body row g-3">
                {{-- ALERT VALIDASI --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Terjadi kesalahan!</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

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
                        <option value="">Pilih...</option>
                        @foreach ($role as $r)
                            <option value="{{ $r->id }}">{{$r->nama}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Bidang</label>
                    @foreach ($data_bidang as $d)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" wire:model='id_bidang_edit' value="{{ $d->id }}">
                            <label class="form-check-label">{{ $d->bidang }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Batal
                </button>
                <button class="btn btn-warning text-white" type="submit" wire:click="updateUser">
                    <i class="bi bi-save2-fill"></i> Perbarui
                </button>
            </div>
        </div>
    </div>
</form>

<!-- Modal Hapus -->
<form wire:ignore.self class="modal fade" id="deleteUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-trash3-fill me-2"></i> Hapus Pengguna
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Batal
                </button>
                <button class="btn btn-danger "  type="submit" wire:click="confirmDelete">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</form>

