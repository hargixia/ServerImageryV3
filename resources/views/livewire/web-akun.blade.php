<div class="container-fluid py-3">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-12 col-md-2 mb-3">
            <aside class="sticky-top">
                @include('components.navbar')
            </aside>
        </div>

        <!-- Main Content -->
        <main class="col-12 col-md-10">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h5 class="mb-0 fw-semibold"><i class="bi bi-person-circle me-2"></i> Profil Saya</h5>
                </div>

                <div class="card-body">
                    <form wire:submit.prevent="updateProfil" enctype="multipart/form-data">
                        <div class="row">
                            <!-- Kiri: Foto Profil -->
                            <div class="col-md-3 text-center mb-3">
                                <div class="position-relative d-inline-block">
                                    @if ($foto)
                                        <img src="{{ asset('storage/'.$foto) }}" class="rounded-circle shadow" width="150" height="150">
                                    @else
                                        <img src="{{ asset('images/default_user.png') }}" class="rounded-circle shadow" width="150" height="150">
                                    @endif
                                    <label class="btn btn-sm btn-outline-primary rounded-circle position-absolute bottom-0 end-0" style="transform: translate(20%, -20%);">
                                        <i class="bi bi-camera"></i>
                                        <input type="file" wire:model="new_foto" accept="image/*" hidden>
                                    </label>
                                </div>
                                <p class="text-muted mt-2 small">Klik ikon kamera untuk ganti foto</p>
                            </div>

                            <!-- Kanan: Data Profil -->
                            <div class="col-md-9">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">User ID</label>
                                        <input type="text" class="form-control" value="{{ $id }}" disabled>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Username</label>
                                        <input type="text" class="form-control" value="{{ $username }}" disabled>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Nama Lengkap</label>
                                        <input type="text" class="form-control" wire:model.defer="nama">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Tanggal Lahir</label>
                                        <input type="date" class="form-control" wire:model.defer="tanggal_lahir">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Jenis Kelamin</label>
                                        <select class="form-select" wire:model.defer="jenis_kelamin">
                                            <option value="">Pilih</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Ganti Password</label>
                                        <input type="password" class="form-control" wire:model.defer="password" placeholder="Kosongkan jika tidak ingin mengubah">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Info Sistem -->
                        <div class="row text-secondary small">
                            <div class="col-md-4"><strong>Dibuat:</strong> {{ $created_at }}</div>
                            <div class="col-md-4"><strong>Terakhir Diperbarui:</strong> {{ $updated_at }}</div>
                            <div class="col-md-4"><strong>Login Status:</strong> {{ $login_stat ? 'Aktif' : 'Tidak Aktif' }}</div>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-success fw-semibold">
                                <i class="bi bi-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
